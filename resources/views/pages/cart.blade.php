@extends('layouts.app')
@section('title', 'Keranjang')

@section('content')
<section style="padding: 150px 0 80px; background: #f9f5ed;">
    <div class="container">
        <h1 style="font-size: 2.5rem; text-align: center; margin-bottom: 40px;">Keranjang Belanja</h1>

        @if(count($cart) > 0)
        <div style="display: grid; grid-template-columns: 1.5fr 1fr; gap: 40px;">
            <div style="background: white; padding: 30px; border-radius: 20px; box-shadow: var(--shadow);">
                @foreach($cart as $id => $item)
                <div style="display: flex; gap: 20px; padding: 20px 0; border-bottom: 1px solid #eee; align-items: center;">
                    <div style="width: 70px; height: 70px; background: #f0e8d8; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 2rem; flex-shrink: 0;">🍽️</div>
                    <div style="flex: 1;">
                        <h3 style="font-size: 1.1rem;">{{ $item['nama_paket'] }}</h3>
                        <p style="color: #6b6b6b; font-size: 0.9rem;">Rp {{ number_format($item['harga'], 0, ',', '.') }} / pax</p>
                    </div>
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <form action="{{ route('cart.update') }}" method="POST" style="display:flex; align-items:center; gap:8px;">
                            @csrf @method('PUT')
                            <input type="hidden" name="id" value="{{ $id }}">
                            <input type="hidden" name="qty" value="{{ max(1, $item['qty'] - 1) }}">
                            <button type="submit" style="width: 30px; height: 30px; border-radius: 50%; border: 1px solid #ddd; background: white; cursor: pointer;">-</button>
                        </form>
                        <span style="font-weight: 600; min-width: 20px; text-align: center;">{{ $item['qty'] }}</span>
                        <form action="{{ route('cart.update') }}" method="POST" style="display:flex; align-items:center; gap:8px;">
                            @csrf @method('PUT')
                            <input type="hidden" name="id" value="{{ $id }}">
                            <input type="hidden" name="qty" value="{{ $item['qty'] + 1 }}">
                            <button type="submit" style="width: 30px; height: 30px; border-radius: 50%; border: 1px solid #ddd; background: white; cursor: pointer;">+</button>
                        </form>
                    </div>
                    <div style="font-weight: 700; color: #1a5632; min-width: 90px; text-align: right;">Rp {{ number_format($item['harga'] * $item['qty'], 0, ',', '.') }}</div>
                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit" style="background: none; border: none; cursor: pointer; font-size: 1.2rem; color: #a0a0a0;">🗑️</button>
                    </form>
                </div>
                @endforeach
            </div>

            <div style="background: white; padding: 30px; border-radius: 20px; box-shadow: var(--shadow); height: fit-content; position: sticky; top: 100px;">
                <h2 style="font-size: 1.4rem; margin-bottom: 20px;">Ringkasan</h2>
                <div style="display: flex; justify-content: space-between; margin-bottom: 10px;"><span>Subtotal</span><span>Rp {{ number_format($total, 0, ',', '.') }}</span></div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 10px;"><span>Biaya Layanan (5%)</span><span>Rp {{ number_format($total * 0.05, 0, ',', '.') }}</span></div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 10px;"><span>Pajak (10%)</span><span>Rp {{ number_format($total * 0.1, 0, ',', '.') }}</span></div>
                <div style="border-top: 1px solid #eee; margin: 15px 0;"></div>
                <div style="display: flex; justify-content: space-between; font-size: 1.2rem; font-weight: 700; color: #1a5632; margin-bottom: 20px;">
                    <span>Total</span><span>Rp {{ number_format($total * 1.15, 0, ',', '.') }}</span>
                </div>
                <form action="{{ route('cart.checkout') }}" method="GET">
                    <button type="submit" style="width: 100%; padding: 16px; background: #1a5632; color: white; border: none; border-radius: 50px; font-weight: 600; cursor: pointer; font-size: 1rem;">Checkout →</button>
                </form>
                <a href="{{ route('menu') }}" style="display: block; text-align: center; margin-top: 15px; color: #1a5632; font-weight: 500;">← Kembali ke Menu</a>
            </div>
        </div>
        @else
        <div style="text-align: center; padding: 60px 0;">
            <div style="font-size: 4rem; margin-bottom: 20px;">🛒</div>
            <h2 style="margin-bottom: 10px;">Keranjang Kosong</h2>
            <p style="color: #6b6b6b; margin-bottom: 30px;">Yuk mulai pilih paket catering favorit Anda!</p>
            <a href="{{ route('menu') }}" style="display: inline-block; padding: 14px 32px; background: #1a5632; color: white; border-radius: 50px; font-weight: 600; text-decoration: none;">Lihat Menu</a>
        </div>
        @endif
    </div>
</section>
@endsection