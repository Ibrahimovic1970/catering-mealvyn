<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemesanan;
use App\Models\Pelanggan;
use App\Models\Pengiriman;
use Illuminate\Http\Request;

class PemesananController extends Controller
{
    /**
     * Untuk Admin & CEO - Lihat semua pesanan
     */
    public function index()
    {
        $pemesanans = Pemesanan::with(['pelanggan', 'detailPemesanans.paket', 'jenisPembayaran'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.pemesanan.index', compact('pemesanans'));
    }

    /**
     * Untuk Pelanggan - Lihat pesanan sendiri (DIPERBAIKI)
     */
    public function pesananSaya()
    {
        $user = auth()->user();

        // 1. Cari data pelanggan berdasarkan EMAIL user yang sedang login
        $pelanggan = Pelanggan::where('email', $user->email)->first();

        if ($pelanggan) {
            // 2. Jika ketemu, ambil pesanan berdasarkan ID pelanggan tersebut
            $pemesanans = Pemesanan::where('id_pelanggan', $pelanggan->id)
                ->with(['detailPemesanans.paket', 'jenisPembayaran'])
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        } else {
            // 3. Jika tidak ada data pelanggan (belum pernah checkout), kembalikan kosong
            $pemesanans = collect([]);
        }

        return view('pelanggan.pesanan.index', compact('pemesanans'));
    }

    /**
     * Untuk Pelanggan - Detail pesanan sendiri (DIPERBAIKI)
     */
    public function detailPesanan(Pemesanan $pemesanan)
    {
        $user = auth()->user();

        // Cari pelanggan berdasarkan email user login
        $pelanggan = Pelanggan::where('email', $user->email)->first();

        // Pastikan pesanan yang dibuka MILIK pelanggan yang sedang login
        // Jika $pelanggan tidak ada ATAU ID pesanan tidak cocok, tolak akses
        if (!$pelanggan || $pemesanan->id_pelanggan !== $pelanggan->id) {
            abort(403, 'Anda tidak memiliki akses ke pesanan ini.');
        }

        $pemesanan->load(['detailPemesanans.paket', 'jenisPembayaran.detailJenisPembayarans', 'pengiriman']);

        return view('pelanggan.pesanan.show', compact('pemesanan'));
    }

    /**
     * Untuk Admin - Detail pesanan
     */
    public function show(Pemesanan $pemesanan)
    {
        $pemesanan->load(['pelanggan', 'detailPemesanans.paket', 'jenisPembayaran.detailJenisPembayarans', 'pengiriman']);

        return view('admin.pemesanan.show', compact('pemesanan'));
    }

    /**
     * Update status pesanan (Admin/CEO only)
     */
    public function updateStatus(Request $request, Pemesanan $pemesanan)
    {
        $validated = $request->validate([
            'status_pesan' => 'required|in:Menunggu Konfirmasi,Sedang Diproses,Menunggu Kurir,Selesai,Dibatalkan',
        ]);

        $pemesanan->update([
            'status_pesan' => $validated['status_pesan']
        ]);

        return redirect()->back()->with('success', 'Status pesanan berhasil diupdate.');
    }

    /**
     * Update info pengiriman (Admin/CEO only)
     */
    public function updatePengiriman(Request $request, Pemesanan $pemesanan)
    {
        $validated = $request->validate([
            'status_kirim' => 'required|in:Sedang Dikirim,Tiba Ditujuan',
            'tgl_kirim' => 'nullable|date',
            'tgl_tiba' => 'nullable|date|after_or_equal:tgl_kirim',
            'bukti_foto' => 'nullable|image|max:2048',
        ]);

        $buktiFoto = null;
        if ($request->hasFile('bukti_foto')) {
            $buktiFoto = $request->file('bukti_foto')->store('bukti_pengiriman', 'public');
        }

        $pengiriman = Pengiriman::updateOrCreate(
            ['id_pesan' => $pemesanan->id],
            [
                'status_kirim' => $validated['status_kirim'],
                'tgl_kirim' => $validated['tgl_kirim'] ?? null,
                'tgl_tiba' => $validated['tgl_tiba'] ?? null,
                'bukti_foto' => $buktiFoto,
                'id_user' => auth()->id(),
            ]
        );

        return redirect()->back()->with('success', 'Info pengiriman berhasil diupdate.');
    }

    /**
     * API untuk mengecek status pesanan (Real-time)
     */
    public function checkStatus(Pemesanan $pemesanan)
    {
        $user = auth()->user();
        $pelanggan = Pelanggan::where('email', $user->email)->first();

        if (!$pelanggan || $pemesanan->id_pelanggan !== $pelanggan->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $pemesanan->load(['pengiriman']);

        return response()->json([
            'status_pesan' => $pemesanan->status_pesan,
            'status_kirim' => $pemesanan->pengiriman->status_kirim ?? null,
            'tgl_tiba' => $pemesanan->pengiriman->tgl_tiba ? $pemesanan->pengiriman->tgl_tiba->format('d M Y, H:i') : null,
            'bukti_foto' => $pemesanan->pengiriman->bukti_foto ?? null,
        ]);
    }
}
