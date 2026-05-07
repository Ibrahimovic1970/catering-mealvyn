@extends('layouts.app')
@section('title', 'Pesanan Berhasil')

@section('content')
<section style="padding: 150px 0 100px; background: #f9f5ed; min-height: 100vh; display: flex; align-items: center;">
    <div class="container">
        <div style="max-width: 650px; margin: 0 auto; background: white; border-radius: 24px; padding: 40px; box-shadow: var(--shadow); text-align: center;">
            <div style="width: 80px; height: 80px; background: #1a5632; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2.5rem; margin: 0 auto 20px;">✓</div>
            <h1 style="font-size: 2rem; margin-bottom: 10px;">Pesanan Berhasil!</h1>
            <p style="color: #6b6b6b; margin-bottom: 30px;">Terima kasih. Pesanan Anda sedang diproses.</p>

            <div style="background: #f9f5ed; border-radius: 16px; padding: 20px; margin-bottom: 25px; text-align: left;">
                <h3 style="margin-bottom: 15px; font-size: 1.2rem;">Detail Pesanan</h3>
                <div style="display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #e0d8c8;">
                    <span style="color: #6b6b6b;">No. Resi:</span>
                    <strong style="color: #1a5632;">{{ $pemesanan->no_resi }}</strong>
                </div>
                <div style="display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #e0d8c8;">
                    <span style="color: #6b6b6b;">Tanggal:</span>
                    <strong>{{ \Carbon\Carbon::parse($pemesanan->tgl_pesan)->format('d F Y') }}</strong>
                </div>
                <div style="display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #e0d8c8;">
                    <span style="color: #6b6b6b;">Status:</span>
                    <span style="background: rgba(26,86,50,0.1); color: #1a5632; padding: 4px 10px; border-radius: 20px; font-size: 0.85rem; font-weight: 600;">{{ $pemesanan->status_pesan }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; padding: 8px 0; font-size: 1.1rem; font-weight: 700; color: #1a5632;">
                    <span>Total:</span>
                    <span>Rp {{ number_format($pemesanan->total_bayar * 1.15, 0, ',', '.') }}</span>
                </div>
            </div>

            <div style="text-align: left; margin-bottom: 25px;">
                <h4 style="margin-bottom: 10px;">Item:</h4>
                @foreach($pemesanan->detailPemesanans as $detail)
                <div style="display: flex; justify-content: space-between; padding: 6px 0; color: #555;">
                    <span>{{ $detail->paket->nama_paket }}</span>
                    <span>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</span>
                </div>
                @endforeach
            </div>

            @if($pemesanan->jenisPembayaran)
            <div style="background: #f0fdf4; border-radius: 16px; padding: 20px; margin-bottom: 25px; text-align: left;">
                <h4 style="margin-bottom: 10px; color: #1a5632;">Info Pembayaran</h4>
                <p><strong>Metode:</strong> {{ $pemesanan->jenisPembayaran->metode_pembayaran }}</p>
                @foreach($pemesanan->jenisPembayaran->detailJenisPembayarans as $d)
                <p><strong>{{ $d->tempat_bayar }}:</strong> {{ $d->no_rek }}</p>
                @endforeach
            </div>
            @endif

            <div style="display: flex; gap: 15px; justify-content: center;">
                <a href="{{ route('home') }}" style="padding: 12px 28px; border-radius: 50px; background: #1a5632; color: white; text-decoration: none; font-weight: 600;">Ke Beranda</a>
                <button onclick="window.print()" style="padding: 12px 28px; border-radius: 50px; background: white; border: 2px solid #1a5632; color: #1a5632; font-weight: 600; cursor: pointer;">Cetak</button>
            </div>
        </div>
    </div>
</section>
@endsection