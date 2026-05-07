@extends('layouts.app')
@section('title', 'Tentang Kami')

@section('content')
<section style="padding: 150px 0 80px; background: linear-gradient(135deg, #0e3a20 0%, #1a5632 100%); text-align: center;">
    <div class="container">
        <h1 style="font-size: 3rem; color: var(--white); margin-bottom: 16px;">Tentang Mealvyn</h1>
        <p style="color: rgba(255,255,255,0.7); font-size: 1.1rem; max-width: 600px; margin: 0 auto;">Mengenal lebih dekat kisah dan visi kami dalam menyajikan catering premium</p>
    </div>
</section>

<section style="padding: 80px 0;">
    <div class="container">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center;">
            <div>
                <h2 style="font-size: 2.2rem; margin-bottom: 20px;">Sejarah & Visi Kami</h2>
                <p style="color: #6b6b6b; margin-bottom: 15px; line-height: 1.8;">Mealvyn didirikan pada tahun 2016 dengan misi sederhana: menyajikan makanan berkualitas tinggi yang dapat diakses oleh semua orang. Berawal dari dapur kecil, kami kini telah melayani ribuan acara dan pelanggan yang puas.</p>
                <p style="color: #6b6b6b; margin-bottom: 20px; line-height: 1.8;">Kami percaya bahwa makanan yang baik adalah fondasi dari momen-momen berharga. Setiap hidangan dibuat dengan penuh cinta dan perhatian terhadap detail.</p>
                <ul style="margin-bottom: 20px;">
                    <li style="padding: 8px 0; color: #6b6b6b;">✅ Menjadi catering premium terdepan di Indonesia</li>
                    <li style="padding: 8px 0; color: #6b6b6b;">✅ Menyajikan makanan berkualitas dengan harga terjangkau</li>
                    <li style="padding: 8px 0; color: #6b6b6b;">✅ Memberikan pelayanan terbaik untuk setiap pelanggan</li>
                </ul>
            </div>
            <div style="background: linear-gradient(145deg, #1a5632 0%, #2d7a4a 100%); border-radius: 24px; height: 400px; display: flex; align-items: center; justify-content: center; font-size: 5rem; color: var(--white);">🏆</div>
        </div>
    </div>
</section>

<section style="padding: 80px 0; background: #f9f5ed; text-align: center;">
    <div class="container">
        <h2 style="font-size: 2.2rem; margin-bottom: 40px;">Tim Profesional Kami</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 30px;">
            <div style="background: var(--white); padding: 30px; border-radius: 16px; box-shadow: var(--shadow);">👨‍🍳<br><strong>Head Chef</strong><br><small>15 Tahun Pengalaman</small></div>
            <div style="background: var(--white); padding: 30px; border-radius: 16px; box-shadow: var(--shadow);">👩‍🍳<br><strong>Sous Chef</strong><br><small>Spesialis Nusantara</small></div>
            <div style="background: var(--white); padding: 30px; border-radius: 16px; box-shadow: var(--shadow);">🎨<br><strong>Food Stylist</strong><br><small>Presentasi Sempurna</small></div>
            <div style="background: var(--white); padding: 30px; border-radius: 16px; box-shadow: var(--shadow);">🚚<br><strong>Logistik</strong><br><small>Pengiriman Tepat Waktu</small></div>
        </div>
    </div>
</section>
@endsection