<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mealvyn') - Premium Catering Online</title>
    <meta name="description" content="Mealvyn menyajikan catering premium dengan cita rasa terbaik.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

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

        .nav-cta {
            background: var(--secondary);
            color: var(--dark) !important;
            padding: 10px 28px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-cta:hover {
            background: var(--secondary-light);
            transform: translateY(-2px);
        }

        .cart-badge {
            background: var(--primary);
            color: var(--white);
            font-size: 0.7rem;
            padding: 2px 8px;
            border-radius: 50%;
            margin-left: 4px;
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

        .footer-newsletter p {
            font-size: 0.88rem;
            margin-bottom: 16px;
        }

        .newsletter-form {
            display: flex;
            gap: 8px;
        }

        .newsletter-form input {
            flex: 1;
            padding: 12px 18px;
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 50px;
            background: rgba(255, 255, 255, 0.05);
            color: var(--white);
            font-size: 0.88rem;
        }

        .newsletter-form input:focus {
            outline: none;
            border-color: var(--secondary);
        }

        .newsletter-form input::placeholder {
            color: rgba(255, 255, 255, 0.3);
        }

        .newsletter-form button {
            padding: 12px 24px;
            background: var(--secondary);
            color: var(--dark);
            border: none;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
        }

        .newsletter-form button:hover {
            background: var(--secondary-light);
        }

        .footer-bottom {
            padding: 24px 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 0.82rem;
        }

        .scroll-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            background: var(--primary);
            color: var(--white);
            border: none;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            z-index: 999;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s;
        }

        .scroll-top.visible {
            opacity: 1;
            visibility: visible;
        }

        .scroll-top:hover {
            background: var(--secondary);
            color: var(--dark);
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
                <a href="{{ route('services') }}" class="{{ request()->routeIs('services') ? 'active' : '' }}">Layanan</a>
                <a href="{{ route('menu') }}" class="{{ request()->routeIs('menu') ? 'active' : '' }}">Menu</a>
                <a href="{{ route('pricing') }}" class="{{ request()->routeIs('pricing') ? 'active' : '' }}">Harga</a>
                <a href="{{ route('cart') }}" class="nav-cta">
                    <span>🛒</span> Keranjang
                    @if(session('cart'))
                    <span class="cart-badge">{{ count(session('cart')) }}</span>
                    @endif
                </a>
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
        <a href="{{ route('cart') }}" onclick="closeMobileNav()">Keranjang</a>
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
                    <p>Mealvyn adalah layanan catering premium yang menghadirkan cita rasa autentik dengan sentuhan modern untuk setiap momen spesial Anda.</p>
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
                    <form class="newsletter-form" onsubmit="event.preventDefault(); alert('Terima kasih telah berlangganan!');">
                        <input type="email" placeholder="Email Anda..." required>
                        <button type="submit">Kirim</button>
                    </form>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} Mealvyn. All rights reserved.</p>
                <p>Indonesia</p>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top -->
    <button class="scroll-top" id="scrollTop">↑</button>

    <script>
        // Navbar Scroll
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', function() {
            navbar.classList.toggle('scrolled', window.scrollY > 80);
        });

        // Hamburger Menu
        const hamburger = document.getElementById('hamburger');
        const mobileNav = document.getElementById('mobileNav');

        hamburger.addEventListener('click', function() {
            hamburger.classList.toggle('active');
            mobileNav.classList.toggle('active');
            document.body.style.overflow = mobileNav.classList.contains('active') ? 'hidden' : '';
        });

        function closeMobileNav() {
            hamburger.classList.remove('active');
            mobileNav.classList.remove('active');
            document.body.style.overflow = '';
        }

        // Scroll to Top
        const scrollTopBtn = document.getElementById('scrollTop');
        window.addEventListener('scroll', function() {
            scrollTopBtn.classList.toggle('visible', window.scrollY > 500);
        });

        scrollTopBtn.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Smooth Scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    window.scrollTo({
                        top: target.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>

    @stack('scripts')
</body>

</html>