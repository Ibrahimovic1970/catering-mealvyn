@extends('layouts.app')

@section('title', 'Pesanan Saya')

@section('content')
    <section style="padding: 140px 0 80px; background: #fafaf5; min-height: 100vh;">
        <div class="container" style="max-width: 1000px;">
            <h1
                style="text-align: center; font-family: 'Playfair Display', serif; font-size: 2.5rem; color: #1a5632; margin-bottom: 40px;">
                Pesanan Saya</h1>

            @php
                $user = auth()->user();
                $pelanggan = \App\Models\Pelanggan::where('email', $user->email)->first();
                $pemesanans = $pelanggan ? \App\Models\Pemesanan::where('id_pelanggan', $pelanggan->id)
                    ->with(['pelanggan', 'detailPemesanans.paket'])
                    ->latest()
                    ->paginate(10) : collect([]);
            @endphp

            @if($pemesanans->count() > 0)
                @foreach($pemesanans as $pesanan)
                    <div
                        style="background: white; border-radius: 16px; padding: 32px; margin-bottom: 24px; box-shadow: 0 4px 20px rgba(0,0,0,0.06);">

                        <div
                            style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; padding-bottom: 20px; border-bottom: 2px solid #f0f0f0;">
                            <div>
                                <h3 style="font-size: 1.2rem; color: #1a1a1a; margin-bottom: 6px; font-weight: 700;">No. Pesanan:
                                    {{ $pesanan->no_resi }}</h3>
                                <p style="color: #6b6b6b; font-size: 0.9rem; margin: 0;">📅
                                    {{ $pesanan->tgl_pesan->format('d M Y, H:i') }}</p>
                            </div>
                            <span style="padding: 8px 20px; border-radius: 20px; font-size: 0.85rem; font-weight: 700; background: 
                                    @if($pesanan->status_pesan == 'Menunggu Konfirmasi') #fef3c7; color: #92400e;
                                    @elseif($pesanan->status_pesan == 'Sedang Diproses') #dbeafe; color: #1e40af;
                                    @elseif($pesanan->status_pesan == 'Selesai') #d1fae5; color: #065f46;
                                    @else #fee2e2; color: #dc2626; @endif">
                                {{ $pesanan->status_pesan }}
                            </span>
                        </div>

                        <!-- ALAMAT PENGIRIMAN -->
                        <div
                            style="background: #f9fafb; padding: 20px; border-radius: 12px; margin-bottom: 24px; border-left: 4px solid #1a5632;">
                            <h4 style="margin: 0 0 12px 0; color: #1a5632; font-size: 1rem; font-weight: 700;">📍 Alamat Pengiriman
                            </h4>
                            <p style="margin: 4px 0; color: #333; line-height: 1.6;">
                                <strong>{{ $pesanan->pelanggan->nama_pelanggan }}</strong><br>
                                {{ $pesanan->alamat_pengiriman ?? 'Alamat tidak tersedia' }}<br>
                                📞 {{ $pesanan->pelanggan->telepon }}
                            </p>
                        </div>

                        @foreach($pesanan->detailPemesanans as $detail)
                            <div style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid #eee;">
                                <span>{{ $detail->paket->nama_paket }} ({{ $detail->jumlah }}x)</span>
                                <strong>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</strong>
                            </div>
                        @endforeach

                        <div
                            style="margin-top: 20px; padding-top: 20px; border-top: 2px solid #1a5632; display: flex; justify-content: space-between;">
                            <span style="font-size: 1.1rem; font-weight: 700;">Total Bayar</span>
                            <span style="font-size: 1.3rem; font-weight: 800; color: #1a5632;">Rp
                                {{ number_format($pesanan->total_bayar, 0, ',', '.') }}</span>
                        </div>

                        <div style="text-align: center; margin-top: 20px;">
                            <a href="{{ route('pesanan.show', $pesanan->id) }}"
                                style="display: inline-block; padding: 12px 32px; background: #1a5632; color: white; border-radius: 8px; text-decoration: none; font-weight: 600;">
                                Lihat Detail →
                            </a>
                        </div>
                    </div>
                @endforeach

                <div style="margin-top: 30px;">
                    {{ $pemesanans->links() }}
                </div>
            @else
                <div style="text-align: center; padding: 80px 40px; background: white; border-radius: 16px;">
                    <div style="font-size: 5rem; margin-bottom: 20px;">📦</div>
                    <h3>Belum Ada Pesanan</h3>
                    <a href="{{ route('menu') }}"
                        style="display: inline-block; padding: 14px 32px; background: #1a5632; color: white; border-radius: 50px; text-decoration: none; margin-top: 20px;">Lihat
                        Menu</a>
                </div>
            @endif
        </div>
    </section>
@endsection