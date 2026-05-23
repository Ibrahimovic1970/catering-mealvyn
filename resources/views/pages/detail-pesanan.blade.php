@extends('layouts.app')

@section('title', 'Detail Pesanan')

@section('content')
    <section style="padding: 140px 0 80px; background: #fafaf5; min-height: 100vh;">
        <div class="container" style="max-width: 900px;">

            <a href="{{ route('pesanan.saya') }}"
                style="color: #1a5632; text-decoration: none; font-weight: 600; display: inline-block; margin-bottom: 24px;">
                ← Kembali ke Pesanan Saya
            </a>

            <div style="background: white; border-radius: 16px; padding: 40px; box-shadow: 0 4px 20px rgba(0,0,0,0.06);">

                <!-- Header -->
                <div
                    style="text-align: center; margin-bottom: 32px; padding-bottom: 24px; border-bottom: 2px solid #f0f0f0;">
                    <h1 style="font-family: 'Playfair Display', serif; font-size: 2rem; color: #1a5632; margin: 0 0 8px 0;">
                        Detail Pesanan</h1>
                    <p style="color: #6b6b6b; font-size: 1rem; margin: 0;">No. Pesanan: {{ $pemesanan->no_resi }}</p>
                </div>

                <!-- Status Tracking -->
                <div
                    style="background: linear-gradient(135deg, #f0fdf4, #dcfce7); padding: 32px; border-radius: 16px; margin-bottom: 32px; border: 2px solid #bbf7d0;">
                    <h3 style="margin: 0 0 24px 0; color: #166534; font-size: 1.2rem; text-align: center;">📦 Lacak Pesanan
                        Anda</h3>

                    <div
                        style="display: flex; justify-content: space-between; align-items: center; position: relative; margin-bottom: 20px;">
                        <div style="flex: 1; text-align: center;">
                            <div
                                style="width: 50px; height: 50px; background: {{ in_array($pemesanan->status_kirim ?? '', ['Menunggu Pengiriman', 'Sedang Dikirim', 'Tiba Ditujuan']) ? '#16a34a' : '#ddd' }}; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 10px; color: white; font-weight: bold; font-size: 1.3rem;">
                                {{ in_array($pemesanan->status_kirim ?? '', ['Menunggu Pengiriman', 'Sedang Dikirim', 'Tiba Ditujuan']) ? '✓' : '○' }}
                            </div>
                            <p style="font-size: 0.9rem; color: #333; font-weight: 700; margin: 0;">Pesanan Diproses</p>
                        </div>

                        <div
                            style="flex: 1; height: 4px; background: {{ in_array($pemesanan->status_kirim ?? '', ['Sedang Dikirim', 'Tiba Ditujuan']) ? '#16a34a' : '#ddd' }};">
                        </div>

                        <div style="flex: 1; text-align: center;">
                            <div
                                style="width: 50px; height: 50px; background: {{ in_array($pemesanan->status_kirim ?? '', ['Sedang Dikirim', 'Tiba Ditujuan']) ? '#16a34a' : '#ddd' }}; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 10px; color: white; font-weight: bold; font-size: 1.3rem;">
                                {{ in_array($pemesanan->status_kirim ?? '', ['Sedang Dikirim', 'Tiba Ditujuan']) ? '✓' : '○' }}
                            </div>
                            <p style="font-size: 0.9rem; color: #333; font-weight: 700; margin: 0;">Sedang Dikirim</p>
                        </div>

                        <div
                            style="flex: 1; height: 4px; background: {{ ($pemesanan->status_kirim ?? '') == 'Tiba Ditujuan' ? '#16a34a' : '#ddd' }};">
                        </div>

                        <div style="flex: 1; text-align: center;">
                            <div
                                style="width: 50px; height: 50px; background: {{ ($pemesanan->status_kirim ?? '') == 'Tiba Ditujuan' ? '#16a34a' : '#ddd' }}; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 10px; color: white; font-weight: bold; font-size: 1.3rem;">
                                {{ ($pemesanan->status_kirim ?? '') == 'Tiba Ditujuan' ? '✓' : '○' }}
                            </div>
                            <p style="font-size: 0.9rem; color: #333; font-weight: 700; margin: 0;">Tiba Ditujuan</p>
                        </div>
                    </div>

                    @if($pemesanan->tgl_kirim)
                        <div
                            style="background: white; padding: 16px; border-radius: 10px; text-align: center; border: 1px dashed #86efac;">
                            @if($pemesanan->status_kirim == 'Sedang Dikirim')
                                <p style="color: #166534; margin: 0; font-size: 1rem;"><strong>🚚 Paket sedang dalam
                                        perjalanan</strong></p>
                                <p style="color: #6b6b6b; margin: 8px 0 0 0; font-size: 0.9rem;">Dikirim pada:
                                    {{ $pemesanan->tgl_kirim->format('d M Y, H:i') }}</p>
                            @elseif($pemesanan->status_kirim == 'Tiba Ditujuan')
                                <p style="color: #166534; margin: 0; font-size: 1rem;"><strong>✅ Paket telah sampai</strong></p>
                                <p style="color: #6b6b6b; margin: 8px 0 0 0; font-size: 0.9rem;">Sampai pada:
                                    {{ $pemesanan->tgl_sampai ? $pemesanan->tgl_sampai->format('d M Y, H:i') : $pemesanan->tgl_kirim->format('d M Y, H:i') }}
                                </p>
                            @endif
                        </div>
                    @endif
                </div>

                <!-- Informasi Pelanggan & Alamat -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 32px;">
                    <div style="background: #f9fafb; padding: 24px; border-radius: 12px;">
                        <h4 style="margin: 0 0 16px 0; color: #1a5632; font-size: 1.1rem;">👤 Informasi Pelanggan</h4>
                        <p style="margin: 6px 0; color: #333;"><strong>Nama:</strong>
                            {{ $pemesanan->pelanggan->nama_pelanggan }}</p>
                        <p style="margin: 6px 0; color: #333;"><strong>Email:</strong> {{ $pemesanan->pelanggan->email }}
                        </p>
                        <p style="margin: 6px 0; color: #333;"><strong>Telepon:</strong>
                            {{ $pemesanan->pelanggan->telepon }}</p>
                    </div>

                    <div style="background: #f9fafb; padding: 24px; border-radius: 12px; border-left: 4px solid #1a5632;">
                        <h4 style="margin: 0 0 16px 0; color: #1a5632; font-size: 1.1rem;">📍 Alamat Pengiriman</h4>
                        <p style="margin: 0; color: #333; line-height: 1.8;">{{ $pemesanan->alamat_pengiriman }}</p>
                    </div>
                </div>

                <!-- Daftar Item -->
                <h3 style="color: #1a5632; font-size: 1.2rem; margin: 32px 0 20px; font-family: 'Playfair Display', serif;">
                    📋 Daftar Pesanan</h3>
                <div style="background: #f9f9f9; border-radius: 12px; padding: 20px; margin-bottom: 24px;">
                    @foreach($pemesanan->detailPemesanans as $detail)
                        <div
                            style="display: flex; justify-content: space-between; align-items: center; padding: 16px; background: white; border-radius: 10px; margin-bottom: 12px;">
                            <div style="flex: 1;">
                                <p style="font-weight: 700; color: #333; margin: 0 0 4px 0; font-size: 1.05rem;">
                                    {{ $detail->paket->nama_paket ?? 'Paket' }}</p>
                                <p style="font-size: 0.9rem; color: #888; margin: 0;">{{ $detail->jumlah }} x Rp
                                    {{ number_format($detail->paket->harga_paket ?? 0, 0, ',', '.') }}</p>
                            </div>
                            <p style="font-weight: 700; color: #1a5632; margin: 0; font-size: 1.1rem;">Rp
                                {{ number_format($detail->subtotal, 0, ',', '.') }}</p>
                        </div>
                    @endforeach
                </div>

                <!-- Total Pembayaran -->
                <div
                    style="background: linear-gradient(135deg, #1a5632, #0e3a20); padding: 24px; border-radius: 12px; text-align: right; color: white;">
                    <p style="margin: 0 0 8px 0; font-size: 1rem; opacity: 0.9;">Total Pembayaran</p>
                    <p style="margin: 0; font-size: 2rem; font-weight: 800;">Rp
                        {{ number_format($pemesanan->total_bayar, 0, ',', '.') }}</p>
                </div>

                <!-- Bukti Foto -->
                @if($pemesanan->bukti_foto && $pemesanan->status_kirim == 'Tiba Ditujuan')
                    <div style="margin-top: 32px; text-align: center;">
                        <h4 style="color: #1a5632; margin: 0 0 16px 0; font-size: 1.1rem;">📸 Bukti Pengiriman</h4>
                        <img src="{{ asset('storage/' . $pemesanan->bukti_foto) }}" alt="Bukti Pengiriman"
                            style="max-width: 400px; width: 100%; border-radius: 12px; border: 4px solid #e5e7eb; cursor: pointer;"
                            onclick="window.open(this.src, '_blank')">
                        <p style="color: #6b6b6b; font-size: 0.85rem; margin-top: 12px;">Klik foto untuk memperbesar</p>
                    </div>
                @endif

            </div>
        </div>
    </section>
@endsection