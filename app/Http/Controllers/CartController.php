<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\Pemesanan;
use App\Models\DetailPemesanan;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CartController extends Controller
{
    /**
     * Display the cart
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('pages.cart', compact('cart'));
    }

    /**
     * Add item to cart
     */
    public function add(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:pakets,id'
        ]);

        $paket = Paket::findOrFail($request->id);
        $cart = session()->get('cart', []);
        $id = $paket->id;

        if (isset($cart[$id])) {
            $cart[$id]['qty']++;
        } else {
            $cart[$id] = [
                "id" => $paket->id,
                "nama_paket" => $paket->nama_paket,
                "jumlah_pax" => $paket->jumlah_pax,
                "harga_paket" => $paket->harga_paket,
                "qty" => 1
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Paket berhasil ditambahkan ke keranjang!');
    }

    /**
     * Update cart item quantity
     */
    public function update(Request $request)
    {
        $cart = session()->get('cart', []);
        $id = $request->id;

        if (isset($cart[$id])) {
            $cart[$id]['qty'] = $request->qty;
        }

        session()->put('cart', $cart);
        return redirect()->back();
    }

    /**
     * Remove item from cart
     */
    public function remove($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
        }
        session()->put('cart', $cart);
        return redirect()->back();
    }

    /**
     * Show checkout page
     */
    public function checkout()
    {
        $cart = session()->get('cart', []);

        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += ($item['harga_paket'] ?? 0) * ($item['qty'] ?? 1);
        }

        return view('pages.checkout', compact('cart', 'subtotal'));
    }

    /**
     * Process checkout and create order
     */
    public function processCheckout(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'telepon' => 'required|string',
            'alamat' => 'required|string|max:500',
            'provinsi' => 'required|string',
            'kota' => 'required|string',
            'kecamatan' => 'required|string',
            'metode_pembayaran' => 'required|string',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Keranjang kosong!');
        }

        try {
            DB::beginTransaction();

            $user = Auth::user();

            // Create or find pelanggan
            $pelanggan = Pelanggan::firstOrCreate(
                ['email' => $user->email],
                [
                    'nama_pelanggan' => $request->nama_pelanggan,
                    'telepon' => $request->telepon,
                    'alamat1' => $request->alamat,
                    'alamat2' => $request->kota . ', ' . $request->provinsi,
                    'alamat3' => $request->kecamatan,
                    'password' => Hash::make($request->telepon),
                ]
            );

            if (!$pelanggan->wasRecentlyCreated) {
                $pelanggan->update([
                    'nama_pelanggan' => $request->nama_pelanggan,
                    'telepon' => $request->telepon,
                    'alamat1' => $request->alamat,
                    'alamat2' => $request->kota . ', ' . $request->provinsi,
                    'alamat3' => $request->kecamatan,
                ]);
            }

            // Calculate shipping cost
            $ongkir = 0;
            switch ($request->provinsi) {
                case 'DKI Jakarta':
                    $ongkir = 15000;
                    break;
                case 'Jawa Barat':
                case 'Banten':
                    $ongkir = 25000;
                    break;
                case 'Jawa Tengah':
                case 'DI Yogyakarta':
                case 'Jawa Timur':
                    $ongkir = 35000;
                    break;
                case 'Bali':
                    $ongkir = 50000;
                    break;
                default:
                    $ongkir = 75000;
                    break;
            }

            // Calculate total
            $subtotal = 0;
            foreach ($cart as $item) {
                $subtotal += ($item['harga_paket'] ?? 0) * ($item['qty'] ?? 1);
            }
            $totalBayar = $subtotal + $ongkir;

            // Create pemesanan with COMPLETE address
            $pemesanan = Pemesanan::create([
                'no_resi' => 'INV-' . time(),
                'id_pelanggan' => $pelanggan->id,
                'tgl_pesan' => now(),
                'total_bayar' => $totalBayar,
                'status_pesan' => 'Menunggu Konfirmasi',
                'alamat_pengiriman' => $request->alamat . ', Kec. ' . $request->kecamatan . ', ' . $request->kota . ', ' . $request->provinsi,
                'ongkir' => $ongkir,
            ]);

            // Create detail pemesanan
            foreach ($cart as $item) {
                DetailPemesanan::create([
                    'id_pesan' => $pemesanan->id,
                    'id_paket' => $item['id'],
                    'jumlah' => $item['qty'],
                    'subtotal' => ($item['harga_paket'] ?? 0) * ($item['qty'] ?? 1),
                ]);
            }

            DB::commit();
            session()->forget('cart');

            return redirect()->route('pages.order-success', $pemesanan->id)
                ->with('success', 'Pesanan berhasil dibuat! Nomor resi: ' . $pemesanan->no_resi);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal memproses pesanan: ' . $e->getMessage());
        }
    }

    /**
     * Show order success page
     */
    public function success($id)
    {
        $pemesanan = Pemesanan::with(['detailPemesanans.paket', 'pelanggan'])
            ->findOrFail($id);

        return view('pages.order-success', compact('pemesanan'));
    }
}