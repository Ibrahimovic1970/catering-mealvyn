@extends('layouts.app')
@section('title', 'Harga')

@section('content')
<section style="padding: 150px 0 80px; background: linear-gradient(135deg, #0e3a20 0%, #1a5632 100%); text-align: center;">
    <div class="container">
        <h1 style="font-size: 3rem; color: var(--white); margin-bottom: 16px;">Paket Harga</h1>
        <p style="color: rgba(255,255,255,0.7);">Transparan, kompetitif, dan sesuai budget Anda</p>
    </div>
</section>

<section style="padding: 80px 0;">
    <div class="container">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 30px;">
            @foreach($pakets->groupBy('kategori') as $kategori => $group)
            <div style="background: var(--white); border-radius: 20px; border: 1px solid rgba(0,0,0,0.05); box-shadow: var(--shadow); overflow: hidden;">
                <div style="background: #1a5632; color: white; padding: 20px; text-align: center;">
                    <h3 style="font-size: 1.4rem;">{{ $kategori }}</h3>
                    <p style="font-size: 0.9rem; opacity: 0.8;">{{ $group->first()->jenis }}</p>
                </div>
                <div style="padding: 20px;">
                    @foreach($group as $p)
                    <div style="padding: 15px 0; border-bottom: 1px solid #eee;">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <strong>{{ $p->nama_paket }}</strong>
                            <span style="background: #f0fdf4; color: #1a5632; padding: 4px 8px; border-radius: 8px; font-size: 0.8rem;">{{ $p->jumlah_pax }} Pax</span>
                        </div>
                        <p style="font-size: 0.85rem; color: #6b6b6b; margin: 5px 0;">{{ Str::limit($p->deskripsi, 60) }}</p>
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 8px;">
                            <span style="font-weight: 700; color: #1a5632;">Rp {{ number_format($p->harga_paket, 0, ',', '.') }}</span>
                            <a href="{{ route('cart.add', ['id' => $p->id]) }}" style="font-size: 0.85rem; color: #d4a853; font-weight: 600;">Pesan →</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection