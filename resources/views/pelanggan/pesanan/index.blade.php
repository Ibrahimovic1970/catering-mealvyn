@extends('layouts.app')

@section('title', 'Pesanan Saya')

@section('content')
<section style="padding: 120px 0 80px; background: #f5f5f5; min-height: 100vh;">
    <div class="container">
        <h1 style="font-size: 2.5rem; margin-bottom: 40px;">Pesanan Saya</h1>

        @if($pemesanans->count() > 0)
        <div style="background: white; border-radius: 16px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); overflow: hidden;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead style="background: #f9f9f9;">
                    <tr>
                        <th style="padding: 16px 20px; text-align: left; font-weight: 600; color: #6b6b6b; border-bottom: 1px solid #eee;">No. Resi</th>
                        <th style="padding: 16px 20px; text-align: left; font-weight: 600; color: #6b6b6b; border-bottom: 1px solid #eee;">Tanggal</th>
                        <th style="padding: 16px 20px; text-align: left; font-weight: 600; color: #6b6b6b; border-bottom: 1px solid #eee;">Total</th>
                        <th style="padding: 16px 20px; text-align: left; font-weight: 600; color: #6b6b6b; border-bottom: 1px solid #eee;">Status</th>
                        <th style="padding: 16px 20px; text-align: left; font-weight: 600; color: #6b6b6b; border-bottom: 1px solid #eee;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pemesanans as $pemesanan)
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 16px 20px;"><strong>{{ $pemesanan->no_resi }}</strong></td>
                        <td style="padding: 16px 20px;">{{ \Carbon\Carbon::parse($pemesanan->tgl_pesan)->format('d M Y') }}</td>
                        <td style="padding: 16px 20px;"><strong>Rp {{ number_format($pemesanan->total_bayar, 0, ',', '.') }}</strong></td>
                        <td style="padding: 16px 20px;">
                            @php
                            $badgeClass = 'background: #dbeafe; color: #1e40af;';
                            if($pemesanan->status_pesan == 'Selesai') $badgeClass = 'background: #d1fae5; color: #065f46;';
                            elseif($pemesanan->status_pesan == 'Dibatalkan') $badgeClass = 'background: #fee2e2; color: #991b1b;';
                            elseif($pemesanan->status_pesan == 'Sedang Diproses') $badgeClass = 'background: #fef3c7; color: #92400e;';
                            elseif($pemesanan->status_pesan == 'Menunggu Kurir') $badgeClass = 'background: #e0e7ff; color: #3730a3;';
                            @endphp
                            <span style="padding: 6px 12px; border-radius: 20px; font-size: 0.85rem; font-weight: 600; {{ $badgeClass }}">
                                {{ $pemesanan->status_pesan }}
                            </span>
                        </td>
                        <td style="padding: 16px 20px;">
                            <a href="{{ route('pesanan.show', $pemesanan->id) }}" style="padding: 8px 16px; background: #1a5632; color: white; text-decoration: none; border-radius: 8px; font-size: 0.9rem; display: inline-block;">Detail</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($pemesanans->hasPages())
        <div style="margin-top: 24px;">
            {{ $pemesanans->links() }}
        </div>
        @endif

        @else
        <div style="background: white; border-radius: 16px; padding: 80px 20px; text-align: center; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
            <div style="font-size: 4rem; margin-bottom: 20px;">📦</div>
            <h3 style="margin-bottom: 12px;">Belum Ada Pesanan</h3>
            <p style="color: #6b6b6b; margin-bottom: 24px;">Yuk mulai pesan catering untuk acara Anda!</p>
            <a href="{{ route('menu') }}" style="display: inline-block; padding: 14px 32px; background: #1a5632; color: white; text-decoration: none; border-radius: 50px; font-weight: 600;">Lihat Menu</a>
        </div>
        @endif
    </div>
</section>
@endsection