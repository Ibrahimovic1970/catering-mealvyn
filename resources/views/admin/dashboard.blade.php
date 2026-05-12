@extends('admin.layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard Overview')

@section('content')
<!-- Statistics Cards -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon primary">📦</div>
        <div class="stat-content">
            <h3>{{ number_format($totalPesanan) }}</h3>
            <p>Total Pesanan</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon success">👥</div>
        <div class="stat-content">
            <h3>{{ number_format($totalPelanggan) }}</h3>
            <p>Total Pelanggan</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon warning">🍱</div>
        <div class="stat-content">
            <h3>{{ number_format($totalPaket) }}</h3>
            <p>Total Paket Menu</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon info">💰</div>
        <div class="stat-content">
            <h3>Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
            <p>Total Pendapatan</p>
        </div>
    </div>
</div>

<!-- Recent Orders -->
<div class="card">
    <div class="card-header">
        <h3>Pesanan Terbaru</h3>
        <a href="{{ route('admin.pemesanan.index') }}" class="btn btn-primary btn-sm">Lihat Semua</a>
    </div>
    <div class="card-body" style="padding: 0;">
        <table>
            <thead>
                <tr>
                    <th>No. Resi</th>
                    <th>Pelanggan</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pesananTerbaru as $pemesanan)
                <tr>
                    <td><strong>{{ $pemesanan->no_resi }}</strong></td>
                    <td>{{ $pemesanan->pelanggan->nama_pelanggan }}</td>
                    <td>{{ \Carbon\Carbon::parse($pemesanan->tgl_pesan)->format('d M Y') }}</td>
                    <td>Rp {{ number_format($pemesanan->total_bayar, 0, ',', '.') }}</td>
                    <td>
                        @php
                        $badgeClass = 'badge-primary';
                        if($pemesanan->status_pesan == 'Selesai') $badgeClass = 'badge-success';
                        elseif($pemesanan->status_pesan == 'Dibatalkan') $badgeClass = 'badge-danger';
                        elseif($pemesanan->status_pesan == 'Sedang Diproses') $badgeClass = 'badge-warning';
                        @endphp
                        <span class="badge {{ $badgeClass }}">{{ $pemesanan->status_pesan }}</span>
                    </td>
                    <td>
                        <a href="{{ route('admin.pemesanan.show', $pemesanan->id) }}" class="btn btn-sm btn-primary">Detail</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 40px; color: #999;">
                        Belum ada pesanan
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection