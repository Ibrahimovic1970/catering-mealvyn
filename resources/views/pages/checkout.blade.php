@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
    @php
        $subtotal = 0;
        foreach (session('cart', []) as $item) {
            $subtotal += ($item['harga_paket'] ?? 0) * ($item['qty'] ?? 1);
        }
    @endphp

    <style>
        /* --- STYLE UNTUK CUSTOM DROPDOWN DENGAN GAMBAR --- */
        .custom-dropdown-wrapper {
            position: relative;
            width: 100%;
            margin-bottom: 16px;
        }

        /* Tampilan Tombol Dropdown */
        .custom-dropdown-trigger {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 16px;
            background: #fff;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s;
            user-select: none;
        }
        .custom-dropdown-trigger:hover {
            border-color: #1a5632;
        }
        .custom-dropdown-trigger.open {
            border-color: #1a5632;
            border-radius: 10px 10px 0 0;
            background: #f9f9f9;
        }
        .custom-selected-content {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .custom-selected-content img {
            width: 24px;
            height: 24px;
            object-fit: contain;
        }
        .custom-selected-text {
            font-size: 0.95rem;
            color: #333;
        }
        .custom-selected-text.placeholder {
            color: #999;
        }
        .custom-arrow {
            transition: transform 0.3s;
        }
        .custom-dropdown-trigger.open .custom-arrow {
            transform: rotate(180deg);
        }

        /* Tampilan Opsi Dropdown (List) */
        .custom-dropdown-options {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            background: #fff;
            border: 2px solid #1a5632;
            border-top: 1px solid #eee;
            border-radius: 0 0 10px 10px;
            z-index: 100;
            max-height: 250px;
            overflow-y: auto;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .custom-dropdown-options.show {
            display: block;
        }

        .custom-option {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            cursor: pointer;
            transition: background 0.2s;
            border-bottom: 1px solid #f0f0f0;
        }
        .custom-option:hover {
            background: #f0fdf4;
        }
        .custom-option:last-child {
            border-bottom: none;
        }
        .custom-option img {
            width: 24px;
            height: 24px;
            object-fit: contain;
        }
        .custom-option span {
            font-size: 0.95rem;
            color: #333;
            font-weight: 500;
        }

        /* Styling Container Pembayaran */
        .payment-card {
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            padding: 20px;
            background: #fff;
            margin-bottom: 16px;
            transition: all 0.3s;
        }
        .payment-card.active {
            border-color: #1a5632;
            background: #f0fdf4;
        }
        .payment-card-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 16px;
        }
        .payment-card-icon {
            background: #1a5632;
            color: white;
            padding: 8px;
            border-radius: 8px;
            font-size: 1.1rem;
        }
        .payment-card-title h4 {
            margin: 0;
            font-size: 1rem;
            color: #333;
            font-weight: 700;
        }
        .payment-card-title p {
            margin: 2px 0 0;
            font-size: 0.8rem;
            color: #888;
        }

        /* Info Box */
        .payment-info-box {
            margin-top: 12px;
            padding: 12px;
            background: #fff;
            border: 1px dashed #1a5632;
            border-radius: 8px;
            display: none;
        }
        .payment-info-box.show {
            display: block;
        }
        .payment-info-title {
            font-size: 0.8rem;
            color: #666;
            margin-bottom: 4px;
        }
        .payment-info-value {
            font-size: 1.1rem;
            font-weight: 800;
            color: #1a5632;
            font-family: monospace;
        }
    </style>

    <section style="padding: 140px 0 80px; background-color: #fafaf5; min-height: 100vh;">
        <div class="container" style="max-width: 1100px;">

            <div style="margin-bottom: 40px; text-align: center;">
                <h1 style="font-family: 'Playfair Display', serif; font-size: 2.5rem; color: #1a5632; margin-bottom: 10px;">Checkout</h1>
                <p style="color: #6b6b6b; font-size: 1rem;">Lengkapi data pengiriman dan pilih metode pembayaran.</p>
            </div>

            <form action="{{ route('cart.process-checkout') }}" method="POST" id="checkoutForm">
                @csrf
                <div style="display: grid; grid-template-columns: 1.5fr 1fr; gap: 40px; align-items: start;">

                    <!-- KOLOM KIRI: DATA DIRI & ALAMAT -->
                    <div>
                        <div style="background: #ffffff; border-radius: 16px; padding: 32px; box-shadow: 0 4px 20px rgba(0,0,0,0.04); margin-bottom: 24px;">
                            <h2 style="font-family: 'Playfair Display', serif; font-size: 1.3rem; color: #1a5632; margin-bottom: 24px;">👤 Data Pelanggan</h2>

                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                                <div style="grid-column: 1 / -1;">
                                    <label style="display: block; font-size: 0.9rem; font-weight: 600; color: #333; margin-bottom: 8px;">Nama Lengkap <span style="color: #dc2626;">*</span></label>
                                    <input type="text" name="nama_pelanggan" value="{{ old('nama_pelanggan', auth()->user()->name ?? '') }}" required 
                                           style="width: 100%; padding: 14px 16px; border: 1px solid #e0e0e0; border-radius: 10px; font-size: 0.95rem; background: #fafafa;">
                                </div>
                                <div>
                                    <label style="display: block; font-size: 0.9rem; font-weight: 600; color: #333; margin-bottom: 8px;">Email <span style="color: #dc2626;">*</span></label>
                                    <input type="email" name="email" value="{{ old('email', auth()->user()->email ?? '') }}" required 
                                           style="width: 100%; padding: 14px 16px; border: 1px solid #e0e0e0; border-radius: 10px; font-size: 0.95rem; background: #fafafa;">
                                </div>
                                <div>
                                    <label style="display: block; font-size: 0.9rem; font-weight: 600; color: #333; margin-bottom: 8px;">No. Telepon / WA <span style="color: #dc2626;">*</span></label>
                                    <input type="tel" name="telepon" value="{{ old('telepon') }}" required placeholder="08xxxxxxxxxx"
                                           style="width: 100%; padding: 14px 16px; border: 1px solid #e0e0e0; border-radius: 10px; font-size: 0.95rem; background: #fafafa;">
                                </div>
                            </div>
                        </div>

                        <div style="background: #ffffff; border-radius: 16px; padding: 32px; box-shadow: 0 4px 20px rgba(0,0,0,0.04);">
                            <h2 style="font-family: 'Playfair Display', serif; font-size: 1.3rem; color: #1a5632; margin-bottom: 24px;">📍 Alamat Pengiriman</h2>

                            <div style="margin-bottom: 20px;">
                                <label style="display: block; font-size: 0.9rem; font-weight: 600; color: #333; margin-bottom: 8px;">Alamat Lengkap <span style="color: #dc2626;">*</span></label>
                                <textarea name="alamat" rows="3" required placeholder="Nama jalan, nomor rumah, RT/RW..."
                                          style="width: 100%; padding: 14px 16px; border: 1px solid #e0e0e0; border-radius: 10px; font-size: 0.95rem; resize: vertical; background: #fafafa;">{{ old('alamat') }}</textarea>
                            </div>

                            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 15px;">
                                <div>
                                    <label style="display: block; font-size: 0.85rem; font-weight: 600; color: #333; margin-bottom: 6px;">Provinsi <span style="color: #dc2626;">*</span></label>
                                    <select name="provinsi" id="provinsi" required onchange="loadCities()"
                                            style="width: 100%; padding: 14px 12px; border: 1px solid #e0e0e0; border-radius: 10px; font-size: 0.9rem; background: #fafafa; cursor: pointer;">
                                        <option value="">Pilih Provinsi</option>
                                        <!-- 38 PROVINSI -->
                                        <option value="Aceh">Aceh</option>
                                        <option value="Sumatera Utara">Sumatera Utara</option>
                                        <option value="Sumatera Barat">Sumatera Barat</option>
                                        <option value="Riau">Riau</option>
                                        <option value="Kepulauan Riau">Kepulauan Riau</option>
                                        <option value="Jambi">Jambi</option>
                                        <option value="Sumatera Selatan">Sumatera Selatan</option>
                                        <option value="Bangka Belitung">Bangka Belitung</option>
                                        <option value="Bengkulu">Bengkulu</option>
                                        <option value="Lampung">Lampung</option>
                                        <option value="DKI Jakarta">DKI Jakarta</option>
                                        <option value="Jawa Barat">Jawa Barat</option>
                                        <option value="Banten">Banten</option>
                                        <option value="Jawa Tengah">Jawa Tengah</option>
                                        <option value="DI Yogyakarta">DI Yogyakarta</option>
                                        <option value="Jawa Timur">Jawa Timur</option>
                                        <option value="Bali">Bali</option>
                                        <option value="Nusa Tenggara Barat">Nusa Tenggara Barat</option>
                                        <option value="Nusa Tenggara Timur">Nusa Tenggara Timur</option>
                                        <option value="Kalimantan Barat">Kalimantan Barat</option>
                                        <option value="Kalimantan Tengah">Kalimantan Tengah</option>
                                        <option value="Kalimantan Selatan">Kalimantan Selatan</option>
                                        <option value="Kalimantan Timur">Kalimantan Timur</option>
                                        <option value="Kalimantan Utara">Kalimantan Utara</option>
                                        <option value="Sulawesi Utara">Sulawesi Utara</option>
                                        <option value="Gorontalo">Gorontalo</option>
                                        <option value="Sulawesi Tengah">Sulawesi Tengah</option>
                                        <option value="Sulawesi Barat">Sulawesi Barat</option>
                                        <option value="Sulawesi Selatan">Sulawesi Selatan</option>
                                        <option value="Sulawesi Tenggara">Sulawesi Tenggara</option>
                                        <option value="Maluku">Maluku</option>
                                        <option value="Maluku Utara">Maluku Utara</option>
                                        <option value="Papua">Papua</option>
                                        <option value="Papua Barat">Papua Barat</option>
                                        <option value="Papua Selatan">Papua Selatan</option>
                                        <option value="Papua Tengah">Papua Tengah</option>
                                        <option value="Papua Pegunungan">Papua Pegunungan</option>
                                        <option value="Papua Barat Daya">Papua Barat Daya</option>
                                    </select>
                                </div>
                                <div>
                                    <label style="display: block; font-size: 0.85rem; font-weight: 600; color: #333; margin-bottom: 6px;">Kota/Kab <span style="color: #dc2626;">*</span></label>
                                    <select name="kota" id="kota" required disabled
                                            style="width: 100%; padding: 14px 12px; border: 1px solid #e0e0e0; border-radius: 10px; font-size: 0.9rem; background: #f5f5f5; color: #999;">
                                        <option value="">Pilih Provinsi Dulu</option>
                                    </select>
                                </div>
                                <div>
                                    <label style="display: block; font-size: 0.85rem; font-weight: 600; color: #333; margin-bottom: 6px;">Kecamatan <span style="color: #dc2626;">*</span></label>
                                    <select name="kecamatan" id="kecamatan" required disabled
                                            style="width: 100%; padding: 14px 12px; border: 1px solid #e0e0e0; border-radius: 10px; font-size: 0.9rem; background: #f5f5f5; color: #999;">
                                        <option value="">Pilih Kota Dulu</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- KOLOM KANAN: RINGKASAN & PEMBAYARAN -->
                    <div style="position: sticky; top: 100px;">
                        <div style="background: #ffffff; border-radius: 16px; padding: 32px; box-shadow: 0 8px 30px rgba(0,0,0,0.08); border: 1px solid rgba(0,0,0,0.03);">

                            <h2 style="font-family: 'Playfair Display', serif; font-size: 1.3rem; color: #1a5632; margin-bottom: 24px;">Ringkasan Pesanan</h2>

                            <div style="max-height: 180px; overflow-y: auto; margin-bottom: 20px; border-bottom: 1px solid #eee; padding-bottom: 15px;">
                                @foreach(session('cart', []) as $id => $item)
                                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                                        <div>
                                            <p style="font-weight: 600; color: #333; font-size: 0.95rem;">{{ $item['nama_paket'] }}</p>
                                            <p style="font-size: 0.8rem; color: #888;">{{ $item['jumlah_pax'] ?? 0 }} Pax × {{ $item['qty'] ?? 1 }}</p>
                                        </div>
                                        <p style="font-weight: 600; color: #1a5632;">Rp {{ number_format(($item['harga_paket'] ?? 0) * ($item['qty'] ?? 1), 0, ',', '.') }}</p>
                                    </div>
                                @endforeach
                            </div>

                            <div style="margin-bottom: 20px;">
                                <div style="display: flex; justify-content: space-between; margin-bottom: 8px; font-size: 0.95rem; color: #666;">
                                    <span>Subtotal</span>
                                    <span id="subtotalDisplay">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                                </div>
                                <div style="display: flex; justify-content: space-between; margin-bottom: 12px; font-size: 0.95rem; color: #666;">
                                    <span>Ongkos Kirim</span>
                                    <span id="ongkirDisplay" style="color: #1a5632; font-weight: 600;">Rp 0</span>
                                </div>
                                <div style="height: 2px; background: #eee; margin: 15px 0;"></div>
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <span style="font-size: 1.1rem; font-weight: 700; color: #333;">Total Bayar</span>
                                    <span id="totalDisplay" style="font-size: 1.4rem; font-weight: 800; color: #1a5632;">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                                </div>
                            </div>

                            <!-- METODE PEMBAYARAN DENGAN GAMBAR -->
                            <h3 style="font-size: 1rem; font-weight: 600; color: #333; margin-bottom: 16px;">💳 Metode Pembayaran</h3>

                            <!-- DROPDOWN BANK (DENGAN LOGO) -->
                            <div class="payment-card" id="ewalletCard" style="border-color: #0056D2;">
                                <div class="payment-card-header">
                                    <div class="payment-card-icon" style="background: #0000;">🏦</div>
                                    <div class="payment-card-title">
                                        <h4>Transfer E-Wallet</h4>
                                        <p>6 OPSI TERSEDIA</p>
                                    </div>
                                </div>

                                <!-- Custom Dropdown Bank -->
                                <div class="custom-dropdown-wrapper" onclick="toggleDropdown('bankDropdown')">
                                    <div class="custom-dropdown-trigger" id="bankDropdownTrigger">
                                        <div class="custom-selected-content">
                                            <span id="bankSelectedImg" style="display:none; width:20px; height:20px;"></span>
                                            <span id="bankSelectedText" class="custom-selected-text placeholder">-- Pilih Bank --</span>
                                        </div>
                                        <span class="custom-arrow">▼</span>
                                    </div>
                                    <div class="custom-dropdown-options" id="bankDropdown">
                                        <div class="custom-option" onclick="selectBank('Bank BCA', 'images/bca.png', '1234567890')">
                                            <img src="{{ asset('images/bca.png') }}" alt="BCA">
                                            <span>Bank BCA</span>
                                        </div>
                                        <div class="custom-option" onclick="selectBank('Bank Mandiri', 'images/mandiri.png', '0987654321')">
                                            <img src="{{ asset('images/mandiri.png') }}" alt="Mandiri">
                                            <span>Bank Mandiri</span>
                                        </div>
                                        <div class="custom-option" onclick="selectBank('Bank BRI', 'images/bri.png', '0123456789')">
                                            <img src="{{ asset('images/bri.png') }}" alt="BRI">
                                            <span>Bank BRI</span>
                                        </div>
                                        <div class="custom-option" onclick="selectBank('Bank BNI', 'images/bni.png', '9876543210')">
                                            <img src="{{ asset('images/bni.png') }}" alt="BNI">
                                            <span>Bank BNI</span>
                                        </div>
                                        <div class="custom-option" onclick="selectBank('Bank BSI', 'images/bsi.png', '7654321098')">
                                            <img src="{{ asset('images/bsi.png') }}" alt="BSI">
                                            <span>Bank BSI</span>
                                        </div>
                                        <div class="custom-option" onclick="selectBank('Bank Jago', 'images/jago.png', '1098765432')">
                                            <img src="{{ asset('images/jago.png') }}" alt="Jago">
                                            <span>Bank Jago</span>
                                        </div>
                                    </div>
                                    <!-- Hidden Input untuk Form -->
                                    <input type="hidden" name="metode_pembayaran" id="bankInput">
                                </div>

                                <div id="bankInfo" class="payment-info-box">
                                    <div class="payment-info-title">Nomor Rekening:</div>
                                    <div class="payment-info-value" id="bankRek">-</div>
                                    <div style="margin-top: 4px; font-size: 0.85rem; color: #666;">a.n. <strong>PT MEALVYN CATERING</strong></div>
                                </div>
                            </div>

                            <!-- DROPDOWN E-WALLET (DENGAN LOGO) -->
                            <div class="payment-card" id="ewalletCard" style="border-color: #0056D2;">
                                <div class="payment-card-header">
                                    <div class="payment-card-icon" style="background: #0056D2;">💳</div>
                                    <div class="payment-card-title">
                                        <h4>Transfer E-Wallet</h4>
                                        <p>6 OPSI TERSEDIA</p>
                                    </div>
                                </div>

                                <!-- Custom Dropdown E-Wallet -->
                                <div class="custom-dropdown-wrapper" onclick="toggleDropdown('ewalletDropdown')">
                                    <div class="custom-dropdown-trigger" id="ewalletDropdownTrigger">
                                        <div class="custom-selected-content">
                                            <span id="ewalletSelectedImg" style="display:none; width:20px; height:20px;"></span>
                                            <span id="ewalletSelectedText" class="custom-selected-text placeholder">-- Pilih E-Wallet --</span>
                                        </div>
                                        <span class="custom-arrow">▼</span>
                                    </div>
                                    <div class="custom-dropdown-options" id="ewalletDropdown">
                                        <div class="custom-option" onclick="selectEWallet('GoPay', 'images/gopay.png', '081917121615')">
                                            <img src="{{ asset('images/gopay.png') }}" alt="GoPay">
                                            <span>GoPay</span>
                                        </div>
                                        <div class="custom-option" onclick="selectEWallet('DANA', 'images/dana.png', '081917121615')">
                                            <img src="{{ asset('images/dana.png') }}" alt="DANA">
                                            <span>DANA</span>
                                        </div>
                                        <div class="custom-option" onclick="selectEWallet('OVO', 'images/ovo.png', '081917121615')">
                                            <img src="{{ asset('images/ovo.png') }}" alt="OVO">
                                            <span>OVO</span>
                                        </div>
                                        <div class="custom-option" onclick="selectEWallet('ShopeePay', 'images/shopeepay.png', '081917121615')">
                                            <img src="{{ asset('images/shopeepay.png') }}" alt="ShopeePay">
                                            <span>ShopeePay</span>
                                        </div>
                                        <div class="custom-option" onclick="selectEWallet('Bank Jago', 'images/jago.png', '109876543210')">
                                            <img src="{{ asset('images/jago.png') }}" alt="Jago">
                                            <span>Bank Jago</span>
                                        </div>
                                    </div>
                                    <!-- Hidden Input untuk Form -->
                                    <input type="hidden" name="metode_pembayaran" id="ewalletInput">
                                </div>

                                <div id="ewalletInfo" class="payment-info-box" style="border-color: #0056D2;">
                                    <div class="payment-info-title">Nomor Handphone / ID:</div>
                                    <div class="payment-info-value" id="ewalletNumber">-</div>
                                    <div style="margin-top: 4px; font-size: 0.85rem; color: #666;">a.n. <strong>MEALVYN CATERING</strong></div>
                                </div>
                            </div>

                            <button type="submit" 
                                    style="width: 100%; padding: 18px; background: linear-gradient(135deg, #1a5632 0%, #0e3a20 100%); color: white; border: none; border-radius: 12px; font-size: 1rem; font-weight: 700; cursor: pointer; transition: all 0.3s; box-shadow: 0 4px 15px rgba(26,86,50,0.3);"
                                    onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(26,86,50,0.4)'" 
                                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(26,86,50,0.3)'">
                                Konfirmasi Pesanan & Bayar
                            </button>

                            <p style="text-align: center; font-size: 0.8rem; color: #999; margin-top: 15px;"> Pembayaran Anda aman dan terenkripsi.</p>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </section>

    <script>
        // --- LOGIC UNTUK KOTA & KECAMATAN (SAMA SEPERTI SEBELUMNYA) ---
        const indoData = {
            'DKI Jakarta': {
                'Jakarta Pusat': ['Cempaka Putih', 'Gambir', 'Johar Baru', 'Kemayoran', 'Menteng', 'Sawah Besar', 'Senen', 'Tanah Abang'],
                'Jakarta Utara': ['Cilincing', 'Koja', 'Kelapa Gading', 'Pademangan', 'Penjaringan', 'Tanjung Priok'],
                'Jakarta Barat': ['Cengkareng', 'Grogol Petamburan', 'Kalideres', 'Kebon Jeruk', 'Kembangan', 'Palmerah', 'Taman Sari', 'Tambora'],
                'Jakarta Selatan': ['Cilandak', 'Jagakarsa', 'Kebayoran Baru', 'Kebayoran Lama', 'Mampang Prapatan', 'Pancoran', 'Pasar Minggu', 'Pesanggrahan', 'Setiabudi', 'Tebet'],
                'Jakarta Timur': ['Cakung', 'Cipayung', 'Duren Sawit', 'Jatinegara', 'Kramat Jati', 'Makasar', 'Matraman', 'Pasar Rebo', 'Pulogadung'],
            },
            'Jawa Barat': {
                'Kota Bandung': ['Andir', 'Antapani', 'Arcamanik', 'Astana Anyar', 'Babakan Ciparay', 'Bandung Kidul', 'Bandung Kulon', 'Bandung Wetan', 'Batununggal', 'Bojongloa Kaler', 'Bojongloa Kidul', 'Buahbatu', 'Cibeunying Kaler', 'Cibeunying Kidul', 'Cibiru', 'Cicendo', 'Cidadap', 'Cinambo', 'Coblong', 'Gedebage', 'Kiaracondong', 'Lengkong', 'Mandalajati', 'Panyileukan', 'Rancasari', 'Regol', 'Sukajadi', 'Sukasari', 'Sumur Bandung', 'Ujung Berung'],
                'Kota Bogor': ['Bogor Barat', 'Bogor Selatan', 'Bogor Tengah', 'Bogor Timur', 'Bogor Utara'],
                'Kota Bekasi': ['Bekasi Barat', 'Bekasi Selatan', 'Bekasi Timur', 'Bekasi Utara', 'Jatiasih', 'Jatisampurna', 'Medan Satria', 'Mustika Jaya', 'Pondok Gede', 'Rawalumbu'],
                'Kota Depok': ['Beji', 'Bojongsari', 'Cilodong', 'Cimanggis', 'Cinere', 'Cipayung', 'Limo', 'Pancoran Mas', 'Sawangan', 'Sukmajaya', 'Tapos'],
            },
        };
        const shippingCosts = {
            'DKI Jakarta': 15000, 'Jawa Barat': 25000, 'Banten': 25000,
            'Jawa Tengah': 35000, 'DI Yogyakarta': 35000, 'Jawa Timur': 35000,
            'Bali': 50000, 'Papua': 100000,
            'Aceh': 75000, 'Sumatera Utara': 75000, 'Sumatera Barat': 75000, 'Riau': 75000, 
            'Kepulauan Riau': 75000, 'Jambi': 75000, 'Sumatera Selatan': 75000, 'Bangka Belitung': 75000, 
            'Bengkulu': 75000, 'Lampung': 75000, 'Nusa Tenggara Barat': 50000, 'Nusa Tenggara Timur': 50000, 
            'Kalimantan Barat': 75000, 'Kalimantan Tengah': 75000, 'Kalimantan Selatan': 75000, 'Kalimantan Timur': 75000, 
            'Kalimantan Utara': 75000, 'Sulawesi Utara': 75000, 'Gorontalo': 75000, 'Sulawesi Tengah': 75000, 
            'Sulawesi Barat': 75000, 'Sulawesi Selatan': 75000, 'Sulawesi Tenggara': 75000, 'Maluku': 75000, 
            'Maluku Utara': 75000, 'Papua Barat': 100000, 'Papua Selatan': 100000, 'Papua Tengah': 100000, 
            'Papua Pegunungan': 100000, 'Papua Barat Daya': 100000
        };
        let currentOngkir = 0;

        function loadCities() {
            const provinsi = document.getElementById('provinsi').value;
            const kotaSelect = document.getElementById('kota');
            const kecamatanSelect = document.getElementById('kecamatan');

            kotaSelect.innerHTML = '<option value="">Pilih Kota/Kabupaten</option>';
            kecamatanSelect.innerHTML = '<option value="">Pilih Kota Dulu</option>';
            kecamatanSelect.disabled = true;

            if (indoData[provinsi]) {
                kotaSelect.disabled = false;
                kotaSelect.style.background = '#fafafa';
                kotaSelect.style.color = '#333';
                Object.keys(indoData[provinsi]).forEach(kota => {
                    const option = document.createElement('option');
                    option.value = kota;
                    option.textContent = kota;
                    kotaSelect.appendChild(option);
                });
            } else {
                kotaSelect.disabled = false;
                kotaSelect.innerHTML = '<option value="Kota 1">Kota 1</option>';
            }

            if (provinsi && shippingCosts[provinsi]) {
                currentOngkir = shippingCosts[provinsi];
                document.getElementById('ongkirDisplay').textContent = 'Rp ' + currentOngkir.toLocaleString('id-ID');
                updateTotal();
            }
        }

        document.getElementById('kota').addEventListener('change', function() {
            const provinsi = document.getElementById('provinsi').value;
            const kota = this.value;
            const kecamatanSelect = document.getElementById('kecamatan');

            kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';

            if (indoData[provinsi] && indoData[provinsi][kota]) {
                kecamatanSelect.disabled = false;
                kecamatanSelect.style.background = '#fafafa';
                kecamatanSelect.style.color = '#333';
                indoData[provinsi][kota].forEach(kec => {
                    const option = document.createElement('option');
                    option.value = kec;
                    option.textContent = kec;
                    kecamatanSelect.appendChild(option);
                });
            } else {
                kecamatanSelect.disabled = false;
                kecamatanSelect.innerHTML = '<option value="Kecamatan 1">Kecamatan 1</option>';
            }
        });

        function updateTotal() {
            const subtotalText = document.getElementById('subtotalDisplay').textContent.replace('Rp ', '').replace(/\./g, '');
            const subtotal = parseInt(subtotalText) || 0;
            const total = subtotal + currentOngkir;
            document.getElementById('totalDisplay').textContent = 'Rp ' + total.toLocaleString('id-ID');
        }

        // --- LOGIC UNTUK CUSTOM DROPDOWN (BANK & E-WALLET) ---

        // Fungsi Buka/Tutup Dropdown
        function toggleDropdown(id) {
            const dropdown = document.getElementById(id);
            const trigger = document.getElementById(id + 'Trigger');

            // Tutup semua dropdown lain dulu
            document.querySelectorAll('.custom-dropdown-options').forEach(d => {
                if(d.id !== id) d.classList.remove('show');
            });
            document.querySelectorAll('.custom-dropdown-trigger').forEach(t => {
                if(t.id !== id + 'Trigger') t.classList.remove('open');
            });

            // Toggle yang diklik
            dropdown.classList.toggle('show');
            trigger.classList.toggle('open');
        }

        // Fungsi Pilih Bank
        function selectBank(name, imgPath, rek) {
            // Update Tampilan
            document.getElementById('bankSelectedText').textContent = name;
            document.getElementById('bankSelectedText').classList.remove('placeholder');
            document.getElementById('bankSelectedImg').src = '{{ asset("") }}' + imgPath;
            document.getElementById('bankSelectedImg').style.display = 'block';

            // Update Info
            document.getElementById('bankRek').textContent = rek;
            document.getElementById('bankInfo').classList.add('show');

            // Update Hidden Input
            document.getElementById('bankInput').value = name;

            // Reset E-Wallet
            document.getElementById('ewalletCard').classList.remove('active');
            document.getElementById('ewalletSelectedText').textContent = '-- Pilih E-Wallet --';
            document.getElementById('ewalletSelectedText').classList.add('placeholder');
            document.getElementById('ewalletSelectedImg').style.display = 'none';
            document.getElementById('ewalletInfo').classList.remove('show');
            document.getElementById('ewalletInput').value = '';

            // Highlight Bank Card
            document.getElementById('bankCard').classList.add('active');

            // Tutup Dropdown
            toggleDropdown('bankDropdown');
        }

        // Fungsi Pilih E-Wallet
        function selectEWallet(name, imgPath, number) {
            // Update Tampilan
            document.getElementById('ewalletSelectedText').textContent = name;
            document.getElementById('ewalletSelectedText').classList.remove('placeholder');
            document.getElementById('ewalletSelectedImg').src = '{{ asset("") }}' + imgPath;
            document.getElementById('ewalletSelectedImg').style.display = 'block';

            // Update Info
            document.getElementById('ewalletNumber').textContent = number;
            document.getElementById('ewalletInfo').classList.add('show');

            // Update Hidden Input
            document.getElementById('ewalletInput').value = name;

            // Reset Bank
            document.getElementById('bankCard').classList.remove('active');
            document.getElementById('bankSelectedText').textContent = '-- Pilih Bank --';
            document.getElementById('bankSelectedText').classList.add('placeholder');
            document.getElementById('bankSelectedImg').style.display = 'none';
            document.getElementById('bankInfo').classList.remove('show');
            document.getElementById('bankInput').value = '';

            // Highlight E-Wallet Card
            document.getElementById('ewalletCard').classList.add('active');

            // Tutup Dropdown
            toggleDropdown('ewalletDropdown');
        }

        // Tutup dropdown jika klik di luar
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.custom-dropdown-wrapper')) {
                document.querySelectorAll('.custom-dropdown-options').forEach(d => d.classList.remove('show'));
                document.querySelectorAll('.custom-dropdown-trigger').forEach(t => t.classList.remove('open'));
            }
        });

        // Validasi Form
        document.getElementById('checkoutForm').addEventListener('submit', function(e) {
            const bankVal = document.getElementById('bankInput').value;
            const ewalletVal = document.getElementById('ewalletInput').value;

            if (!bankVal && !ewalletVal) {
                e.preventDefault();
                alert('Silakan pilih metode pembayaran (Bank atau E-Wallet)!');
            }
        });
    </script>
@endsection