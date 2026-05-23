@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
    @php
        // Hitung subtotal lagi untuk jaga-jaga jika controller tidak mengirim
        $subtotal = 0;
        foreach (session('cart', []) as $item) {
            $subtotal += ($item['harga_paket'] ?? 0) * ($item['qty'] ?? 1);
        }
    @endphp

    <section style="padding: 140px 0 80px; background-color: #fafaf5; min-height: 100vh;">
        <div class="container" style="max-width: 1100px;">

            <div style="margin-bottom: 40px; text-align: center;">
                <h1 style="font-family: 'Playfair Display', serif; font-size: 2.5rem; color: #1a5632; margin-bottom: 10px;">
                    Checkout</h1>
                <p style="color: #6b6b6b; font-size: 1rem;">Lengkapi data pengiriman untuk menyelesaikan pesanan.</p>
            </div>

            @if(session('error'))
                <div
                    style="background: #fee2e2; border-left: 5px solid #dc2626; color: #dc2626; padding: 16px 24px; border-radius: 8px; margin-bottom: 30px;">
                    ⚠️ {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('cart.process-checkout') }}" method="POST" id="checkoutForm">
                @csrf
                <div style="display: grid; grid-template-columns: 1.5fr 1fr; gap: 40px; align-items: start;">

                    <!-- KOLOM KIRI: DATA DIRI -->
                    <div>
                        <div
                            style="background: #ffffff; border-radius: 16px; padding: 32px; box-shadow: 0 4px 20px rgba(0,0,0,0.04); margin-bottom: 24px; border: 1px solid rgba(0,0,0,0.03);">
                            <h2
                                style="font-family: 'Playfair Display', serif; font-size: 1.3rem; color: #1a5632; margin-bottom: 24px;">
                                👤 Data Pelanggan</h2>

                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                                <div style="grid-column: 1 / -1;">
                                    <label
                                        style="display: block; font-size: 0.9rem; font-weight: 600; color: #333; margin-bottom: 8px;">Nama
                                        Lengkap <span style="color: #dc2626;">*</span></label>
                                    <input type="text" name="nama_pelanggan"
                                        value="{{ old('nama_pelanggan', auth()->user()->name ?? '') }}" required
                                        style="width: 100%; padding: 14px 16px; border: 1px solid #e0e0e0; border-radius: 10px; font-size: 0.95rem; background: #fafafa;">
                                </div>
                                <div>
                                    <label
                                        style="display: block; font-size: 0.9rem; font-weight: 600; color: #333; margin-bottom: 8px;">Email
                                        <span style="color: #dc2626;">*</span></label>
                                    <input type="email" name="email" value="{{ old('email', auth()->user()->email ?? '') }}"
                                        required
                                        style="width: 100%; padding: 14px 16px; border: 1px solid #e0e0e0; border-radius: 10px; font-size: 0.95rem; background: #fafafa;">
                                </div>
                                <div>
                                    <label
                                        style="display: block; font-size: 0.9rem; font-weight: 600; color: #333; margin-bottom: 8px;">No.
                                        Telepon / WA <span style="color: #dc2626;">*</span></label>
                                    <input type="tel" name="telepon" value="{{ old('telepon') }}" required
                                        placeholder="08xxxxxxxxxx"
                                        style="width: 100%; padding: 14px 16px; border: 1px solid #e0e0e0; border-radius: 10px; font-size: 0.95rem; background: #fafafa;">
                                </div>
                            </div>
                        </div>

                        <div
                            style="background: #ffffff; border-radius: 16px; padding: 32px; box-shadow: 0 4px 20px rgba(0,0,0,0.04); border: 1px solid rgba(0,0,0,0.03);">
                            <h2
                                style="font-family: 'Playfair Display', serif; font-size: 1.3rem; color: #1a5632; margin-bottom: 24px;">
                                📍 Alamat Pengiriman</h2>

                            <div style="margin-bottom: 20px;">
                                <label
                                    style="display: block; font-size: 0.9rem; font-weight: 600; color: #333; margin-bottom: 8px;">Alamat
                                    Lengkap <span style="color: #dc2626;">*</span></label>
                                <textarea name="alamat" rows="3" required placeholder="Nama jalan, nomor rumah, RT/RW..."
                                    style="width: 100%; padding: 14px 16px; border: 1px solid #e0e0e0; border-radius: 10px; font-size: 0.95rem; resize: vertical; background: #fafafa;">{{ old('alamat') }}</textarea>
                            </div>

                            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 15px;">
                                <div>
                                    <label
                                        style="display: block; font-size: 0.85rem; font-weight: 600; color: #333; margin-bottom: 6px;">Provinsi
                                        <span style="color: #dc2626;">*</span></label>
                                    <select name="provinsi" id="provinsi" required onchange="hitungOngkir()"
                                        style="width: 100%; padding: 14px 12px; border: 1px solid #e0e0e0; border-radius: 10px; font-size: 0.9rem; background: #fafafa; cursor: pointer;">
                                        <option value="">Pilih Provinsi</option>
                                        <option value="DKI Jakarta">DKI Jakarta</option>
                                        <option value="Jawa Barat">Jawa Barat</option>
                                        <option value="Banten">Banten</option>
                                        <option value="Jawa Tengah">Jawa Tengah</option>
                                        <option value="DI Yogyakarta">DI Yogyakarta</option>
                                        <option value="Jawa Timur">Jawa Timur</option>
                                        <option value="Bali">Bali</option>
                                        <option value="Luar Pulau Jawa">Luar Pulau Jawa</option>
                                    </select>
                                </div>
                                <div>
                                    <label
                                        style="display: block; font-size: 0.85rem; font-weight: 600; color: #333; margin-bottom: 6px;">Kota/Kab
                                        <span style="color: #dc2626;">*</span></label>
                                    <select name="kota" id="kota" required disabled
                                        style="width: 100%; padding: 14px 12px; border: 1px solid #e0e0e0; border-radius: 10px; font-size: 0.9rem; background: #f5f5f5; color: #999;">
                                        <option value="">Pilih Provinsi Dulu</option>
                                    </select>
                                </div>
                                <div>
                                    <label
                                        style="display: block; font-size: 0.85rem; font-weight: 600; color: #333; margin-bottom: 6px;">Kecamatan
                                        <span style="color: #dc2626;">*</span></label>
                                    <input type="text" name="kecamatan" value="{{ old('kecamatan') }}" required
                                        placeholder="Kec."
                                        style="width: 100%; padding: 14px 12px; border: 1px solid #e0e0e0; border-radius: 10px; font-size: 0.9rem; background: #fafafa;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- KOLOM KANAN: RINGKASAN -->
                    <div style="position: sticky; top: 100px;">
                        <div
                            style="background: #ffffff; border-radius: 16px; padding: 32px; box-shadow: 0 8px 30px rgba(0,0,0,0.08); border: 1px solid rgba(0,0,0,0.03);">

                            <h2
                                style="font-family: 'Playfair Display', serif; font-size: 1.3rem; color: #1a5632; margin-bottom: 24px;">
                                Ringkasan Pesanan</h2>

                            <div
                                style="max-height: 180px; overflow-y: auto; margin-bottom: 20px; border-bottom: 1px solid #eee; padding-bottom: 15px;">
                                @foreach(session('cart', []) as $id => $item)
                                    <div
                                        style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                                        <div>
                                            <p style="font-weight: 600; color: #333; font-size: 0.95rem;">
                                                {{ $item['nama_paket'] }}</p>
                                            <p style="font-size: 0.8rem; color: #888;">{{ $item['jumlah_pax'] ?? 0 }} Pax ×
                                                {{ $item['qty'] ?? 1 }}</p>
                                        </div>
                                        <!-- TAMPILKAN HARGA BENAR -->
                                        <p style="font-weight: 600; color: #1a5632;">Rp
                                            {{ number_format(($item['harga_paket'] ?? 0) * ($item['qty'] ?? 1), 0, ',', '.') }}
                                        </p>
                                    </div>
                                @endforeach
                            </div>

                            <div style="margin-bottom: 20px;">
                                <div
                                    style="display: flex; justify-content: space-between; margin-bottom: 8px; font-size: 0.95rem; color: #666;">
                                    <span>Subtotal</span>
                                    <span id="subtotalDisplay">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                                </div>
                                <div
                                    style="display: flex; justify-content: space-between; margin-bottom: 12px; font-size: 0.95rem; color: #666;">
                                    <span>Ongkos Kirim</span>
                                    <span id="ongkirDisplay" style="color: #1a5632; font-weight: 600;">Rp 0</span>
                                </div>
                                <div style="height: 2px; background: #eee; margin: 15px 0;"></div>
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <span style="font-size: 1.1rem; font-weight: 700; color: #333;">Total Bayar</span>
                                    <span id="totalDisplay" style="font-size: 1.4rem; font-weight: 800; color: #1a5632;">Rp
                                        {{ number_format($subtotal, 0, ',', '.') }}</span>
                                </div>
                            </div>

                            <h3 style="font-size: 1rem; font-weight: 600; color: #333; margin-bottom: 15px;">Metode
                                Pembayaran</h3>

                            <div style="display: flex; flex-direction: column; gap: 10px; margin-bottom: 25px;">
                                <label class="payment-option"
                                    style="display: flex; align-items: center; padding: 14px; border: 2px solid #eee; border-radius: 10px; cursor: pointer; transition: all 0.2s;">
                                    <input type="radio" name="metode_pembayaran" value="Transfer Bank BCA" required
                                        style="margin-right: 12px; accent-color: #1a5632;">
                                    <div style="flex: 1;">
                                        <p style="font-weight: 600; font-size: 0.9rem; margin: 0;">Transfer Bank BCA</p>
                                    </div>
                                    <span
                                        style="font-size: 0.8rem; background: #e8f5e9; color: #1a5632; padding: 4px 8px; border-radius: 4px;">Otomatis</span>
                                </label>

                                <label class="payment-option"
                                    style="display: flex; align-items: center; padding: 14px; border: 2px solid #eee; border-radius: 10px; cursor: pointer; transition: all 0.2s;">
                                    <input type="radio" name="metode_pembayaran" value="Transfer Bank Mandiri" required
                                        style="margin-right: 12px; accent-color: #1a5632;">
                                    <div style="flex: 1;">
                                        <p style="font-weight: 600; font-size: 0.9rem; margin: 0;">Transfer Bank Mandiri</p>
                                    </div>
                                    <span
                                        style="font-size: 0.8rem; background: #e8f5e9; color: #1a5632; padding: 4px 8px; border-radius: 4px;">Otomatis</span>
                                </label>

                                <label class="payment-option"
                                    style="display: flex; align-items: center; padding: 14px; border: 2px solid #eee; border-radius: 10px; cursor: pointer; transition: all 0.2s;">
                                    <input type="radio" name="metode_pembayaran" value="E-Wallet" required
                                        style="margin-right: 12px; accent-color: #1a5632;">
                                    <div style="flex: 1;">
                                        <p style="font-weight: 600; font-size: 0.9rem; margin: 0;">E-Wallet (GoPay/OVO/Dana)
                                        </p>
                                    </div>
                                    <span
                                        style="font-size: 0.8rem; background: #fff3e0; color: #e65100; padding: 4px 8px; border-radius: 4px;">Instan</span>
                                </label>
                            </div>

                            <button type="submit"
                                style="width: 100%; padding: 18px; background: linear-gradient(135deg, #1a5632 0%, #0e3a20 100%); color: white; border: none; border-radius: 12px; font-size: 1rem; font-weight: 700; cursor: pointer; transition: all 0.3s; box-shadow: 0 4px 15px rgba(26,86,50,0.3);"
                                onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(26,86,50,0.4)'"
                                onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(26,86,50,0.3)'">
                                Konfirmasi Pesanan & Bayar
                            </button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </section>

    <script>
        // DATA KOTA PER PROVINSI
        const citiesData = {
            'DKI Jakarta': ['Jakarta Pusat', 'Jakarta Utara', 'Jakarta Barat', 'Jakarta Selatan', 'Jakarta Timur'],
            'Jawa Barat': ['Bandung', 'Bogor', 'Depok', 'Bekasi', 'Cimahi', 'Tasikmalaya', 'Cirebon', 'Sukabumi'],
            'Banten': ['Tangerang', 'Serang', 'Cilegon', 'Lebak', 'Pandeglang'],
            'Jawa Tengah': ['Semarang', 'Solo', 'Magelang', 'Purwokerto', 'Pekalongan', 'Tegal'],
            'DI Yogyakarta': ['Yogyakarta', 'Sleman', 'Bantul', 'Kulon Progo', 'Gunung Kidul'],
            'Jawa Timur': ['Surabaya', 'Malang', 'Kediri', 'Blitar', 'Madiun', 'Probolinggo', 'Pasuruan'],
            'Bali': ['Denpasar', 'Ubud', 'Kuta', 'Sanur', 'Tabanan', 'Gianyar'],
            'Luar Pulau Jawa': ['Makassar', 'Manado', 'Balikpapan', 'Banjarmasin', 'Palembang', 'Medan', 'Padang', 'Pontianak']
        };

        // HARGA ONGKIR BERDASARKAN ZONA (JARAK)
        const shippingCosts = {
            'DKI Jakarta': 15000,       // Terdekat (Dalam Kota)
            'Jawa Barat': 25000,        // Dekat (Jabodetabek)
            'Banten': 25000,            // Dekat (Jabodetabek)
            'Jawa Tengah': 35000,       // Sedang (Pulau Jawa)
            'DI Yogyakarta': 35000,     // Sedang (Pulau Jawa)
            'Jawa Timur': 35000,        // Sedang (Pulau Jawa)
            'Bali': 50000,              // Jauh (Luar Jawa Dekat)
            'Luar Pulau Jawa': 75000    // Sangat Jauh (Sumatera, Kalimantan, dll)
        };

        let currentOngkir = 0;

        function hitungOngkir() {
            const provinsiSelect = document.getElementById('provinsi');
            const kotaSelect = document.getElementById('kota');
            const selectedProvinsi = provinsiSelect.value;

            // 1. Reset Kota
            kotaSelect.innerHTML = '<option value="">Pilih Kota/Kabupaten</option>';
            kotaSelect.disabled = true;
            kotaSelect.style.background = '#f5f5f5';

            // 2. Isi Kota Berdasarkan Provinsi
            if (citiesData[selectedProvinsi]) {
                kotaSelect.disabled = false;
                kotaSelect.style.background = '#fafafa';
                citiesData[selectedProvinsi].forEach(city => {
                    const option = document.createElement('option');
                    option.value = city;
                    option.textContent = city;
                    kotaSelect.appendChild(option);
                });
            }

            // 3. Hitung Ongkir Berdasarkan Zona
            currentOngkir = shippingCosts[selectedProvinsi] || 0;
            document.getElementById('ongkirDisplay').textContent = 'Rp ' + currentOngkir.toLocaleString('id-ID');

            // 4. Update Total Akhir
            updateTotal();
        }

        function updateTotal() {
            const subtotalText = document.getElementById('subtotalDisplay').textContent.replace('Rp ', '').replace(/\./g, '');
            const subtotal = parseInt(subtotalText) || 0;
            const total = subtotal + currentOngkir;
            document.getElementById('totalDisplay').textContent = 'Rp ' + total.toLocaleString('id-ID');
        }

        // Efek Visual saat pilih Pembayaran
        document.querySelectorAll('input[name="metode_pembayaran"]').forEach(radio => {
            radio.addEventListener('change', function () {
                document.querySelectorAll('.payment-option').forEach(opt => {
                    opt.style.borderColor = '#eee';
                    opt.style.background = '#fff';
                });
                if (this.checked) {
                    this.closest('.payment-option').style.borderColor = '#1a5632';
                    this.closest('.payment-option').style.background = '#f0fdf4';
                }
            });
        });
    </script>
@endsection