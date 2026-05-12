@extends('admin.layouts.admin')

@section('title', 'Kelola Paket')
@section('page-title', 'Kelola Paket Catering')

@section('content')
<div class="card">
    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
        <h3 style="margin: 0;">Daftar Paket Catering</h3>
        <a href="{{ route('admin.paket.create') }}" class="btn btn-primary" style="padding: 10px 20px; background: #1a5632; color: white; border: none; border-radius: 8px; text-decoration: none; font-weight: 500;">+ Tambah Paket Baru</a>
    </div>
    <div class="card-body" style="padding: 0;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead style="background: #f8f9fa;">
                <tr>
                    <th style="padding: 12px 16px; text-align: left; font-weight: 600; color: #6b6b6b; border-bottom: 1px solid #eee;">Foto</th>
                    <th style="padding: 12px 16px; text-align: left; font-weight: 600; color: #6b6b6b; border-bottom: 1px solid #eee;">Nama Paket</th>
                    <th style="padding: 12px 16px; text-align: left; font-weight: 600; color: #6b6b6b; border-bottom: 1px solid #eee;">Kategori</th>
                    <th style="padding: 12px 16px; text-align: left; font-weight: 600; color: #6b6b6b; border-bottom: 1px solid #eee;">Jenis</th>
                    <th style="padding: 12px 16px; text-align: left; font-weight: 600; color: #6b6b6b; border-bottom: 1px solid #eee;">Pax</th>
                    <th style="padding: 12px 16px; text-align: left; font-weight: 600; color: #6b6b6b; border-bottom: 1px solid #eee;">Harga</th>
                    <th style="padding: 12px 16px; text-align: center; font-weight: 600; color: #6b6b6b; border-bottom: 1px solid #eee;">Status</th>
                    <th style="padding: 12px 16px; text-align: center; font-weight: 600; color: #6b6b6b; border-bottom: 1px solid #eee;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pakets as $paket)
                <tr style="border-bottom: 1px solid #eee; vertical-align: middle;">
                    <td style="padding: 12px 16px;">
                        @if($paket->foto1)
                        <img src="{{ asset('storage/' . $paket->foto1) }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px; border: 1px solid #eee;" alt="{{ $paket->nama_paket }}">
                        @else
                        <div style="width: 60px; height: 60px; background: #f0f0f0; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">📷</div>
                        @endif
                    </td>
                    <td style="padding: 12px 16px;"><strong>{{ $paket->nama_paket }}</strong></td>
                    <td style="padding: 12px 16px;"><span style="background: #e0f2fe; color: #0369a1; padding: 4px 10px; border-radius: 20px; font-size: 0.85rem; font-weight: 500;">{{ $paket->kategori }}</span></td>
                    <td style="padding: 12px 16px;">{{ $paket->jenis }}</td>
                    <td style="padding: 12px 16px;">{{ number_format($paket->jumlah_pax) }} Pax</td>
                    <td style="padding: 12px 16px; font-weight: 600; color: #1a5632;">Rp {{ number_format($paket->harga_paket, 0, ',', '.') }}</td>
                    <td style="padding: 12px 16px; text-align: center;">
                        @if($paket->is_active)
                        <span style="background: #d1fae5; color: #065f46; padding: 4px 10px; border-radius: 20px; font-size: 0.85rem; font-weight: 500;">Aktif</span>
                        @else
                        <span style="background: #fee2e2; color: #991b1b; padding: 4px 10px; border-radius: 20px; font-size: 0.85rem; font-weight: 500;">Nonaktif</span>
                        @endif
                    </td>
                    <td style="padding: 12px 16px; text-align: center;">
                        <div style="display: flex; justify-content: center; gap: 8px;">
                            <a href="{{ route('admin.paket.edit', $paket->id) }}" style="padding: 6px 12px; background: #f59e0b; color: white; border-radius: 6px; text-decoration: none; font-size: 0.85rem; font-weight: 500;">Edit</a>
                            <form action="{{ route('admin.paket.destroy', $paket->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus paket ini? Tindakan ini tidak dapat dibatalkan.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="padding: 6px 12px; background: #ef4444; color: white; border: none; border-radius: 6px; cursor: pointer; font-size: 0.85rem; font-weight: 500;">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" style="padding: 40px; text-align: center; color: #999;">
                        Belum ada data paket. <a href="{{ route('admin.paket.create') }}" style="color: #1a5632; font-weight: 500;">Tambahkan paket baru</a>.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if($pakets->hasPages())
<div style="margin-top: 24px;">
    {{ $pakets->links() }}
</div>
@endif
@endsection