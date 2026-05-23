@extends('layouts.app')

@section('title', 'Paket Harga')

@section('content')
    <!-- Hero Section -->
    <section
        style="padding: 140px 0 60px; background: linear-gradient(135deg, #0e3a20 0%, #1a5632 100%); position: relative; overflow: hidden;">
        <div
            style="position: absolute; top: -50%; right: -10%; width: 600px; height: 600px; background: radial-gradient(circle, rgba(212,168,83,0.1) 0%, transparent 70%); border-radius: 50%;">
        </div>
        <div class="container" style="position: relative; z-index: 1; text-align: center;">
            <h1
                style="font-size: 3rem; color: #ffffff; font-family: 'Playfair Display', serif; margin-bottom: 16px; font-weight: 700;">
                Paket Harga</h1>
            <p style="color: rgba(255,255,255,0.8); font-size: 1.1rem; max-width: 600px; margin: 0 auto;">Transparan,
                kompetitif, dan sesuai budget Anda</p>
        </div>
    </section>

    <!-- Pricing Cards Section -->
    <section style="padding: 60px 0; background: #f9f5ed; min-height: 600px;">
        <div class="container">

            @if($pakets->count() > 0)
                <!-- Group by Category -->
                @foreach($pakets->groupBy('kategori') as $kategori => $group)
                    <div style="margin-bottom: 60px;">
                        <!-- Category Title -->
                        <h2
                            style="font-size: 2rem; color: #1a5632; text-align: center; margin-bottom: 40px; font-family: 'Playfair Display', serif; font-weight: 700;">
                            {{ $kategori }}
                        </h2>

                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px;">
                            @foreach($group as $paket)
                                <div style="background: white; border-radius: 24px; padding: 40px 32px; box-shadow: 0 8px 30px rgba(0,0,0,0.08); transition: all 0.3s; border: 2px solid transparent;"
                                    onmouseover="this.style.borderColor='#1a5632'; this.style.transform='translateY(-8px)'; this.style.boxShadow='0 12px 40px rgba(0,0,0,0.12)'"
                                    onmouseout="this.style.borderColor='transparent'; this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 30px rgba(0,0,0,0.08)'">

                                    <!-- Header -->
                                    <div style="margin-bottom: 24px;">
                                        <h3
                                            style="font-size: 1.3rem; color: #1a1a1a; margin-bottom: 8px; font-family: 'Playfair Display', serif; font-weight: 600;">
                                            {{ $paket->nama_paket }}
                                        </h3>
                                        <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                                            <span
                                                style="background: rgba(26,86,50,0.1); color: #1a5632; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600;">
                                                {{ $paket->jenis }}
                                            </span>
                                            <span
                                                style="background: rgba(212,168,83,0.1); color: #b8903a; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600;">
                                                {{ $paket->jumlah_pax }} Pax
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Description -->
                                    <p style="color: #6b6b6b; font-size: 0.9rem; line-height: 1.6; margin-bottom: 24px;">
                                        {{ Str::limit($paket->deskripsi, 120) }}
                                    </p>

                                    <!-- Price -->
                                    <div
                                        style="padding: 20px; background: linear-gradient(135deg, #f0fdf4, #dcfce7); border-radius: 16px; margin-bottom: 24px;">
                                        <div style="display: flex; justify-content: space-between; align-items: baseline;">
                                            <span
                                                style="font-size: 2rem; font-weight: 700; color: #1a5632; font-family: 'Playfair Display', serif;">
                                                Rp {{ number_format($paket->harga_paket, 0, ',', '.') }}
                                            </span>
                                            <span style="color: #166534; font-weight: 600;">/pax</span>
                                        </div>
                                    </div>

                                    <!-- Button -->
                                    <form action="{{ route('cart.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $paket->id }}">
                                        <button type="submit"
                                            style="width: 100%; padding: 16px; background: linear-gradient(135deg, #1a5632, #0e3a20); color: white; border: none; border-radius: 12px; font-weight: 700; font-size: 1rem; cursor: pointer; transition: all 0.3s;"
                                            onmouseover="this.style.background='linear-gradient(135deg, #0e3a20, #0a2a18)'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 20px rgba(26,86,50,0.3)'"
                                            onmouseout="this.style.background='linear-gradient(135deg, #1a5632, #0e3a20)'; this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                                            Pesan Sekarang →
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach

            @else
                <!-- Empty State -->
                <div style="text-align: center; padding: 80px 20px;">
                    <div style="font-size: 5rem; margin-bottom: 20px; opacity: 0.3;">📦</div>
                    <h3 style="font-size: 1.5rem; color: #1a1a1a; margin-bottom: 8px; font-family: 'Playfair Display', serif;">
                        Belum Ada Paket Tersedia</h3>
                    <p style="color: #6b6b6b; margin-bottom: 24px;">Silakan hubungi admin untuk informasi lebih lanjut</p>
                    <a href="{{ route('contact') }}"
                        style="display: inline-block; padding: 14px 32px; background: #1a5632; color: white; border-radius: 50px; text-decoration: none; font-weight: 600; transition: all 0.3s;">
                        Hubungi Kami
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- CTA Section -->
    <section
        style="padding: 80px 0; background: linear-gradient(135deg, #1a5632 0%, #0e3a20 100%); position: relative; overflow: hidden;">
        <div
            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: radial-gradient(circle at 30% 50%, rgba(212,168,83,0.1) 0%, transparent 50%);">
        </div>
        <div class="container" style="position: relative; z-index: 1; text-align: center;">
            <h2
                style="font-size: 2.5rem; color: #ffffff; margin-bottom: 16px; font-family: 'Playfair Display', serif; font-weight: 700;">
                Butuh Paket Custom?</h2>
            <p
                style="color: rgba(255,255,255,0.8); font-size: 1.1rem; margin-bottom: 32px; max-width: 600px; margin-left: auto; margin-right: auto;">
                Kami bisa menyesuaikan menu, porsi, dan budget sesuai keinginan Anda.
            </p>
            <a href="{{ route('contact') }}"
                style="display: inline-flex; align-items: center; gap: 10px; padding: 16px 40px; background: linear-gradient(135deg, #d4a853, #b8903a); color: white; border-radius: 50px; text-decoration: none; font-weight: 700; font-size: 1rem; transition: all 0.3s; box-shadow: 0 8px 25px rgba(212,168,83,0.3);"
                onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 12px 35px rgba(212,168,83,0.4)'"
                onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 25px rgba(212,168,83,0.3)'">
                Konsultasi Gratis →
            </a>
        </div>
    </section>
@endsection