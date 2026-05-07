@extends('layouts.app')
@section('title', 'Menu')

@section('content')
<section style="padding: 150px 0 80px; background: linear-gradient(135deg, #0e3a20 0%, #1a5632 100%); text-align: center;">
    <div class="container">
        <h1 style="font-size: 3rem; color: var(--white); margin-bottom: 16px;">Menu Kami</h1>
        <p style="color: rgba(255,255,255,0.7); font-size: 1.1rem;">Pilih paket catering terbaik untuk acara Anda</p>
    </div>
</section>

<section style="padding: 80px 0; background: #f9f5ed;">
    <div class="container">
        <div style="display: flex; justify-content: center; gap: 10px; margin-bottom: 40px; flex-wrap: wrap;" id="menuTabs">
            <button class="menu-tab active" data-filter="all" style="padding: 10px 20px; border: none; border-radius: 50px; background: var(--white); cursor: pointer; font-weight: 500;">🎯 Semua</button>
            <button class="menu-tab" data-filter="Pernikahan" style="padding: 10px 20px; border: none; border-radius: 50px; background: var(--white); cursor: pointer; font-weight: 500;">💒 Pernikahan</button>
            <button class="menu-tab" data-filter="Selamatan" style="padding: 10px 20px; border: none; border-radius: 50px; background: var(--white); cursor: pointer; font-weight: 500;">🤲 Selamatan</button>
            <button class="menu-tab" data-filter="Ulang Tahun" style="padding: 10px 20px; border: none; border-radius: 50px; background: var(--white); cursor: pointer; font-weight: 500;"> Ulang Tahun</button>
            <button class="menu-tab" data-filter="Studi Tour" style="padding: 10px 20px; border: none; border-radius: 50px; background: var(--white); cursor: pointer; font-weight: 500;">🎒 Studi Tour</button>
            <button class="menu-tab" data-filter="Rapat" style="padding: 10px 20px; border: none; border-radius: 50px; background: var(--white); cursor: pointer; font-weight: 500;">💼 Rapat</button>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 30px;" id="menuGrid">
            @foreach($pakets as $paket)
            <div class="menu-card" data-category="{{ $paket->kategori }}" style="background: var(--white); border-radius: 20px; overflow: hidden; box-shadow: var(--shadow); transition: transform 0.3s;">
                <div style="height: 180px; background: linear-gradient(135deg, #f0e8d8, #e6dcc8); display: flex; align-items: center; justify-content: center; font-size: 3rem;">
                    @if($paket->foto1) <img src="{{ asset('storage/' . $paket->foto1) }}" style="width:100%; height:100%; object-fit:cover;"> @else 🍽️ @endif
                </div>
                <div style="padding: 24px;">
                    <span style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; color: #b8903a; font-weight: 600; background: rgba(212,168,83,0.1); padding: 4px 10px; border-radius: 20px;">{{ $paket->kategori }}</span>
                    <h3 style="font-size: 1.3rem; margin: 10px 0 8px;">{{ $paket->nama_paket }}</h3>
                    <p style="color: #6b6b6b; font-size: 0.9rem; line-height: 1.5; margin-bottom: 15px;">{{ Str::limit($paket->deskripsi, 90) }}</p>
                    <div style="font-size: 0.85rem; color: #6b6b6b; margin-bottom: 15px;">👥 {{ $paket->jumlah_pax }} Pax | 📦 {{ $paket->jenis }}</div>
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div style="font-size: 1.2rem; font-weight: 700; color: #1a5632;">Rp {{ number_format($paket->harga_paket, 0, ',', '.') }} <small style="font-size: 0.8rem; color: #a0a0a0; font-weight: 400;">/pax</small></div>
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $paket->id }}">
                            <button type="submit" style="width: 40px; height: 40px; border-radius: 50%; background: #1a5632; color: var(--white); border: none; cursor: pointer; font-size: 1.2rem;">+</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@if(session('success'))
<div id="toast" style="position: fixed; bottom: 30px; right: 30px; background: #1a5632; color: white; padding: 16px 24px; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.2); z-index: 9999; display: flex; align-items: center; gap: 10px; animation: slideIn 0.5s ease;">
    <span>✓</span> <span>{{ session('success') }}</span>
</div>
@endif

<style>
    .menu-tab.active {
        background: #1a5632;
        color: white;
    }

    .menu-card:hover {
        transform: translateY(-5px);
    }

    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }

        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
</style>
<script>
    document.querySelectorAll('.menu-tab').forEach(tab => {
        tab.addEventListener('click', function() {
            document.querySelectorAll('.menu-tab').forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            const filter = this.dataset.filter;
            document.querySelectorAll('.menu-card').forEach(card => {
                card.style.display = (filter === 'all' || card.dataset.category === filter) ? 'block' : 'none';
            });
        });
    });
    setTimeout(() => {
        const t = document.getElementById('toast');
        if (t) t.remove();
    }, 4000);
</script>
@endsection