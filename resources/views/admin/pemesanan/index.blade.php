@extends('admin.layouts.admin')

@section('title', 'Daftar Pesanan')
@section('page-title', 'Manajemen Pesanan')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Daftar Semua Pesanan</h3>
        <div style="display: flex; gap: 10px;">
            <span class="badge badge-primary">Total: {{ $pemesanans->total() }}</span>
        </div>
    </div>
    <div class="card-body" style="padding: 0;">
        <table>
            <thead>
                <tr>
                    <th>No. Resi</th>
                    <th>Pelanggan</th>
                    <th>Tanggal Pesan</th>
                    <th>Item</th>
                    <th>Total Bayar</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pemesanans as $pemesanan)
                <tr>
                    <td><strong>{{ $pemesanan->no_resi }}</strong></td>
                    <td>
                        <div>{{ $pemesanan->pelanggan->nama_pelanggan }}</div>
                        <small style="color: #6b6b6b;">{{ $pemesanan->pelanggan->email }}</small>
                    </td>
                    <td>{{ \Carbon\Carbon::parse($pemesanan->tgl_pesan)->format('d M Y') }}</td>
                    <td>
                        @php
                        $items = $pemesanan->detailPemesanans->pluck('paket.nama_paket')->toArray();
                        echo implode(', ', array_slice($items, 0, 2));
                        if(count($items) > 2) echo '...';
                        @endphp
                    </td>
                    <td><strong>Rp {{ number_format($pemesanan->total_bayar, 0, ',', '.') }}</strong></td>
                    <td>
                        @php
                        $badgeClass = 'badge-primary';
                        switch($pemesanan->status_pesan) {
                        case 'Menunggu Konfirmasi': $badgeClass = 'badge-warning'; break;
                        case 'Sedang Diproses': $badgeClass = 'badge-info'; break;
                        case 'Menunggu Kurir': $badgeClass = 'badge-primary'; break;
                        case 'Selesai': $badgeClass = 'badge-success'; break;
                        case 'Dibatalkan': $badgeClass = 'badge-danger'; break;
                        }
                        @endphp
                        <span class="badge {{ $badgeClass }}">{{ $pemesanan->status_pesan }}</span>
                    </td>
                    <td>
                        <a href="{{ route('admin.pemesanan.show', $pemesanan->id) }}" class="btn btn-sm btn-primary">Detail</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align: center; padding: 40px; color: #999;">
                        Belum ada data pesanan
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if($pemesanans->hasPages())
<div style="margin-top: 20px; display: flex; justify-content: center;">
    {{ $pemesanans->links() }}
</div>
@endif
@endsection