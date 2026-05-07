@extends('layouts.app')
@section('title', 'Checkout')

@section('content')
<section style="padding: 150px 0 80px; background: #f9f5ed;">
    <div class="container">
        <h1 style="font-size: 2.5rem; text-align: center; margin-bottom: 40px;">Checkout</h1>

        <form action="{{ route('cart.process-checkout') }}" method="POST" style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px;">
            @csrf
            <div style="background: white; padding: 30px; border-radius: 20px; box-shadow: var(--shadow);">
                <h2 style="font-size: 1.4rem; margin-bottom: 20px;">Data Pelanggan</h2>
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px; font-weight: 500;">Nama Lengkap *</label>
                    <input type="text" name="nama_pelanggan" required value="{{ old('nama_pelanggan') }}" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 15px;">
                    <div>
                        <label style="display: block; margin-bottom: 5px; font-weight: 500;">Email *</label>
                        <input type="email" name="email" required value="{{ old('email') }}" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">
                    </div>
                    <div>
                        <label style="display: block; margin-bottom: 5px; font-weight: 500;">Telepon *</label>
                        <input type="tel" name="telepon" required value="{{ old('telepon') }}" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">
                    </div>
                </div>
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px; font-weight: 500;">Alamat *</label>
                    <textarea name="alamat" rows="3" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">{{ old('alamat') }}</textarea>
                </div>
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px; font-weight: 500;">Tanggal Lahir</label>
                    <input type="date" name="tgl_lahir" value="{{ old('tgl_lahir') }}" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">
                </div>
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px; font-weight: 500;">Tanggal Pengiriman *</label>
                    <input type="date" name="tgl_pesan" required min="{{ date('Y-m-d') }}" value="{{ old('tgl_pesan') }}" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">
                </div>
            </div>

            <div>
                <div style="background: white; padding: 30px; border-radius: 20px; box-shadow: var(--shadow); margin-bottom: 20px;">
                    <h2 style="font-size: 1.4rem; margin-bottom: 20px;">Ringkasan & Pembayaran</h2>
                    @foreach($cart as $item)
                    <div style="display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #eee;">
                        <span>{{ $item['nama_paket'] }} (x{{ $item['qty'] }})</span>
                        <strong>Rp {{ number_format($item['harga'] * $item['qty'], 0, ',', '.') }}</strong>
                    </div>
                    @endforeach
                    <div style="margin-top: 15px; padding-top: 15px; border-top: 2px solid #eee; display: flex; justify-content: space-between; font-size: 1.2rem; font-weight: 700; color: #1a5632;">
                        <span>Total Bayar</span>
                        <span>Rp {{ number_format($total * 1.15, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div style="background: white; padding: 30px; border-radius: 20px; box-shadow: var(--shadow);">
                    <h3 style="margin-bottom: 15px;">Pilih Metode Pembayaran</h3>
                    <div style="display: flex; flex-direction: column; gap: 10px;">
                        @foreach($jenisPembayarans as $jenis)
                        <label style="display: flex; align-items: center; gap: 10px; padding: 15px; border: 1px solid #ddd; border-radius: 10px; cursor: pointer;">
                            <input type="radio" name="id_jenis_bayar" value="{{ $jenis->id }}" style="width: 18px; height: 18px; accent-color: #1a5632;" {{ $loop->first ? 'checked' : '' }}>
                            <div>
                                <strong>{{ $jenis->metode_pembayaran }}</strong>
                                @if($jenis->detailJenisPembayarans->count())
                                <div style="font-size: 0.85rem; color: #6b6b6b;">
                                    @foreach($jenis->detailJenisPembayarans as $d)
                                    <div>{{ $d->tempat_bayar }}: {{ $d->no_rek }}</div>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                        </label>
                        @endforeach
                    </div>
                </div>

                <button type="submit" style="width: 100%; padding: 16px; background: #1a5632; color: white; border: none; border-radius: 50px; font-weight: 700; font-size: 1.1rem; margin-top: 20px; cursor: pointer;">Konfirmasi Pesanan</button>
            </div>
        </form>
    </div>
</section>
@endsection