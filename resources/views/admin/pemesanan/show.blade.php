@extends('admin.layouts.admin')

@section('title', 'Detail Pesanan - ' . $pemesanan->no_resi)
@section('page-title', 'Detail Pesanan')

@section('content')
<div style="margin-bottom: 24px;">
    <a href="{{ route('admin.pemesanan.index') }}" style="display: inline-flex; align-items: center; gap: 8px; color: var(--primary); text-decoration: none; font-weight: 500; margin-bottom: 20px;">
        <span>←</span> Kembali ke Daftar Pesanan
    </a>
</div>

<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">

    <!-- KOLOM KIRI: INFO PESANAN & CUSTOMER -->
    <div>
        <!-- Status Badge & No Resi -->
        <div class="card" style="margin-bottom: 24px;">
            <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <h3 style="margin-bottom: 4px;">No. Resi: {{ $pemesanan->no_resi }}</h3>
                    <p style="color: var(--gray); font-size: 0.9rem;">{{ \Carbon\Carbon::parse($pemesanan->tgl_pesan)->format('d F Y, H:i') }}</p>
                </div>
                @php
                $badgeClass = 'badge-primary';
                $statusIcon = '';
                switch($pemesanan->status_pesan) {
                case 'Menunggu Konfirmasi': $badgeClass = 'badge-warning'; $statusIcon = '⏳'; break;
                case 'Sedang Diproses': $badgeClass = 'badge-info'; $statusIcon = '🔥'; break;
                case 'Menunggu Kurir': $badgeClass = 'badge-primary'; $statusIcon = '🚚'; break;
                case 'Selesai': $badgeClass = 'badge-success'; $statusIcon = '✅'; break;
                case 'Dibatalkan': $badgeClass = 'badge-danger'; $statusIcon = '❌'; break;
                }
                @endphp
                <span class="badge {{ $badgeClass }}" style="font-size: 1rem; padding: 8px 16px;">
                    {{ $statusIcon }} {{ $pemesanan->status_pesan }}
                </span>
            </div>
        </div>

        <!-- Informasi Pelanggan -->
        <div class="card" style="margin-bottom: 24px;">
            <div class="card-header">
                <h3>👤 Informasi Pelanggan</h3>
            </div>
            <div class="card-body">
                <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 20px; padding-bottom: 20px; border-bottom: 1px solid #eee;">
                    <div style="width: 60px; height: 60px; background: var(--primary); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; font-weight: bold;">
                        {{ strtoupper(substr($pemesanan->pelanggan->nama_pelanggan, 0, 1)) }}
                    </div>
                    <div>
                        <h4 style="margin-bottom: 4px;">{{ $pemesanan->pelanggan->nama_pelanggan }}</h4>
                        <p style="color: var(--gray); font-size: 0.9rem;">{{ $pemesanan->pelanggan->email }}</p>
                    </div>
                </div>

                <div style="margin-bottom: 12px;">
                    <strong style="color: var(--gray); font-size: 0.85rem; text-transform: uppercase;">📞 Telepon</strong>
                    <p style="margin-top: 4px;">{{ $pemesanan->pelanggan->telepon ?? '-' }}</p>
                </div>

                <div>
                    <strong style="color: var(--gray); font-size: 0.85rem; text-transform: uppercase;">📍 Alamat Pengiriman</strong>
                    <p style="margin-top: 4px; line-height: 1.6;">{{ $pemesanan->pelanggan->alamat1 ?? '-' }}<br>
                        @if($pemesanan->pelanggan->alamat2)
                        {{ $pemesanan->pelanggan->alamat2 }}<br>
                        @endif
                        @if($pemesanan->pelanggan->alamat3)
                        {{ $pemesanan->pelanggan->alamat3 }}
                        @endif
                    </p>
                </div>
            </div>
        </div>

        <!-- Detail Item Pesanan -->
        <div class="card" style="margin-bottom: 24px;">
            <div class="card-header">
                <h3>📦 Detail Pesanan</h3>
            </div>
            <div class="card-body" style="padding: 0;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead style="background: var(--light);">
                        <tr>
                            <th style="padding: 12px 16px; text-align: left; font-weight: 600; color: var(--gray); font-size: 0.85rem; border-bottom: 1px solid #eee;">Paket</th>
                            <th style="padding: 12px 16px; text-align: right; font-weight: 600; color: var(--gray); font-size: 0.85rem; border-bottom: 1px solid #eee;">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pemesanan->detailPemesanans as $detail)
                        <tr style="border-bottom: 1px solid #eee;">
                            <td style="padding: 16px;">
                                <strong>{{ $detail->paket->nama_paket }}</strong>
                                <br><small style="color: var(--gray);">{{ $detail->paket->jumlah_pax }} Pax | {{ $detail->paket->jenis }}</small>
                            </td>
                            <td style="padding: 16px; text-align: right; font-weight: 600;">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot style="background: #f9f9f9;">
                        <tr>
                            <td style="padding: 16px; font-weight: 700; font-size: 1.1rem;">Total Pembayaran</td>
                            <td style="padding: 16px; text-align: right; font-weight: 700; font-size: 1.3rem; color: var(--primary);">Rp {{ number_format($pemesanan->total_bayar, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <!-- Metode Pembayaran -->
        @if($pemesanan->jenisPembayaran)
        <div class="card" style="margin-bottom: 24px;">
            <div class="card-header">
                <h3>💳 Metode Pembayaran</h3>
            </div>
            <div class="card-body">
                <div style="background: #f0f9ff; border: 1px solid #bae6fd; border-radius: 12px; padding: 16px; margin-bottom: 12px;">
                    <strong style="color: #0369a1; display: block; margin-bottom: 8px;">{{ $pemesanan->jenisPembayaran->metode_pembayaran }}</strong>
                    @if($pemesanan->jenisPembayaran->detailJenisPembayarans->count())
                    @foreach($pemesanan->jenisPembayaran->detailJenisPembayarans as $rek)
                    <div style="margin-bottom: 8px; padding-bottom: 8px; {{ !$loop->last ? 'border-bottom: 1px dashed #bae6fd;' : '' }}">
                        <div style="font-size: 0.9rem; color: #64748b;">{{ $rek->tempat_bayar }}</div>
                        <div style="font-size: 1.1rem; font-weight: 700; color: #0369a1; letter-spacing: 1px;">{{ $rek->no_rek }}</div>
                    </div>
                    @endforeach
                    @endif
                </div>
                <p style="font-size: 0.85rem; color: var(--gray);">
                    <strong>Catatan:</strong> Pastikan pembayaran sudah dikonfirmasi sebelum memproses pesanan.
                </p>
            </div>
        </div>
        @endif
    </div>

    <!-- KOLOM KANAN: UPDATE STATUS & PENGIRIMAN -->
    <div>
        <!-- Update Status Pesanan -->
        <div class="card" style="margin-bottom: 24px;">
            <div class="card-header">
                <h3>🔄 Update Status Pesanan</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.pemesanan.update-status', $pemesanan->id) }}" method="POST">
                    @csrf

                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 500; color: var(--gray);">Status Saat Ini:</label>
                        <div style="padding: 12px 16px; background: #f0fdf4; border: 1px solid #86efac; border-radius: 8px; font-weight: 600; color: #166534;">
                            {{ $statusIcon }} {{ $pemesanan->status_pesan }}
                        </div>
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 500;">Ubah Status:</label>
                        <select name="status_pesan" required style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 1rem; font-family: inherit;">
                            <option value="Menunggu Konfirmasi" {{ $pemesanan->status_pesan == 'Menunggu Konfirmasi' ? 'selected' : '' }}>⏳ Menunggu Konfirmasi</option>
                            <option value="Sedang Diproses" {{ $pemesanan->status_pesan == 'Sedang Diproses' ? 'selected' : '' }}>🔥 Sedang Diproses</option>
                            <option value="Menunggu Kurir" {{ $pemesanan->status_pesan == 'Menunggu Kurir' ? 'selected' : '' }}>🚚 Menunggu Kurir</option>
                            <option value="Selesai" {{ $pemesanan->status_pesan == 'Selesai' ? 'selected' : '' }}>✅ Selesai</option>
                            <option value="Dibatalkan" {{ $pemesanan->status_pesan == 'Dibatalkan' ? 'selected' : '' }}>❌ Dibatalkan</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary" style="width: 100%;">
                        Update Status Pesanan
                    </button>
                </form>
            </div>
        </div>

        <!-- Informasi Pengiriman -->
        <div class="card">
            <div class="card-header">
                <h3>🚚 Informasi Pengiriman</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.pemesanan.update-pengiriman', $pemesanan->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div style="margin-bottom: 16px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 500;">Status Kirim:</label>
                        <select name="status_kirim" required style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 1rem; font-family: inherit;">
                            <option value="Sedang Dikirim" {{ ($pemesanan->pengiriman->status_kirim ?? '') == 'Sedang Dikirim' ? 'selected' : '' }}>🚚 Sedang Dikirim</option>
                            <option value="Tiba Ditujuan" {{ ($pemesanan->pengiriman->status_kirim ?? '') == 'Tiba Ditujuan' ? 'selected' : '' }}>✅ Tiba Ditujuan</option>
                        </select>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                        <div>
                            <label style="display: block; margin-bottom: 8px; font-weight: 500;">Tanggal Kirim:</label>
                            <input type="datetime-local" name="tgl_kirim"
                                value="{{ $pemesanan->pengiriman && $pemesanan->pengiriman->tgl_kirim ? \Carbon\Carbon::parse($pemesanan->pengiriman->tgl_kirim)->format('Y-m-d\TH:i') : '' }}"
                                style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 1rem;">
                        </div>
                        <div>
                            <label style="display: block; margin-bottom: 8px; font-weight: 500;">Tanggal Tiba:</label>
                            <input type="datetime-local" name="tgl_tiba"
                                value="{{ $pemesanan->pengiriman && $pemesanan->pengiriman->tgl_tiba ? \Carbon\Carbon::parse($pemesanan->pengiriman->tgl_tiba)->format('Y-m-d\TH:i') : '' }}"
                                style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 1rem;">
                        </div>
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 500;">Bukti Foto Pengiriman:</label>
                        <input type="file" name="bukti_foto" accept="image/*"
                            style="width: 100%; padding: 10px; border: 2px dashed #e0e0e0; border-radius: 8px; cursor: pointer;">
                        <small style="color: var(--gray); font-size: 0.85rem;">Upload foto saat pesanan sampai ke pelanggan</small>

                        @if($pemesanan->pengiriman && $pemesanan->pengiriman->bukti_foto)
                        <div style="margin-top: 12px;">
                            <p style="font-size: 0.85rem; color: var(--gray); margin-bottom: 8px;">📸 Foto saat ini:</p>
                            <img src="{{ asset('storage/' . $pemesanan->pengiriman->bukti_foto) }}" alt="Bukti Pengiriman"
                                style="max-width: 100%; border-radius: 8px; border: 2px solid var(--light); box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                        </div>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-success" style="width: 100%;">
                        Update Informasi Pengiriman
                    </button>
                </form>
            </div>
        </div>

        <!-- Timeline Status (Visual) -->
        <div class="card" style="margin-top: 24px;">
            <div class="card-header">
                <h3>📊 Timeline Pesanan</h3>
            </div>
            <div class="card-body">
                <div style="position: relative; padding: 20px 0;">
                    @php
                    $steps = [
                    ['Menunggu Konfirmasi', '⏳', 'Pesanan diterima sistem'],
                    ['Sedang Diproses', '🔥', 'Pesanan sedang disiapkan'],
                    ['Menunggu Kurir', '🚚', 'Menunggu pengiriman'],
                    ['Selesai', '✅', 'Pesanan sampai'],
                    ];

                    $currentStep = 0;
                    switch($pemesanan->status_pesan) {
                    case 'Sedang Diproses': $currentStep = 1; break;
                    case 'Menunggu Kurir': $currentStep = 2; break;
                    case 'Selesai': $currentStep = 3; break;
                    case 'Dibatalkan': $currentStep = -1; break;
                    }
                    @endphp

                    @foreach($steps as $index => $step)
                    <div style="display: flex; margin-bottom: {{ $index < count($steps) - 1 ? '24px' : '0' }};">
                        <div style="display: flex; flex-direction: column; align-items: center; margin-right: 16px;">
                            <div style="width: 40px; height: 40px; background: {{ $index <= $currentStep ? 'var(--primary)' : '#e0e0e0' }}; color: {{ $index <= $currentStep ? 'white' : '#999' }}; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">
                                {{ $step[1] }}
                            </div>
                            @if($index < count($steps) - 1)
                                <div style="width: 2px; height: 100%; background: {{ $index < $currentStep ? 'var(--primary)' : '#e0e0e0' }}; margin-top: 8px;">
                        </div>
                        @endif
                    </div>
                    <div style="flex: 1; padding-top: 8px;">
                        <div style="font-weight: 600; color: {{ $index <= $currentStep ? 'var(--dark)' : '#999' }};">{{ $step[0] }}</div>
                        <div style="font-size: 0.85rem; color: var(--gray);">{{ $step[2] }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
</div>

<!-- Action Buttons -->
<div style="margin-top: 24px; display: flex; gap: 12px;">
    <button onclick="window.print()" class="btn" style="background: var(--gray); color: white;">
        🖨️ Cetak Pesanan
    </button>
    <a href="{{ route('admin.pemesanan.index') }}" class="btn" style="background: #6c757d; color: white;">
        ← Kembali
    </a>
</div>

<style>
    @media print {

        .sidebar,
        .topbar,
        .btn,
        form {
            display: none !important;
        }

        .main-content {
            margin-left: 0 !important;
        }

        .card {
            break-inside: avoid;
        }
    }
</style>
@endsection