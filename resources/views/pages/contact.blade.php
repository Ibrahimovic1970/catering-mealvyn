@extends('layouts.app')
@section('title', 'Kontak')

@section('content')
<section style="padding: 150px 0 80px; background: linear-gradient(135deg, #0e3a20 0%, #1a5632 100%); text-align: center;">
    <div class="container">
        <h1 style="font-size: 3rem; color: var(--white); margin-bottom: 16px;">Hubungi Kami</h1>
        <p style="color: rgba(255,255,255,0.7);">Kami siap membantu mewujudkan acara impian Anda</p>
    </div>
</section>

<section style="padding: 80px 0; background: #f9f5ed;">
    <div class="container">
        <div style="max-width: 600px; margin: 0 auto; background: white; border-radius: 24px; padding: 40px; box-shadow: var(--shadow);">
            <h2 style="text-align: center; margin-bottom: 30px;">Kirim Pesan</h2>
            <form style="display: flex; flex-direction: column; gap: 20px;">
                <input type="text" placeholder="Nama Lengkap" style="padding: 14px; border: 1px solid #ddd; border-radius: 10px;">
                <input type="email" placeholder="Email" style="padding: 14px; border: 1px solid #ddd; border-radius: 10px;">
                <textarea rows="5" placeholder="Pesan Anda..." style="padding: 14px; border: 1px solid #ddd; border-radius: 10px; resize: vertical;"></textarea>
                <button type="submit" style="padding: 16px; background: #1a5632; color: white; border: none; border-radius: 50px; font-weight: 600; cursor: pointer;">Kirim Pesan →</button>
            </form>
            <div style="margin-top: 40px; padding-top: 30px; border-top: 1px solid #eee; text-align: center;">
                <p style="margin-bottom: 10px;">📍 Jl. Sudirman No. 123, Jakarta Selatan</p>
                <p style="margin-bottom: 10px;">📞 +62 812 3456 7890</p>
                <p>✉️ hello@mealvyn.id</p>
            </div>
        </div>
    </div>
</section>
@endsection