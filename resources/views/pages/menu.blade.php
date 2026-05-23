@extends('layouts.app')

@section('title', 'Menu Kami')

@section('content')
<!-- Hero Section -->
<section style="padding: 140px 0 60px; background: linear-gradient(135deg, #0e3a20 0%, #1a5632 100%); position: relative; overflow: hidden;">
    <div style="position: absolute; top: -50%; right: -10%; width: 600px; height: 600px; background: radial-gradient(circle, rgba(212,168,83,0.1) 0%, transparent 70%); border-radius: 50%;"></div>
    <div class="container" style="position: relative; z-index: 1; text-align: center;">
        <h1 style="font-size: 3rem; color: #ffffff; font-family: 'Playfair Display', serif; margin-bottom: 16px; font-weight: 700;">Menu Kami</h1>
        <p style="color: rgba(255,255,255,0.8); font-size: 1.1rem; max-width: 600px; margin: 0 auto;">Pilih paket catering terbaik untuk acara Anda</p>
    </div>
</section>

<!-- Filter & Menu Section -->
<section style="padding: 60px 0; background: #f9f5ed; min-height: 600px;">
    <div class="container">
        
        <!-- Filter Buttons -->
        <div style="display: flex; justify-content: center; gap: 12px; margin-bottom: 50px; flex-wrap: wrap;">
            <button class="filter-btn active" data-filter="all" 
                    style="padding: 12px 28px; border: 2px solid #1a5632; border-radius: 50px; background: #1a5632; color: white; cursor: pointer; font-weight: 600; transition: all 0.3s; font-size: 0.9rem;">
                🎯 Semua Paket
            </button>
            <button class="filter-btn" data-filter="Pernikahan" 
                    style="padding: 12px 28px; border: 2px solid #1a5632; border-radius: 50px; background: white; color: #1a5632; cursor: pointer; font-weight: 600; transition: all 0.3s; font-size: 0.9rem;">
                💒 Pernikahan
            </button>
            <button class="filter-btn" data-filter="Selamatan" 
                    style="padding: 12px 28px; border: 2px solid #1a5632; border-radius: 50px; background: white; color: #1a5632; cursor: pointer; font-weight: 600; transition: all 0.3s; font-size: 0.9rem;">
                🤲 Selamatan
            </button>
            <button class="filter-btn" data-filter="Ulang Tahun" 
                    style="padding: 12px 28px; border: 2px solid #1a5632; border-radius: 50px; background: white; color: #1a5632; cursor: pointer; font-weight: 600; transition: all 0.3s; font-size: 0.9rem;">
                🎂 Ulang Tahun
            </button>
            <button class="filter-btn" data-filter="Studi Tour" 
                    style="padding: 12px 28px; border: 2px solid #1a5632; border-radius: 50px; background: white; color: #1a5632; cursor: pointer; font-weight: 600; transition: all 0.3s; font-size: 0.9rem;">
                🎒 Studi Tour
            </button>
            <button class="filter-btn" data-filter="Rapat" 
                    style="padding: 12px 28px; border: 2px solid #1a5632; border-radius: 50px; background: white; color: #1a5632; cursor: pointer; font-weight: 600; transition: all 0.3s; font-size: 0.9rem;">
                💼 Rapat
            </button>
        </div>

        <!-- Menu Grid -->
        <div id="menuGrid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 30px;">
            @forelse($pakets as $paket)
            <div class="menu-card" data-category="{{ $paket->kategori }}" 
                 style="background: white; border-radius: 20px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.08); transition: all 0.3s; border: 1px solid rgba(0,0,0,0.04);">
                
                <!-- Image -->
                <div style="height: 220px; background: linear-gradient(135deg, #f0e8d8 0%, #e6dcc8 100%); display: flex; align-items: center; justify-content: center; position: relative; overflow: hidden;">
                    @if($paket->foto1)
                        <img src="{{ asset('storage/' . $paket->foto1) }}" alt="{{ $paket->nama_paket }}" 
                             style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                        <span style="font-size: 5rem; opacity: 0.3;">🍽️</span>
                    @endif
                    
                    @if($loop->first)
                    <div style="position: absolute; top: 16px; left: 16px; background: linear-gradient(135deg, #d4a853, #b8903a); color: white; padding: 6px 16px; border-radius: 20px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">
                        ⭐ Best Seller
                    </div>
                    @endif
                </div>

                <!-- Content -->
                <div style="padding: 28px;">
                    <!-- Category Badge -->
                    <span style="display: inline-block; background: rgba(26,86,50,0.1); color: #1a5632; padding: 6px 14px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 12px;">
                        {{ $paket->kategori }}
                    </span>

                    <!-- Title -->
                    <h3 style="font-size: 1.3rem; color: #1a1a1a; margin-bottom: 12px; font-family: 'Playfair Display', serif; font-weight: 600;">
                        {{ $paket->nama_paket }}
                    </h3>

                    <!-- Description -->
                    <p style="color: #6b6b6b; font-size: 0.9rem; line-height: 1.6; margin-bottom: 20px;">
                        {{ Str::limit($paket->deskripsi, 120) }}
                    </p>

                    <!-- Details -->
                    <div style="display: flex; gap: 16px; margin-bottom: 20px; padding: 16px; background: #f9f5ed; border-radius: 12px;">
                        <div style="display: flex; align-items: center; gap: 8px; color: #1a5632; font-weight: 600; font-size: 0.9rem;">
                            <span>👥</span>
                            <span>{{ $paket->jumlah_pax }} Pax</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 8px; color: #1a5632; font-weight: 600; font-size: 0.9rem;">
                            <span>📦</span>
                            <span>{{ $paket->jenis }}</span>
                        </div>
                    </div>

                    <!-- Price & Button -->
                    <div style="display: flex; justify-content: space-between; align-items: center; padding-top: 20px; border-top: 2px dashed #e0e0e0;">
                        <div>
                            <p style="font-size: 0.85rem; color: #6b6b6b; margin-bottom: 4px;">Harga per pax</p>
                            <p style="font-size: 1.6rem; font-weight: 700; color: #1a5632; font-family: 'Playfair Display', serif;">
                                Rp {{ number_format($paket->harga_paket, 0, ',', '.') }}
                            </p>
                        </div>
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $paket->id }}">
                            <button type="submit" 
                                    style="width: 50px; height: 50px; border-radius: 50%; background: linear-gradient(135deg, #1a5632, #0e3a20); color: white; border: none; cursor: pointer; font-size: 1.5rem; transition: all 0.3s; display: flex; align-items: center; justify-content: center;"
                                    onmouseover="this.style.transform='scale(1.1)'; this.style.boxShadow='0 8px 20px rgba(26,86,50,0.3)'" 
                                    onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='none'">
                                +
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div style="grid-column: 1/-1; text-align: center; padding: 80px 20px;">
                <div style="font-size: 5rem; margin-bottom: 20px; opacity: 0.3;">📦</div>
                <h3 style="font-size: 1.5rem; color: #1a1a1a; margin-bottom: 8px; font-family: 'Playfair Display', serif;">Belum Ada Menu Tersedia</h3>
                <p style="color: #6b6b6b; margin-bottom: 24px;">Silakan hubungi kami untuk informasi lebih lanjut</p>
                <a href="{{ route('contact') }}" 
                   style="display: inline-block; padding: 14px 32px; background: #1a5632; color: white; border-radius: 50px; text-decoration: none; font-weight: 600; transition: all 0.3s;">
                    Hubungi Kami
                </a>
            </div>
            @endforelse
        </div>
    </div>
</section>

<script>
// Filter functionality
document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        // Update active button
        document.querySelectorAll('.filter-btn').forEach(b => {
            b.style.background = 'white';
            b.style.color = '#1a5632';
        });
        this.style.background = '#1a5632';
        this.style.color = 'white';

        // Filter cards
        const filter = this.getAttribute('data-filter');
        document.querySelectorAll('.menu-card').forEach(card => {
            if (filter === 'all' || card.getAttribute('data-category') === filter) {
                card.style.display = 'block';
                card.style.animation = 'fadeIn 0.5s ease';
            } else {
                card.style.display = 'none';
            }
        });
    });
});

// Add fadeIn animation
const style = document.createElement('style');
style.textContent = `
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
`;
document.head.appendChild(style);
</script>
@endsection