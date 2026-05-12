@extends('layouts.app')

@section('title', 'Harga')

@section('content')
<section style="padding: 150px 0 80px; background: linear-gradient(135deg, #0e3a20 0%, #1a5632 100%); text-align: center;">
    <div class="container">
        <h1 style="font-size: 3rem; color: var(--white); margin-bottom: 16px; font-family: 'Playfair Display', serif;">Paket Harga</h1>
        <p style="color: rgba(255,255,255,0.7); font-size: 1.1rem; max-width: 600px; margin: 0 auto;">Transparan, kompetitif, dan sesuai budget Anda</p>
    </div>
</section>

<section style="padding: 80px 0; background: var(--white);">
    <div class="container">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 30px;">
            @foreach($pakets->groupBy('kategori') as $kategori => $group)
            <div style="background: var(--white); border-radius: 20px; border: 1px solid rgba(0,0,0,0.05); box-shadow: var(--shadow); overflow: hidden;">
                <div style="background: #1a5632; color: white; padding: 20px; text-align: center;">
                    <h3 style="font-size: 1.4rem; margin-bottom: 4px;">{{ $kategori }}</h3>
                    <p style="font-size: 0.9rem; opacity: 0.8;">{{ $group->first()->jenis }}</p>
                </div>
                <div style="padding: 20px;">
                    @foreach($group as $p)
                    <div style="padding: 15px 0; border-bottom: 1px solid #eee;">
                        <div style="display: flex; gap: 12px; align-items: flex-start; margin-bottom: 10px;">
                            @if($p->foto1)
                            <img src="{{ asset('storage/' . $p->foto1) }}" alt="{{ $p->nama_paket }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px;">
                            @endif
                            <div style="flex: 1;">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                                    <strong style="font-size: 1rem;">{{ $p->nama_paket }}</strong>
                                    <span style="background: #f0fdf4; color: #1a5632; padding: 4px 8px; border-radius: 8px; font-size: 0.8rem;">{{ $p->jumlah_pax }} Pax</span>
                                </div>
                                <p style="font-size: 0.85rem; color: #6b6b6b; margin-bottom: 10px; line-height: 1.5;">{{ Str::limit($p->deskripsi, 80) }}</p>
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 12px;">
                                    <span style="font-weight: 700; color: #1a5632; font-size: 1.1rem;">Rp {{ number_format($p->harga_paket, 0, ',', '.') }}</span>

                                    <form action="{{ route('cart.add') }}" method="POST" style="display: inline;">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $p->id }}">
                                        <button type="submit" style="background: none; border: none; color: #d4a853; font-weight: 600; cursor: pointer; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 4px; transition: all 0.3s;" onmouseover="this.style.color='#1a5632'" onmouseout="this.style.color='#d4a853'">
                                            Pesan →
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section style="background: linear-gradient(135deg, #1a5632 0%, #0e3a20 100%); text-align: center; padding: 80px 0;">
    <div class="container">
        <h2 style="font-size: 2.5rem; color: var(--white); margin-bottom: 16px; font-family: 'Playfair Display', serif;">Butuh Paket Custom?</h2>
        <p style="color: rgba(255,255,255,0.7); font-size: 1.05rem; margin-bottom: 30px; max-width: 500px; margin-left: auto; margin-right: auto;">
            Kami bisa menyesuaikan menu, porsi, dan budget sesuai keinginan Anda.
        </p>
        <a href="{{ route('contact') }}" style="display: inline-flex; align-items: center; gap: 10px; padding: 14px 32px; border-radius: 50px; font-size: 0.95rem; font-weight: 600; background: #d4a853; color: #1a1a1a; text-decoration: none; transition: all 0.3s;">
            Konsultasi Gratis →
        </a>
    </div>
</section>
@endsection