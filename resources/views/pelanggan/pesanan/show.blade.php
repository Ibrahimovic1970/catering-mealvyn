@extends('layouts.app')

@section('title', 'Detail Pesanan')

@section('content')
<section style="padding: 120px 0 80px; background: #f5f5f5;">
    <div class="container" style="max-width: 900px;">
        <a href="{{ route('pesanan.saya') }}" style="display: inline-block; margin-bottom: 24px; color: #1a5632; text-decoration: none; font-weight: 500;">← Kembali ke Daftar Pesanan</a>

        <div style="background: white; border-radius: 16px; padding: 40px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); margin-bottom: 24px;">

            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; padding-bottom: 20px; border-bottom: 2px solid #f0f0f0;">
                <div>
                    <h1 style="font-size: 2rem; margin-bottom: 8px;">Detail Pesanan</h1>
                    <p style="color: #6b6b6b;">No. Resi: <strong>{{ $pemesanan->no_resi }}</strong></p>
                </div>
                @php
                $badgeClass = 'background: #dbeafe; color: #1e40af;';
                if($pemesanan->status_pesan == 'Selesai') $badgeClass = 'background: #d1fae5; color: #065f46;';
                elseif($pemesanan->status_pesan == 'Dibatalkan') $badgeClass = 'background: #fee2e2; color: #991b1b;';
                elseif($pemesanan->status_pesan == 'Sedang Diproses') $badgeClass = 'background: #fef3c7; color: #92400e;';
                @endphp
                <span id="status-badge" style="padding: 10px 20px; border-radius: 20px; font-size: 0.95rem; font-weight: 600; {{ $badgeClass }}">
                    {{ $pemesanan->status_pesan }}
                </span>
            </div>

            <div class="tracking-section" style="margin-bottom: 40px; background: #f9f9f9; padding: 24px; border-radius: 12px;">
                <h3 style="font-size: 1.2rem; margin-bottom: 20px;">Status Pengiriman</h3>
                <div style="display: flex; justify-content: space-between; position: relative;">
                    <div style="position: absolute; top: 20px; left: 0; right: 0; height: 4px; background: #e0e0e0; z-index: 0;"></div>

                    <div style="position: relative; z-index: 1; text-align: center; width: 25%;">
                        <div class="timeline-step-circle" style="width: 40px; height: 40px; background: #1a5632; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 10px; font-weight: bold;">1</div>
                        <div style="font-weight: 600; font-size: 0.9rem;">Diterima</div>
                    </div>

                    <div style="position: relative; z-index: 1; text-align: center; width: 25%;">
                        <div class="timeline-step-circle" style="width: 40px; height: 40px; background: {{ in_array($pemesanan->status_pesan, ['Sedang Diproses', 'Menunggu Kurir', 'Selesai']) ? '#1a5632' : '#e0e0e0' }}; color: {{ in_array($pemesanan->status_pesan, ['Sedang Diproses', 'Menunggu Kurir', 'Selesai']) ? 'white' : '#999' }}; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 10px; font-weight: bold;">2</div>
                        <div style="font-weight: 600; font-size: 0.9rem; color: {{ in_array($pemesanan->status_pesan, ['Sedang Diproses', 'Menunggu Kurir', 'Selesai']) ? 'black' : '#999' }};">Diproses</div>
                    </div>

                    <div style="position: relative; z-index: 1; text-align: center; width: 25%;">
                        <div class="timeline-step-circle" style="width: 40px; height: 40px; background: {{ in_array($pemesanan->status_pesan, ['Menunggu Kurir', 'Selesai']) ? '#1a5632' : '#e0e0e0' }}; color: {{ in_array($pemesanan->status_pesan, ['Menunggu Kurir', 'Selesai']) ? 'white' : '#999' }}; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 10px; font-weight: bold;">3</div>
                        <div style="font-weight: 600; font-size: 0.9rem; color: {{ in_array($pemesanan->status_pesan, ['Menunggu Kurir', 'Selesai']) ? 'black' : '#999' }};">Dikirim</div>
                    </div>

                    <div style="position: relative; z-index: 1; text-align: center; width: 25%;">
                        <div class="timeline-step-circle" style="width: 40px; height: 40px; background: {{ $pemesanan->status_pesan == 'Selesai' ? '#1a5632' : '#e0e0e0' }}; color: {{ $pemesanan->status_pesan == 'Selesai' ? 'white' : '#999' }}; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 10px; font-weight: bold;">4</div>
                        <div style="font-weight: 600; font-size: 0.9rem; color: {{ $pemesanan->status_pesan == 'Selesai' ? 'black' : '#999' }};">Selesai</div>
                    </div>
                </div>
            </div>

            @if($pemesanan->pengiriman && $pemesanan->pengiriman->status_kirim)
            <div id="pengiriman-info-container" style="background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 12px; padding: 20px; margin-bottom: 30px;">
                <h3 style="font-size: 1.1rem; margin-bottom: 12px; color: #166534;">🚚 Informasi Pengiriman</h3>
                <p style="margin-bottom: 8px;"><strong>Status Kirim:</strong> {{ $pemesanan->pengiriman->status_kirim }}</p>
                @if($pemesanan->pengiriman->tgl_tiba)
                <p style="margin-bottom: 8px;"><strong>Waktu Tiba:</strong> {{ \Carbon\Carbon::parse($pemesanan->pengiriman->tgl_tiba)->format('d M Y, H:i') }}</p>
                @endif

                @if($pemesanan->pengiriman->bukti_foto)
                <div style="margin-top: 15px;">
                    <p style="margin-bottom: 8px; font-weight: 600;">📸 Bukti Pengiriman:</p>
                    <img src="{{ asset('storage/' . $pemesanan->pengiriman->bukti_foto) }}" alt="Bukti Pengiriman" style="max-width: 100%; border-radius: 8px; border: 2px solid white; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                    <p style="font-size: 0.8rem; color: #666; margin-top: 5px;">*Foto ini diupload oleh kurir/admin saat pesanan tiba.</p>
                </div>
                @endif
            </div>
            @endif

            <div style="margin-bottom: 30px;">
                <h3 style="font-size: 1.1rem; margin-bottom: 16px; font-weight: 600;">Item Pesanan</h3>
                <div style="border: 1px solid #eee; border-radius: 12px; overflow: hidden;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead style="background: #f9f9f9;">
                            <tr>
                                <th style="padding: 12px 16px; text-align: left; font-weight: 600; color: #6b6b6b; border-bottom: 1px solid #eee;">Paket</th>
                                <th style="padding: 12px 16px; text-align: right; font-weight: 600; color: #6b6b6b; border-bottom: 1px solid #eee;">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pemesanan->detailPemesanans as $detail)
                            <tr style="border-bottom: 1px solid #eee;">
                                <td style="padding: 16px;">{{ $detail->paket->nama_paket }}</td>
                                <td style="padding: 16px; text-align: right;"><strong>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</strong></td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot style="background: #f9f9f9;">
                            <tr>
                                <td style="padding: 16px; font-weight: 700; font-size: 1.1rem;">Total Pembayaran</td>
                                <td style="padding: 16px; text-align: right; font-weight: 700; font-size: 1.2rem; color: #1a5632;">Rp {{ number_format($pemesanan->total_bayar, 0, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const orderId = {
        {
            $pemesanan - > id
        }
    };
    let currentStatus = "{{ $pemesanan->status_pesan }}";
    let currentKirim = "{{ $pemesanan->pengiriman->status_kirim ?? '' }}";
    let currentFoto = "{{ $pemesanan->pengiriman->bukti_foto ?? '' }}";

    setInterval(function() {
        fetch("{{ route('pesanan.check-status', $pemesanan->id) }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.status_pesan !== currentStatus) {
                    currentStatus = data.status_pesan;
                    updateHeaderBadge(data.status_pesan);
                    updateTimeline(data.status_pesan);
                    showNotification('Status Pesanan', 'Pesanan Anda telah diupdate menjadi: ' + data.status_pesan);
                }

                if (data.status_kirim !== currentKirim || data.bukti_foto !== currentFoto) {
                    currentKirim = data.status_kirim;
                    currentFoto = data.bukti_foto;
                    updatePengirimanSection(data);
                    if (data.bukti_foto) {
                        showNotification('Pengiriman', 'Foto bukti pengiriman telah diupload!');
                    }
                }
            })
            .catch(error => console.error('Error:', error));

    }, 5000);

    function updateHeaderBadge(status) {
        let color = '#dbeafe';
        let textColor = '#1e40af';

        if (status === 'Selesai') {
            color = '#d1fae5';
            textColor = '#065f46';
        } else if (status === 'Dibatalkan') {
            color = '#fee2e2';
            textColor = '#991b1b';
        } else if (status === 'Sedang Diproses') {
            color = '#fef3c7';
            textColor = '#92400e';
        }

        const badge = document.getElementById('status-badge');
        badge.style.background = color;
        badge.style.color = textColor;
        badge.innerHTML = getStatusIcon(status) + ' ' + status;
    }

    function getStatusIcon(status) {
        if (status === 'Selesai') return '✅';
        if (status === 'Dibatalkan') return '❌';
        if (status === 'Sedang Diproses') return '🔥';
        if (status === 'Menunggu Kurir') return '🚚';
        return '⏳';
    }

    function updateTimeline(status) {
        const steps = document.querySelectorAll('.timeline-step-circle');
        let activeIndex = 0;
        if (status === 'Sedang Diproses') activeIndex = 1;
        else if (status === 'Menunggu Kurir') activeIndex = 2;
        else if (status === 'Selesai') activeIndex = 3;

        steps.forEach((el, index) => {
            if (index <= activeIndex) {
                el.style.background = '#1a5632';
                el.style.color = 'white';
            } else {
                el.style.background = '#e0e0e0';
                el.style.color = '#999';
            }
        });
    }

    function updatePengirimanSection(data) {
        let container = document.getElementById('pengiriman-info-container');
        if (!container && data.status_kirim) {
            const html = '<div id="pengiriman-info-container" style="background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 12px; padding: 20px; margin-bottom: 30px;">' +
                '<h3 style="font-size: 1.1rem; margin-bottom: 12px; color: #166534;">🚚 Informasi Pengiriman</h3>' +
                '<p style="margin-bottom: 8px;"><strong>Status Kirim:</strong> ' + data.status_kirim + '</p>' +
                (data.tgl_tiba ? '<p style="margin-bottom: 8px;"><strong>Waktu Tiba:</strong> ' + data.tgl_tiba + '</p>' : '') +
                (data.bukti_foto ? '<div style="margin-top: 15px;"><p style="margin-bottom: 8px; font-weight: 600;">📸 Bukti Pengiriman:</p>' +
                    '<img src="/storage/' + data.bukti_foto + '" alt="Bukti" style="max-width: 100%; border-radius: 8px;"></div>' : '') +
                '</div>';
            document.querySelector('.tracking-section').insertAdjacentHTML('afterend', html);
        } else if (container) {
            container.innerHTML = '<h3 style="font-size: 1.1rem; margin-bottom: 12px; color: #166534;">🚚 Informasi Pengiriman</h3>' +
                '<p style="margin-bottom: 8px;"><strong>Status Kirim:</strong> ' + data.status_kirim + '</p>' +
                (data.tgl_tiba ? '<p style="margin-bottom: 8px;"><strong>Waktu Tiba:</strong> ' + data.tgl_tiba + '</p>' : '') +
                (data.bukti_foto ? '<div style="margin-top: 15px;"><p style="margin-bottom: 8px; font-weight: 600;">📸 Bukti Pengiriman:</p>' +
                    '<img src="/storage/' + data.bukti_foto + '" alt="Bukti" style="max-width: 100%; border-radius: 8px;"></div>' : '');
        }
    }

    function showNotification(title, message) {
        Swal.fire({
            icon: 'info',
            title: title,
            text: message,
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000,
            timerProgressBar: true,
        });
    }
</script>
@endsection