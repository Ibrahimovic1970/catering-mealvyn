@extends('layouts.app')
@section('title', 'Beranda')

@section('content')
<section style="min-height: 100vh; display: flex; align-items: center; background: linear-gradient(135deg, #0e3a20 0%, #1a5632 50%, #2d7a4a 100%); position: relative; overflow: hidden;">
    <div style="position: absolute; top: -50%; right: -20%; width: 800px; height: 800px; background: radial-gradient(circle, rgba(212,168,83,0.12) 0%, transparent 70%); border-radius: 50%;"></div>
    <div class="container" style="position: relative; z-index: 2;">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center;">
            <div>
                <div style="display: inline-flex; align-items: center; gap: 8px; background: rgba(212,168,83,0.15); border: 1px solid rgba(212,168,83,0.3); padding: 8px 20px; border-radius: 50px; font-size: 0.8rem; color: #d4a853; font-weight: 500; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 24px;">
                    <span style="width: 8px; height: 8px; background: #d4a853; border-radius: 50%;"></span>✨ Premium Catering
                </div>
                <h1 style="font-size: 3.8rem; color: var(--white); margin-bottom: 20px; line-height: 1.1;">
                    Rasa <span style="color: #d4a853;">Sempurna</span> untuk Setiap Momen
                </h1>
                <p style="font-size: 1.1rem; color: rgba(255,255,255,0.7); margin-bottom: 40px; max-width: 480px; line-height: 1.8;">
                    Mealvyn menghadirkan pengalaman kuliner premium dengan bahan-bahan segar pilihan, dimasak oleh chef berpengalaman untuk acara spesial Anda.
                </p>
                <div style="display: flex; gap: 16px; flex-wrap: wrap;">
                    <a href="{{ route('menu') }}" style="display: inline-flex; align-items: center; gap: 10px; padding: 16px 36px; border-radius: 50px; font-size: 0.95rem; font-weight: 600; background: #d4a853; color: #1a1a1a; transition: all 0.3s;">Lihat Menu →</a>
                    <a href="{{ route('about') }}" style="display: inline-flex; align-items: center; gap: 10px; padding: 16px 36px; border-radius: 50px; font-size: 0.95rem; font-weight: 600; background: transparent; color: var(--white); border: 2px solid rgba(255,255,255,0.3); transition: all 0.3s;">Pelajari Lebih</a>
                </div>
                <div style="display: flex; gap: 40px; margin-top: 50px; padding-top: 30px; border-top: 1px solid rgba(255,255,255,0.1);">
                    <div>
                        <h3 style="font-size: 2rem; color: #d4a853; font-family: 'Inter', sans-serif; font-weight: 700;">5000+</h3>
                        <p style="font-size: 0.85rem; color: rgba(255,255,255,0.5);">Pelanggan Puas</p>
                    </div>
                    <div>
                        <h3 style="font-size: 2rem; color: #d4a853; font-family: 'Inter', sans-serif; font-weight: 700;">120+</h3>
                        <p style="font-size: 0.85rem; color: rgba(255,255,255,0.5);">Menu Pilihan</p>
                    </div>
                    <div>
                        <h3 style="font-size: 2rem; color: #d4a853; font-family: 'Inter', sans-serif; font-weight: 700;">8</h3>
                        <p style="font-size: 0.85rem; color: rgba(255,255,255,0.5);">Tahun Pengalaman</p>
                    </div>
                </div>
            </div>
            <div style="position: relative;">
                <div style="width: 85%; height: 85%; background: linear-gradient(145deg, #f9f5ed 0%, #f0e8d8 100%); border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); display: flex; align-items: center; justify-content: center; font-size: 8rem;">🍽️</div>
            </div>
        </div>
    </div>
</section>

<section style="padding: 100px 0; background: #f9f5ed;">
    <div class="container" style="text-align: center; max-width: 700px;">
        <h2 style="font-size: 2.5rem; margin-bottom: 20px;">Kenapa Memilih Mealvyn?</h2>
        <p style="color: #6b6b6b; margin-bottom: 40px;">Kami mengutamakan kualitas, kebersihan, dan kepuasan pelanggan dalam setiap hidangan yang kami sajikan.</p>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 30px;">
            <div style="background: var(--white); padding: 30px; border-radius: 16px; box-shadow: var(--shadow);">🌿<br><strong>Bahan Segar</strong><br><small>100% pilihan terbaik</small></div>
            <div style="background: var(--white); padding: 30px; border-radius: 16px; box-shadow: var(--shadow);">👨‍🍳<br><strong>Chef Profesional</strong><br><small>Berpengalaman 10+ tahun</small></div>
            <div style="background: var(--white); padding: 30px; border-radius: 16px; box-shadow: var(--shadow);">⏰<br><strong>Tepat Waktu</strong><br><small>Garansi pengiriman</small></div>
            <div style="background: var(--white); padding: 30px; border-radius: 16px; box-shadow: var(--shadow);">💎<br><strong>Premium Quality</strong><br><small>Standar bintang 5</small></div>
        </div>
    </div>
</section>

<section style="background: linear-gradient(135deg, #1a5632 0%, #0e3a20 100%); text-align: center; padding: 80px 0;">
    <div class="container">
        <h2 style="font-size: 2.5rem; color: var(--white); margin-bottom: 16px;">Siap Memesan?</h2>
        <p style="color: rgba(255,255,255,0.7); margin-bottom: 30px;">Dapatkan konsultasi gratis untuk acara spesial Anda.</p>
        <a href="{{ route('menu') }}" style="display: inline-block; padding: 14px 32px; border-radius: 50px; background: #d4a853; color: #1a1a1a; font-weight: 600; text-decoration: none;">Pesan Sekarang →</a>
    </div>
</section>
@endsection