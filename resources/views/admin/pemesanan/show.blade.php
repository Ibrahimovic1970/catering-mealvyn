@extends('layouts.app')

@section('title', 'Detail Pesanan')

@section('content')
    <div class="container" style="padding: 140px 20px 80px; background: #fafaf5; min-height: 100vh;">
        <div style="margin-bottom: 24px;">
            <a href="{{ route('admin.pemesanan.index') }}"
                style="color: #1a5632; text-decoration: none; font-weight: 600; font-size: 1rem;">
                ← Kembali ke Daftar Pesanan
            </a>
        </div>

        @if(session('success'))
            <div
                style="background: #d1fae5; border-left: 4px solid #10b981; color: #065f46; padding: 16px 20px; border-radius: 8px; margin-bottom: 24px;">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div
                style="background: #fee2e2; border-left: 4px solid #dc2626; color: #dc2626; padding: 16px 20px; border-radius: 8px; margin-bottom: 24px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Informasi Pesanan -->
        <div
            style="background: #fff; padding: 32px; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); margin-bottom: 24px;">
            <h2
                style="margin-top: 0; color: #1a5632; font-family: 'Playfair Display', serif; font-size: 1.8rem; margin-bottom: 24px;">
                📦 Detail Pesanan #{{ $pemesanan->no_resi }}</h2>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 24px;">
                <div>
                    <h3 style="color: #333; font-size: 1.1rem; margin-bottom: 12px; font-weight: 600;">Informasi Pelanggan
                    </h3>
                    <p style="margin: 6px 0; color: #555;"><strong>Nama:</strong>
                        {{ $pemesanan->pelanggan->nama_pelanggan }}</p>
                    <p style="margin: 6px 0; color: #555;"><strong>Email:</strong> {{ $pemesanan->pelanggan->email }}</p>
                    <p style="margin: 6px 0; color: #555;"><strong>Telepon:</strong> {{ $pemesanan->pelanggan->telepon }}
                    </p>
                    <p style="margin: 6px 0; color: #555;"><strong>Alamat:</strong> {{ $pemesanan->alamat_pengiriman }}</p>
                </div>
                <div>
                    <h3 style="color: #333; font-size: 1.1rem; margin-bottom: 12px; font-weight: 600;">Informasi Pesanan
                    </h3>
                    <p style="margin: 6px 0; color: #555;"><strong>Tanggal:</strong>
                        {{ $pemesanan->tgl_pesan->format('d M Y, H:i') }}</p>
                    <p style="margin: 6px 0; color: #555;"><strong>Total Bayar:</strong> <span
                            style="color: #1a5632; font-weight: 700; font-size: 1.1rem;">Rp
                            {{ number_format($pemesanan->total_bayar, 0, ',', '.') }}</span></p>
                    <p style="margin: 6px 0; color: #555;"><strong>Ongkir:</strong> Rp
                        {{ number_format($pemesanan->ongkir, 0, ',', '.') }}</p>
                    <p style="margin: 6px 0; color: #555;"><strong>Status:</strong> <span
                            style="background: #fef3c7; color: #92400e; padding: 4px 12px; border-radius: 20px; font-size: 0.85rem; font-weight: 600;">{{ $pemesanan->status_pesan }}</span>
                    </p>
                </div>
            </div>

            <!-- Daftar Item -->
            <h3 style="color: #333; font-size: 1.1rem; margin: 32px 0 16px; font-weight: 600;">📋 Item Pesanan</h3>
            <div style="background: #f9f9f9; border-radius: 12px; padding: 20px;">
                @foreach($pemesanan->detailPemesanans as $detail)
                    <div
                        style="display: flex; justify-content: space-between; align-items: center; padding: 16px; background: white; border-radius: 8px; margin-bottom: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                        <div>
                            <p style="margin: 0; font-weight: 600; color: #333; font-size: 1.05rem;">
                                {{ $detail->paket->nama_paket ?? 'Paket tidak tersedia' }}</p>
                            <p style="margin: 4px 0 0; color: #888; font-size: 0.9rem;">{{ $detail->jumlah }} x Rp
                                {{ number_format($detail->paket->harga_paket ?? 0, 0, ',', '.') }}</p>
                        </div>
                        <p style="margin: 0; font-weight: 700; color: #1a5632; font-size: 1.1rem;">Rp
                            {{ number_format($detail->subtotal, 0, ',', '.') }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- FORM UPDATE STATUS & PENGIRIMAN -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">

            <!-- FORM 1: UPDATE STATUS PESANAN -->
            <div style="background: #fff; padding: 32px; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.05);">
                <h3
                    style="margin-top: 0; color: #1a5632; font-family: 'Playfair Display', serif; font-size: 1.3rem; margin-bottom: 20px;">
                    📦 Status Pesanan</h3>
                <div
                    style="background: #f0fdf4; padding: 16px; border-radius: 12px; margin-bottom: 24px; font-weight: 700; color: #166534; text-align: center; font-size: 1.1rem; border: 2px solid #bbf7d0;">
                    {{ $pemesanan->status_pesan }}
                </div>

                <form action="{{ route('admin.pemesanan.updateStatus', $pemesanan->id) }}" method="POST">
                    @csrf
                    <div style="margin-bottom: 24px;">
                        <label
                            style="display: block; margin-bottom: 10px; font-weight: 600; font-size: 0.95rem; color: #333;">Ubah
                            Status:</label>
                        <select name="status_pesan"
                            style="width: 100%; padding: 14px; border: 2px solid #e0e0e0; border-radius: 10px; font-size: 1rem; background: #fff; transition: all 0.3s;"
                            onfocus="this.style.borderColor='#1a5632'" onblur="this.style.borderColor='#e0e0e0'">
                            <option value="Menunggu Konfirmasi" @selected($pemesanan->status_pesan == 'Menunggu Konfirmasi')>⏳
                                Menunggu Konfirmasi</option>
                            <option value="Sedang Diproses" @selected($pemesanan->status_pesan == 'Sedang Diproses')>🔥 Sedang
                                Diproses</option>
                            <option value="Menunggu Kurir" @selected($pemesanan->status_pesan == 'Menunggu Kurir')>🚚 Menunggu
                                Kurir</option>
                            <option value="Selesai" @selected($pemesanan->status_pesan == 'Selesai')>✅ Selesai</option>
                            <option value="Dibatalkan" @selected($pemesanan->status_pesan == 'Dibatalkan')>❌ Dibatalkan
                            </option>
                        </select>
                    </div>
                    <button type="submit"
                        style="width: 100%; padding: 16px; background: linear-gradient(135deg, #1a5632, #0e3a20); color: white; border: none; border-radius: 12px; font-weight: 700; font-size: 1rem; cursor: pointer; transition: all 0.3s; box-shadow: 0 4px 15px rgba(26,86,50,0.3);"
                        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(26,86,50,0.4)'"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(26,86,50,0.3)'">
                        Update Status Pesanan
                    </button>
                </form>
            </div>

            <!-- FORM 2: UPDATE INFORMASI PENGIRIMAN -->
            <div style="background: #fff; padding: 32px; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.05);">
                <h3
                    style="margin-top: 0; color: #1a5632; font-family: 'Playfair Display', serif; font-size: 1.3rem; margin-bottom: 24px;">
                    🚛 Informasi Pengiriman</h3>

                <form action="{{ route('admin.pemesanan.updateShipping', $pemesanan->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <div style="margin-bottom: 20px;">
                        <label
                            style="display: block; margin-bottom: 10px; font-weight: 600; font-size: 0.95rem; color: #333;">Status
                            Kirim:</label>
                        <select name="status_kirim"
                            style="width: 100%; padding: 14px; border: 2px solid #e0e0e0; border-radius: 10px; font-size: 1rem; background: #fff; transition: all 0.3s;"
                            onfocus="this.style.borderColor='#1a5632'" onblur="this.style.borderColor='#e0e0e0'">
                            <option value="Menunggu Pengiriman" @selected(($pemesanan->status_kirim ?? 'Menunggu Pengiriman') == 'Menunggu Pengiriman')>📦 Menunggu Pengiriman</option>
                            <option value="Sedang Dikirim" @selected(($pemesanan->status_kirim ?? 'Sedang Dikirim') == 'Sedang Dikirim')>🚛 Sedang Dikirim</option>
                            <option value="Tiba Ditujuan" @selected(($pemesanan->status_kirim ?? 'Tiba Ditujuan') == 'Tiba Ditujuan')>✅ Tiba Ditujuan</option>
                        </select>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 24px;">
                        <div>
                            <label
                                style="display: block; margin-bottom: 10px; font-weight: 600; font-size: 0.95rem; color: #333;">Tanggal
                                & Jam Kirim</label>
                            <input type="datetime-local" name="tgl_kirim"
                                value="{{ old('tgl_kirim', $pemesanan->tgl_kirim ? $pemesanan->tgl_kirim->format('Y-m-d\TH:i') : '') }}"
                                style="width: 100%; padding: 14px; border: 2px solid #e0e0e0; border-radius: 10px; font-size: 0.95rem; background: #fafafa;"
                                onfocus="this.style.borderColor='#1a5632'; this.style.background='#fff'"
                                onblur="this.style.borderColor='#e0e0e0'; this.style.background='#fafafa'">
                        </div>
                        <div>
                            <label
                                style="display: block; margin-bottom: 10px; font-weight: 600; font-size: 0.95rem; color: #333;">Tanggal
                                & Jam Sampai</label>
                            <input type="datetime-local" name="tgl_sampai"
                                value="{{ old('tgl_sampai', $pemesanan->tgl_sampai ? $pemesanan->tgl_sampai->format('Y-m-d\TH:i') : '') }}"
                                style="width: 100%; padding: 14px; border: 2px solid #e0e0e0; border-radius: 10px; font-size: 0.95rem; background: #fafafa;"
                                onfocus="this.style.borderColor='#1a5632'; this.style.background='#fff'"
                                onblur="this.style.borderColor='#e0e0e0'; this.style.background='#fafafa'">
                        </div>
                    </div>

                    <div style="margin-bottom: 28px;">
                        <label
                            style="display: block; margin-bottom: 10px; font-weight: 600; font-size: 0.95rem; color: #333;">Bukti
                            Foto Pengiriman:</label>
                        <input type="file" name="bukti_foto" accept="image/*"
                            style="width: 100%; padding: 14px; border: 2px dashed #ccc; border-radius: 10px; background: #fafafa; cursor: pointer;"
                            onmouseover="this.style.borderColor='#1a5632'" onmouseout="this.style.borderColor='#ccc'">
                        <small style="color: #6b6b6b; font-size: 0.85rem; display: block; margin-top: 8px;">📷 Upload foto
                            saat pesanan sampai ke pelanggan (max 2MB)</small>

                        @if($pemesanan->bukti_foto)
                            <div style="margin-top: 16px; padding: 12px; background: #f9f9f9; border-radius: 10px;">
                                <p style="font-size: 0.9rem; margin-bottom: 10px; font-weight: 600; color: #333;">📸 Foto saat
                                    ini:</p>
                                <img src="{{ asset('storage/' . $pemesanan->bukti_foto) }}" alt="Bukti Pengiriman"
                                    style="width: 100%; max-width: 200px; height: auto; object-fit: cover; border-radius: 8px; border: 3px solid #e5e7eb;">
                            </div>
                        @endif
                    </div>

                    <button type="submit"
                        style="width: 100%; padding: 16px; background: linear-gradient(135deg, #16a34a, #15803d); color: white; border: none; border-radius: 12px; font-weight: 700; font-size: 1rem; cursor: pointer; transition: all 0.3s; box-shadow: 0 4px 15px rgba(22,163,74,0.3);"
                        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(22,163,74,0.4)'"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(22,163,74,0.3)'">
                        Update Informasi Pengiriman
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection