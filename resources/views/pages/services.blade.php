@extends('layouts.app')
@section('title', 'Layanan')

@section('content')
<section style="padding: 150px 0 80px; background: linear-gradient(135deg, #0e3a20 0%, #1a5632 100%); text-align: center;">
    <div class="container">
        <h1 style="font-size: 3rem; color: var(--white); margin-bottom: 16px;">Layanan Kami</h1>
        <p style="color: rgba(255,255,255,0.7); font-size: 1.1rem;">Solusi catering lengkap untuk berbagai kebutuhan acara Anda</p>
    </div>
</section>

<section style="padding: 80px 0;">
    <div class="container">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px;">
            <div style="background: var(--white); border-radius: 20px; padding: 40px; border: 1px solid rgba(0,0,0,0.05); box-shadow: var(--shadow);">
                <div style="font-size: 3rem; margin-bottom: 15px;">🎉</div>
                <h3 style="font-size: 1.4rem; margin-bottom: 10px;">Catering Event</h3>
                <p style="color: #6b6b6b; font-size: 0.95rem; line-height: 1.6;">Pernikahan, ulang tahun, gathering perusahaan. Buffet, plated, atau live cooking station.</p>
            </div>
            <div style="background: var(--white); border-radius: 20px; padding: 40px; border: 1px solid rgba(0,0,0,0.05); box-shadow: var(--shadow);">
                <div style="font-size: 3rem; margin-bottom: 15px;">📦</div>
                <h3 style="font-size: 1.4rem; margin-bottom: 10px;">Meal Box</h3>
                <p style="color: #6b6b6b; font-size: 0.95rem; line-height: 1.6;">Praktis dan bergizi untuk kantor, seminar, atau outdoor. Kemasan eco-friendly.</p>
            </div>
            <div style="background: var(--white); border-radius: 20px; padding: 40px; border: 1px solid rgba(0,0,0,0.05); box-shadow: var(--shadow);">
                <div style="font-size: 3rem; margin-bottom: 15px;">🍱</div>
                <h3 style="font-size: 1.4rem; margin-bottom: 10px;">Nasi Box Premium</h3>
                <p style="color: #6b6b6b; font-size: 0.95rem; line-height: 1.6;">Presentasi elegan untuk meeting bisnis dan workshop. Bisa custom logo.</p>
            </div>
            <div style="background: var(--white); border-radius: 20px; padding: 40px; border: 1px solid rgba(0,0,0,0.05); box-shadow: var(--shadow);">
                <div style="font-size: 3rem; margin-bottom: 15px;">☕</div>
                <h3 style="font-size: 1.4rem; margin-bottom: 10px;">Coffee Break</h3>
                <p style="color: #6b6b6b; font-size: 0.95rem; line-height: 1.6;">Kopi premium, pastry, fruit platter, dan snack untuk menemani diskusi.</p>
            </div>
        </div>
        <div style="text-align: center; margin-top: 50px;">
            <a href="{{ route('menu') }}" style="display: inline-block; padding: 14px 32px; border-radius: 50px; background: #1a5632; color: var(--white); font-weight: 600; text-decoration: none;">Lihat Menu Lengkap</a>
        </div>
    </div>
</section>
@endsection