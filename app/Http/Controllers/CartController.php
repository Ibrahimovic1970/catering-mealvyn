<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\Pelanggan;
use App\Models\JenisPembayaran;
use App\Models\Pemesanan;
use App\Models\DetailPemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['harga'] * $item['qty'];
        }

        return view('pages.cart', compact('cart', 'total'));
    }

    public function add(Request $request)
    {
        $paket = Paket::findOrFail($request->id);
        $cart = session()->get('cart', []);

        if (isset($cart[$paket->id])) {
            $cart[$paket->id]['qty']++;
        } else {
            $cart[$paket->id] = [
                'id' => $paket->id,
                'nama_paket' => $paket->nama_paket,
                'harga' => $paket->harga_paket,
                'qty' => 1,
                'foto' => $paket->foto1
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Paket berhasil ditambahkan ke keranjang!');
    }

    public function update(Request $request)
    {
        $cart = session()->get('cart');

        if (isset($cart[$request->id])) {
            $cart[$request->id]['qty'] = $request->qty;
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Keranjang berhasil diupdate!');
        }

        return redirect()->back()->with('error', 'Item tidak ditemukan!');
    }

    public function remove($id)
    {
        $cart = session()->get('cart');

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Item berhasil dihapus!');
        }

        return redirect()->back()->with('error', 'Item tidak ditemukan!');
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('menu')->with('error', 'Keranjang Anda kosong!');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['harga'] * $item['qty'];
        }

        $jenisPembayarans = JenisPembayaran::with('detailJenisPembayarans')->get();

        return view('pages.checkout', compact('cart', 'total', 'jenisPembayarans'));
    }

    public function processCheckout(Request $request)
    {
        $validated = $request->validate([
            'nama_pelanggan' => 'required|string|max:100',
            'email' => 'required|email',
            'telepon' => 'required|string|max:15',
            'alamat' => 'required|string',
            'tgl_lahir' => 'nullable|date',
            'id_jenis_bayar' => 'required|exists:jenis_pembayarans,id',
            'tgl_pesan' => 'required|date|after_or_equal:today'
        ]);

        DB::beginTransaction();

        try {
            $pelanggan = Pelanggan::firstOrCreate(
                ['email' => $validated['email']],
                [
                    'nama_pelanggan' => $validated['nama_pelanggan'],
                    'telepon' => $validated['telepon'],
                    'password' => Hash::make('password'),
                    'tgl_lahir' => $validated['tgl_lahir'] ?? null,
                    'alamat1' => $validated['alamat']
                ]
            );

            $cart = session()->get('cart', []);
            $totalBayar = 0;

            foreach ($cart as $item) {
                $totalBayar += $item['harga'] * $item['qty'];
            }

            $pemesanan = Pemesanan::create([
                'id_pelanggan' => $pelanggan->id,
                'id_jenis_bayar' => $validated['id_jenis_bayar'],
                'tgl_pesan' => $validated['tgl_pesan'],
                'status_pesan' => 'Menunggu Konfirmasi',
                'total_bayar' => $totalBayar,
                'no_resi' => 'RESI-' . strtoupper(uniqid())
            ]);

            foreach ($cart as $item) {
                DetailPemesanan::create([
                    'id_pemesanan' => $pemesanan->id,
                    'id_paket' => $item['id'],
                    'subtotal' => $item['harga'] * $item['qty']
                ]);
            }

            session()->forget('cart');

            DB::commit();

            return redirect()->route('order.success', $pemesanan->id)
                ->with('success', 'Pesanan berhasil dibuat!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function success($id)
    {
        $pemesanan = Pemesanan::with(['pelanggan', 'jenisPembayaran', 'detailPemesanans.paket'])->findOrFail($id);
        return view('pages.order-success', compact('pemesanan'));
    }
}
