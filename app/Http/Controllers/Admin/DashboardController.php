<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemesanan;
use App\Models\User;
use App\Models\Paket;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Statistik berdasarkan role
        if ($user->isCEO() || $user->isAdmin()) {
            // CEO & Admin lihat semua data
            $totalPesanan = Pemesanan::count();
            $totalPelanggan = User::where('level', 'pelanggan')->count();
            $totalPaket = Paket::count();
            $totalPendapatan = Pemesanan::sum('total_bayar');
            $pesananTerbaru = Pemesanan::with(['pelanggan', 'detailPemesanans.paket'])
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get();
        } else {
            // Pelanggan hanya lihat data mereka
            $totalPesanan = Pemesanan::where('id_pelanggan', $user->id)->count();
            $totalPelanggan = 0;
            $totalPaket = Paket::count();
            $totalPendapatan = Pemesanan::where('id_pelanggan', $user->id)->sum('total_bayar');
            $pesananTerbaru = Pemesanan::where('id_pelanggan', $user->id)
                ->with(['pelanggan', 'detailPemesanans.paket'])
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get();
        }

        // Redirect berdasarkan role
        if ($user->isCEO() || $user->isAdmin()) {
            return view('admin.dashboard', compact(
                'totalPesanan',
                'totalPelanggan',
                'totalPaket',
                'totalPendapatan',
                'pesananTerbaru'
            ));
        } else {
            return view('pelanggan.dashboard', compact(
                'totalPesanan',
                'totalPelanggan',
                'totalPaket',
                'totalPendapatan',
                'pesananTerbaru'
            ));
        }
    }
}
