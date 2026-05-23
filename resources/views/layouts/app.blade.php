<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mealvyn') - Premium Catering Online</title>
    <meta name="description" content="Mealvyn menyajikan catering premium dengan cita rasa terbaik.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --primary: #1a5632;
            --primary-light: #2d7a4a;
            --primary-dark: #0e3a20;
            --secondary: #d4a853;
            --secondary-light: #e8c478;
            --cream: #f9f5ed;
            --dark: #1a1a1a;
            --gray: #6b6b6b;
            --white: #ffffff;
            --shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--dark);
            line-height: 1.7;
            overflow-x: hidden;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Playfair Display', serif;
            line-height: 1.2;
        }

        a {
            text-decoration: none;
            color: inherit;
            transition: all 0.3s;
        }

        img {
            max-width: 100%;
            display: block;
        }

        ul {
            list-style: none;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
        }

        /* Navbar */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            padding: 20px 0;
            transition: all 0.3s;
        }

        .navbar.scrolled {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            padding: 12px 0;
            box-shadow: var(--shadow);
        }

        .navbar .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .nav-logo {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--white);
            letter-spacing: 2px;
        }

        .navbar.scrolled .nav-logo {
            color: var(--primary);
        }

        .nav-logo span {
            color: var(--secondary);
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 36px;
        }

        .nav-links a {
            font-size: 0.9rem;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.85);
            position: relative;
        }

        .navbar.scrolled .nav-links a {
            color: var(--gray);
        }

        .nav-links a:hover,
        .nav-links a.active {
            color: var(--secondary);
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--secondary);
            transition: all 0.3s;
        }

        .nav-links a:hover::after,
        .nav-links a.active::after {
            width: 100%;
        }

        .nav-cta {
            background: var(--secondary);
            color: var(--dark) !important;
            padding: 10px 28px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.3s;
        }

        .nav-cta::after {
            display: none !important;
        }

        .nav-cta:hover {
            background: var(--secondary-light);
            transform: translateY(-2px);
        }

        .hamburger {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
        }

        .hamburger span {
            width: 28px;
            height: 2.5px;
            background: var(--white);
            border-radius: 10px;
            transition: all 0.3s;
        }

        .navbar.scrolled .hamburger span {
            background: var(--dark);
        }

        .hamburger.active span:nth-child(1) {
            transform: rotate(45deg) translate(5px, 5px);
        }

        .hamburger.active span:nth-child(2) {
            opacity: 0;
        }

        .hamburger.active span:nth-child(3) {
            transform: rotate(-45deg) translate(6px, -6px);
        }

        .mobile-nav {
            position: fixed;
            top: 0;
            right: -100%;
            width: 100%;
            height: 100vh;
            background: var(--primary-dark);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 30px;
            transition: right 0.5s;
            z-index: 999;
        }

        .mobile-nav.active {
            right: 0;
        }

        .mobile-nav a {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            color: var(--white);
        }

        /* Footer */
        .footer {
            background: var(--dark);
            color: rgba(255, 255, 255, 0.6);
            padding: 80px 0 0;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1.5fr;
            gap: 50px;
            padding-bottom: 60px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .footer-brand .nav-logo {
            margin-bottom: 16px;
            display: inline-block;
        }

        .footer-brand p {
            font-size: 0.9rem;
            line-height: 1.8;
            margin-bottom: 24px;
        }

        .footer-socials {
            display: flex;
            gap: 12px;
        }

        .footer-social {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            border: 1px solid rgba(255, 255, 255, 0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }

        .footer-social:hover {
            background: var(--secondary);
            border-color: var(--secondary);
            color: var(--dark);
            transform: translateY(-3px);
        }

        .footer h4 {
            font-family: 'Inter', sans-serif;
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--white);
            margin-bottom: 24px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .footer-links li {
            margin-bottom: 12px;
        }

        .footer-links a {
            font-size: 0.88rem;
        }

        .footer-links a:hover {
            color: var(--secondary);
            padding-left: 6px;
        }

        .footer-bottom {
            padding: 24px 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 0.82rem;
        }

        @media (max-width: 1024px) {
            .footer-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .hamburger {
                display: flex;
            }

            .footer-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
    @stack('styles')
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar" id="navbar">
        <div class="container">
            <a href="{{ route('home') }}" class="nav-logo">Meal<span>vyn</span></a>
            <div class="nav-links">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>
                <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">Tentang</a>
                <a href="{{ route('services') }}"
                    class="{{ request()->routeIs('services') ? 'active' : '' }}">Layanan</a>
                <a href="{{ route('menu') }}" class="{{ request()->routeIs('menu') ? 'active' : '' }}">Menu</a>
                <a href="{{ route('pricing') }}" class="{{ request()->routeIs('pricing') ? 'active' : '' }}">Harga</a>

                @guest
                    <a href="{{ route('login') }}"
                        style="background: var(--secondary); color: var(--dark) !important; padding: 10px 24px; border-radius: 50px; font-weight: 600; font-size: 0.85rem; text-decoration: none; transition: all 0.3s;">🔐
                        Masuk</a>
                @else
                    <a href="{{ route('cart') }}"
                        style="background: var(--secondary); color: var(--dark) !important; padding: 10px 24px; border-radius: 50px; font-weight: 600; font-size: 0.85rem; text-decoration: none; transition: all 0.3s; display: inline-flex; align-items: center; gap: 6px;">
                        🛒 Keranjang
                        @if(session('cart'))
                            <span
                                style="background: var(--primary); color: white; font-size: 0.7rem; padding: 2px 6px; border-radius: 50%;">{{ count(session('cart')) }}</span>
                        @endif
                    </a>

                    <!-- User Dropdown -->
                    <div style="position: relative;">
                        <button onclick="toggleUserDropdown()"
                            style="background: none; border: 2px solid var(--secondary); color: var(--secondary); padding: 10px 20px; border-radius: 50px; cursor: pointer; font-weight: 600; display: flex; align-items: center; gap: 8px; transition: all 0.3s;"
                            id="userDropdownBtn">
                            <span style="font-size: 1.2rem;">👤</span>
                            <span>{{ explode(' ', auth()->user()->name)[0] }}</span>
                            <span style="font-size: 0.7rem;">▼</span>
                        </button>

                        <!-- Dropdown Menu -->
                        <div id="userDropdown"
                            style="display: none; position: absolute; right: 0; top: 120%; background: white; border-radius: 16px; box-shadow: 0 10px 40px rgba(0,0,0,0.15); min-width: 240px; z-index: 1000; margin-top: 8px; overflow: hidden; border: 1px solid rgba(0,0,0,0.05);">

                            <!-- User Info Header -->
                            <div
                                style="padding: 20px; border-bottom: 1px solid #f0f0f0; background: linear-gradient(135deg, #f9f9f9 0%, #ffffff 100%);">
                                <div style="font-weight: 700; color: #1a1a1a; font-size: 1rem; margin-bottom: 4px;">
                                    {{ auth()->user()->name }}</div>
                                <div style="font-size: 0.85rem; color: #6b6b6b; text-transform: capitalize;">
                                    {{ ucfirst(auth()->user()->level) }}</div>
                            </div>

                            <!-- Menu Items -->
                            @php $userLevel = strtolower(trim(auth()->user()->level ?? '')); @endphp

                            @if($userLevel === 'admin' || $userLevel === 'ceo')
                                <a href="{{ route('admin.dashboard') }}"
                                    style="display: flex; align-items: center; gap: 12px; padding: 14px 20px; color: #1a1a1a; text-decoration: none; font-size: 0.95rem; transition: all 0.2s; font-weight: 500;"
                                    onmouseover="this.style.background='#f0fdf4'; this.style.paddingLeft='24px'"
                                    onmouseout="this.style.background='white'; this.style.paddingLeft='20px'">
                                    <span style="font-size: 1.2rem;">⚙️</span>
                                    <span>Dashboard Admin</span>
                                </a>
                            @endif

                            @if($userLevel === 'pelanggan' || $userLevel === 'customer')
                                <a href="{{ route('pesanan.saya') }}"
                                    style="display: flex; align-items: center; gap: 12px; padding: 14px 20px; color: #1a1a1a; text-decoration: none; font-size: 0.95rem; transition: all 0.2s; font-weight: 500;"
                                    onmouseover="this.style.background='#f0fdf4'; this.style.paddingLeft='24px'"
                                    onmouseout="this.style.background='white'; this.style.paddingLeft='20px'">
                                    <span style="font-size: 1.2rem;">📦</span>
                                    <span>Paket Saya</span>
                                </a>
                            @endif

                            <a href="{{ route('home') }}"
                                style="display: flex; align-items: center; gap: 12px; padding: 14px 20px; color: #1a1a1a; text-decoration: none; font-size: 0.95rem; transition: all 0.2s; font-weight: 500;"
                                onmouseover="this.style.background='#f0fdf4'; this.style.paddingLeft='24px'"
                                onmouseout="this.style.background='white'; this.style.paddingLeft='20px'">
                                <span style="font-size: 1.2rem;">🏠</span>
                                <span>Beranda</span>
                            </a>

                            <!-- Logout -->
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    style="width: 100%; padding: 14px 20px; background: linear-gradient(135deg, #fee2e2, #fecaca); color: #dc2626; border: none; cursor: pointer; text-align: left; font-size: 0.95rem; font-weight: 600; display: flex; align-items: center; gap: 12px; transition: all 0.2s; border-top: 1px solid #f0f0f0;"
                                    onmouseover="this.style.background='linear-gradient(135deg, #fecaca, #fca5a5)'; this.style.paddingLeft='24px'"
                                    onmouseout="this.style.background='linear-gradient(135deg, #fee2e2, #fecaca)'; this.style.paddingLeft='20px'">
                                    <span style="font-size: 1.2rem;">🚪</span>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @endguest
            </div>
            <div class="hamburger" id="hamburger">
                <span></span><span></span><span></span>
            </div>
        </div>
    </nav>

    <!-- Mobile Nav -->
    <div class="mobile-nav" id="mobileNav">
        <a href="{{ route('home') }}" onclick="closeMobileNav()">Beranda</a>
        <a href="{{ route('about') }}" onclick="closeMobileNav()">Tentang</a>
        <a href="{{ route('services') }}" onclick="closeMobileNav()">Layanan</a>
        <a href="{{ route('menu') }}" onclick="closeMobileNav()">Menu</a>
        <a href="{{ route('pricing') }}" onclick="closeMobileNav()">Harga</a>

        @guest
            <a href="{{ route('login') }}" onclick="closeMobileNav()" style="color: var(--secondary);">🔐 Masuk</a>
            <a href="{{ route('register') }}" onclick="closeMobileNav()">Daftar Akun</a>
        @else
            <a href="{{ route('cart') }}" onclick="closeMobileNav()">🛒 Keranjang</a>
            @php $mLevel = strtolower(trim(auth()->user()->level ?? '')); @endphp
            @if($mLevel === 'pelanggan' || $mLevel === 'customer')
                <a href="{{ route('pesanan.saya') }}" onclick="closeMobileNav()">📦 Paket Saya</a>
            @endif
            @if($mLevel === 'admin' || $mLevel === 'ceo')
                <a href="{{ route('admin.dashboard') }}" onclick="closeMobileNav()">⚙️ Dashboard Admin</a>
            @endif
            <a href="{{ route('home') }}" onclick="closeMobileNav()">🏠 Beranda</a>
            <form action="{{ route('logout') }}" method="POST" style="display: inline; width: 100%;">
                @csrf
                <button type="submit"
                    style="width: 100%; background: none; border: none; color: #dc2626; font-family: 'Playfair Display', serif; font-size: 2rem; cursor: pointer; text-align: center;">Logout</button>
            </form>
        @endguest
    </div>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <a href="{{ route('home') }}" class="nav-logo">Meal<span>vyn</span></a>
                    <p>Mealvyn adalah layanan catering premium yang menghadirkan cita rasa autentik dengan sentuhan
                        modern untuk setiap momen spesial Anda.</p>
                    <div class="footer-socials">
                        <a href="#" class="footer-social">📘</a>
                        <a href="#" class="footer-social">📸</a>
                        <a href="#" class="footer-social">🐦</a>
                        <a href="#" class="footer-social">📺</a>
                    </div>
                </div>
                <div>
                    <h4>Menu</h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('home') }}">Beranda</a></li>
                        <li><a href="{{ route('about') }}">Tentang</a></li>
                        <li><a href="{{ route('services') }}">Layanan</a></li>
                        <li><a href="{{ route('menu') }}">Menu</a></li>
                        <li><a href="{{ route('pricing') }}">Harga</a></li>
                    </ul>
                </div>
                <div>
                    <h4>Layanan</h4>
                    <ul class="footer-links">
                        <li><a href="#">Catering Event</a></li>
                        <li><a href="#">Meal Box</a></li>
                        <li><a href="#">Nasi Box</a></li>
                        <li><a href="#">Dessert</a></li>
                        <li><a href="#">Coffee Break</a></li>
                    </ul>
                </div>
                <div class="footer-newsletter">
                    <h4>Newsletter</h4>
                    <p>Dapatkan promo eksklusif dan menu terbaru langsung di inbox Anda.</p>
                    <form class="newsletter-form"
                        onsubmit="event.preventDefault(); alert('Terima kasih telah berlangganan!');">
                        <input type="email" placeholder="Email Anda..." required>
                        <button type="submit">Kirim</button>
                    </form>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} Mealvyn. All rights reserved.</p>
                <p>Dibuat <strong style="color: var(--secondary);">Ahmad Ibrahimovic</strong> ❤️</p>
            </div>
        </div>
    </footer>

    <script>
        // Toggle User Dropdown
        function toggleUserDropdown() {
            const dropdown = document.getElementById('userDropdown');
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function (event) {
            const dropdown = document.getElementById('userDropdown');
            const button = document.getElementById('userDropdownBtn');
            if (!button.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.style.display = 'none';
            }
        });

        // Navbar Scroll
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', function () {
            navbar.classList.toggle('scrolled', window.scrollY > 80);
        });

        // Hamburger Menu
        const hamburger = document.getElementById('hamburger');
        const mobileNav = document.getElementById('mobileNav');

        if (hamburger && mobileNav) {
            hamburger.addEventListener('click', function () {
                hamburger.classList.toggle('active');
                mobileNav.classList.toggle('active');
                document.body.style.overflow = mobileNav.classList.contains('active') ? 'hidden' : '';
            });
        }

        function closeMobileNav() {
            if (hamburger) hamburger.classList.remove('active');
            if (mobileNav) mobileNav.classList.remove('active');
            document.body.style.overflow = '';
        }

        // Scroll to Top
        const scrollTopBtn = document.createElement('button');
        scrollTopBtn.innerHTML = '↑';
        scrollTopBtn.className = 'scroll-top';
        scrollTopBtn.style.cssText = 'position: fixed; bottom: 30px; right: 30px; width: 50px; height: 50px; background: var(--primary); color: white; border: none; border-radius: 50%; cursor: pointer; font-size: 1.2rem; z-index: 999; opacity: 0; visibility: hidden; transition: all 0.3s;';
        document.body.appendChild(scrollTopBtn);

        window.addEventListener('scroll', function () {
            scrollTopBtn.style.opacity = window.scrollY > 500 ? '1' : '0';
            scrollTopBtn.style.visibility = window.scrollY > 500 ? 'visible' : 'hidden';
        });

        scrollTopBtn.addEventListener('click', function () {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    </script>
    @stack('scripts')
</body>

</html>