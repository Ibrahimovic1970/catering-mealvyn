@extends('layouts.app')

@section('title', 'Dashboard Saya')

@section('content')
<section style="padding: 120px 0 80px; background: #f5f5f5;">
    <div class="container">
        <div style="margin-bottom: 40px;">
            <h1 style="font-size: 2.5rem; margin-bottom: 8px;">Selamat Datang, {{ auth()->user()->name }}!</h1>
            <p style="color: #6b6b6b;">Dashboard Pesanan Anda</p>
        </div>

        <!-- Statistics -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 24px; margin-bottom: 40px;">
            <div style="background: white; padding: 30px; border-radius: 16px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
                <div style="font-size: 2.5rem; margin-bottom: 8px;">📦</div>
                <div style="font-size: 2rem; font-weight: 700; color: #1a5632;">{{ number_format($totalPesanan) }}</div>
                <div style="color: #6b6b6b; font-size: 0.9rem;">Total Pesanan</div>
            </div>
            <div style="background: white; padding: 30px; border-radius: 16px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
                <div style="font-size: 2.5rem; margin-bottom: 8px;">💰</div>
                <div style="font-size: 2rem; font-weight: 700; color: #1a5632;">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
                <div style="color: #6b6b6b; font-size: 0.9rem;">Total Belanja</div>
            </div>
        </div>

        <!-- Recent Orders -->
        <div style="background: white; border-radius: 16px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); overflow: hidden;">
            <div style="padding: 24px; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center;">
                <h3 style="font-size: 1.3rem; font-weight: 600;">Pesanan Terbaru</h3>
            </div>
            <div style="padding: 0;">
                @if($pesananTerbaru->count() > 0)
                <table style="width: 100%; border-collapse: collapse;">
                    <thead style="background: #f9f9f9;">
                        <tr>
                            <th style="padding: 12px 20px; text-align: left; font-weight: 600; color: #6b6b6b; border-bottom: 1px solid #eee;">No. Resi</th>
                            <th style="padding: 12px 20px; text-align: left; font-weight: 600; color: #6b6b6b; border-bottom: 1px solid #eee;">Tanggal</th>
                            <th style="padding: 12px 20px; text-align: left; font-weight: 600; color: #6b6b6b; border-bottom: 1px solid #eee;">Total</th>
                            <th style="padding: 12px 20px; text-align: left; font-weight: 600; color: #6b6b6b; border-bottom: 1px solid #eee;">Status</th>
                            <th style="padding: 12px 20px; text-align: left; font-weight: 600; color: #6b6b6b; border-bottom: 1px solid #eee;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pesananTerbaru as $pemesanan)
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
                @else
                <div style="padding: 60px 20px; text-align: center; color: #999;">
                    <div style="font-size: 3rem; margin-bottom: 16px;">📦</div>
                    <p>Belum ada pesanan</p>
                    <a href="{{ route('menu') }}" style="display: inline-block; margin-top: 16px; padding: 12px 24px; background: #1a5632; color: white; text-decoration: none; border-radius: 8px;">Mulai Belanja</a>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection