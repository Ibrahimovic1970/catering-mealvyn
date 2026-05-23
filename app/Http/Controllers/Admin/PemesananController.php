<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemesanan;
use App\Models\Pelanggan;
use App\Models\DetailPemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PemesananController extends Controller
{
    /**
     * ==========================================
     * CUSTOMER METHODS (Untuk Pelanggan)
     * ==========================================
     */

    /**
     * Tampilkan daftar pesanan untuk customer yang sedang login (Menu "Pesanan Saya")
     */
    public function pesananSaya()
    {
        // Ambil user yang sedang login
        $user = Auth::user();

        // Cari data pelanggan berdasarkan email user
        $pelanggan = Pelanggan::where('email', $user->email)->first();

        // Jika pelanggan ditemukan, ambil pesanannya
        if ($pelanggan) {
            $pemesanans = Pemesanan::where('id_pelanggan', $pelanggan->id)
                ->with(['pelanggan', 'detailPemesanans.paket']) // Load relasi
                ->latest() // Urutkan dari yang terbaru
                ->paginate(10); // Tampilkan 10 per halaman
        } else {
            // Jika belum jadi pelanggan, tampilkan kosong
            $pemesanans = collect([]);
        }

        return view('pages.pesanan-saya', compact('pemesanans'));
    }

    /**
     * Tampilkan detail pesanan untuk customer
     */
    public function detailPesanan($id)
    {
        $user = Auth::user();
        $pelanggan = Pelanggan::where('email', $user->email)->first();

        // Cari pesanan berdasarkan ID dan pastikan milik pelanggan yang login
        $pemesanan = Pemesanan::where('id', $id)
            ->where('id_pelanggan', $pelanggan->id)
            ->with(['pelanggan', 'detailPemesanans.paket'])
            ->firstOrFail();

        return view('pages.detail-pesanan', compact('pemesanan'));
    }


    /**
     * ==========================================
     * ADMIN METHODS (Untuk Admin & CEO)
     * ==========================================
     */

    /**
     * Tampilkan daftar semua pesanan (Halaman Index Admin)
     */
    public function index()
    {
        $pemesanans = Pemesanan::with(['pelanggan', 'detailPemesanans.paket'])
            ->latest()
            ->paginate(15);

        return view('admin.pemesanan.index', compact('pemesanans'));
    }

    /**
     * Tampilkan detail pesanan (Halaman Show Admin)
     */
    public function show($id)
    {
        // Ambil semua data pesanan beserta relasinya
        $pemesanan = Pemesanan::with(['pelanggan', 'detailPemesanans.paket', 'jenisPembayaran'])
            ->findOrFail($id);

        return view('admin.pemesanan.show', compact('pemesanan'));
    }

    /**
     * Update Status Pesanan (Misal: Menunggu Konfirmasi -> Sedang Diproses)
     */
    public function updateStatus(Request $request, $id)
    {
        // Validasi input status
        $request->validate([
            'status_pesan' => 'required|in:Menunggu Konfirmasi,Sedang Diproses,Menunggu Kurir,Selesai,Dibatalkan'
        ]);

        $pemesanan = Pemesanan::findOrFail($id);

        // Update status
        $pemesanan->status_pesan = $request->status_pesan;
        $pemesanan->save();

        return redirect()->back()->with('success', '✅ Status pesanan berhasil diperbarui!');
    }

    /**
     * Update Informasi Pengiriman (Status Kirim, Tanggal, Foto Bukti)
     */
    public function updateShipping(Request $request, $id)
    {
        // Validasi input pengiriman
        $request->validate([
            'status_kirim' => 'required|in:Menunggu Pengiriman,Sedang Dikirim,Tiba Ditujuan',
            'tgl_kirim' => 'nullable|date',
            'tgl_sampai' => 'nullable|date|after_or_equal:tgl_kirim',
            'bukti_foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048' // Max 2MB
        ]);

        $pemesanan = Pemesanan::findOrFail($id);

        // Update data teks
        $pemesanan->status_kirim = $request->status_kirim;
        $pemesanan->tgl_kirim = $request->tgl_kirim;
        $pemesanan->tgl_sampai = $request->tgl_sampai;

        // Handle Upload Foto Bukti Pengiriman
        if ($request->hasFile('bukti_foto')) {
            // Hapus foto lama jika ada
            if ($pemesanan->bukti_foto) {
                Storage::disk('public')->delete($pemesanan->bukti_foto);
            }

            // Simpan foto baru ke folder storage/app/public/bukti_pengiriman
            $path = $request->file('bukti_foto')->store('bukti_pengiriman', 'public');
            $pemesanan->bukti_foto = $path;
        }

        // Simpan perubahan ke database
        $pemesanan->save();

        return redirect()->back()->with('success', '✅ Informasi pengiriman berhasil diperbarui!');
    }
}