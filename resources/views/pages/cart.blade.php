@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
<section style="padding: 140px 0 80px; background: #fafaf5; min-height: 100vh;">
    <div class="container" style="max-width: 1000px;">
        <h1 style="text-align: center; font-family: 'Playfair Display', serif; font-size: 2.5rem; color: #1a5632; margin-bottom: 40px;">Keranjang Belanja</h1>

        @if(session('cart') && count(session('cart')) > 0)
        @php $subtotal = 0; @endphp
        <div style="display: grid; grid-template-columns: 1.5fr 1fr; gap: 30px; align-items: start;">
            
            <!-- KOLOM KIRI: LIST ITEM -->
            <div style="background: white; padding: 30px; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.04); border: 1px solid rgba(0,0,0,0.03);">
                @foreach(session('cart') as $id => $item)
                    @php 
                        // Hitung subtotal per item
                        $harga = $item['harga_paket'] ?? 0;
                        $qty = $item['qty'] ?? 1;
                        $itemTotal = $harga * $qty;
                        $subtotal += $itemTotal; 
                    @endphp
                    
                    <div style="display: flex; gap: 20px; padding: 20px 0; border-bottom: 1px solid #eee; align-items: center;">
                        <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #f0e8d8, #e6dcc8); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 2rem; flex-shrink: 0;">🍽️</div>
                        
                        <div style="flex: 1;">
                            <h3 style="font-size: 1.1rem; margin-bottom: 4px; color: #1a1a1a;">{{ $item['nama_paket'] }}</h3>
                            <!-- TAMPILKAN HARGA ASLI DISINI -->
                            <p style="color: #6b6b6b; font-size: 0.9rem;">Rp {{ number_format($harga, 0, ',', '.') }} / pax</p>
                        </div>

                        <div style="display: flex; align-items: center; gap: 10px;">
                            <form action="{{ route('cart.update') }}" method="POST" style="display:flex;">
                                @csrf @method('PUT')
                                <input type="hidden" name="id" value="{{ $id }}">
                                <input type="hidden" name="qty" value="{{ max(1, $qty - 1) }}">
                                <button type="submit" style="width: 32px; height: 32px; border-radius: 50%; border: 1px solid #ddd; background: white; cursor: pointer; font-weight: bold; color: #555;">-</button>
                            </form>
                            <span style="font-weight: 600; min-width: 24px; text-align: center; font-size: 1rem;">{{ $qty }}</span>
                            <form action="{{ route('cart.update') }}" method="POST" style="display:flex;">
                                @csrf @method('PUT')
                                <input type="hidden" name="id" value="{{ $id }}">
                                <input type="hidden" name="qty" value="{{ $qty + 1 }}">
                                <button type="submit" style="width: 32px; height: 32px; border-radius: 50%; border: 1px solid #ddd; background: white; cursor: pointer; font-weight: bold; color: #555;">+</button>
                            </form>
                        </div>

                        <div style="font-weight: 700; color: #1a5632; min-width: 110px; text-align: right; font-size: 1.05rem;">
                            Rp {{ number_format($itemTotal, 0, ',', '.') }}
                        </div>

                        <form action="{{ route('cart.remove', $id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" style="background: none; border: none; cursor: pointer; color: #dc3545; font-size: 1.3rem; padding: 5px;">🗑️</button>
                        </form>
                    </div>
                @endforeach
            </div>

            <!-- KOLOM KANAN: RINGKASAN -->
            <div style="background: white; padding: 30px; border-radius: 16px; box-shadow: 0 8px 30px rgba(0,0,0,0.08); border: 1px solid rgba(0,0,0,0.03); position: sticky; top: 100px;">
                <h2 style="font-family: 'Playfair Display', serif; font-size: 1.3rem; color: #1a5632; margin-bottom: 24px;">Ringkasan Belanja</h2>
                
                <div style="display: flex; justify-content: space-between; margin-bottom: 12px; font-size: 0.95rem; color: #555;">
                    <span>Subtotal</span>
                    <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                </div>
                
                <div style="height: 1px; background: #eee; margin: 15px 0;"></div>
                
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
                    <span style="font-size: 1.1rem; font-weight: 700; color: #333;">Total</span>
                    <span style="font-size: 1.5rem; font-weight: 800; color: #1a5632;">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                </div>

                <a href="{{ route('cart.checkout') }}" style="display: block; width: 100%; padding: 16px; background: linear-gradient(135deg, #1a5632, #0e3a20); color: white; text-align: center; border-radius: 12px; font-weight: 700; text-decoration: none; transition: all 0.3s; box-shadow: 0 4px 15px rgba(26,86,50,0.3);"
                   onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(26,86,50,0.4)'"
                   onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(26,86,50,0.3)'">
                    Checkout →
                </a>
                
                <a href="{{ route('menu') }}" style="display: block; text-align: center; margin-top: 16px; color: #1a5632; text-decoration: none; font-weight: 600; font-size: 0.9rem;">← Kembali ke Menu</a>
            </div>
        </div>
        @else
        <div style="text-align: center; padding: 80px 40px; background: white; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.04);">
            <div style="font-size: 5rem; margin-bottom: 20px; opacity: 0.6;">🛒</div>
            <h3 style="font-size: 1.5rem; color: #1a1a1a; margin-bottom: 8px;">Keranjang Anda Kosong</h3>
            <p style="color: #6b6b6b; margin-bottom: 24px;">Yuk pilih paket catering favoritmu!</p>
            <a href="{{ route('menu') }}" style="display: inline-block; padding: 14px 32px; background: #1a5632; color: white; border-radius: 50px; text-decoration: none; font-weight: 600; transition: all 0.3s;">Lihat Menu</a>
        </div>
        @endif
    </div>
</section>
@endsection