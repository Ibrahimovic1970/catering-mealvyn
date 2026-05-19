<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mealvyn — Premium Catering Online</title>
    <meta name="description" content="Mealvyn menyajikan catering premium dengan cita rasa terbaik untuk setiap momen spesial Anda.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* ============================================
           CSS VARIABLES & RESET
           ============================================ */
        :root {
            --primary: #1a5632;
            --primary-light: #2d7a4a;
            --primary-dark: #0e3a20;
            --secondary: #d4a853;
            --secondary-light: #e8c478;
            --secondary-dark: #b8903a;
            --cream: #f9f5ed;
            --cream-dark: #f0e8d8;
            --dark: #1a1a1a;
            --dark-light: #2d2d2d;
            --gray: #6b6b6b;
            --gray-light: #a0a0a0;
            --white: #ffffff;
            --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.06);
            --shadow-md: 0 8px 30px rgba(0, 0, 0, 0.08);
            --shadow-lg: 0 20px 60px rgba(0, 0, 0, 0.12);
            --shadow-xl: 0 30px 80px rgba(0, 0, 0, 0.15);
            --radius-sm: 8px;
            --radius-md: 16px;
            --radius-lg: 24px;
            --radius-xl: 32px;
            --transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            --transition-slow: all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        *,
        *::before,
        *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
            font-size: 16px;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            color: var(--dark);
            background-color: var(--white);
            line-height: 1.7;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Playfair Display', Georgia, serif;
            line-height: 1.2;
            font-weight: 600;
        }

        a {
            text-decoration: none;
            color: inherit;
            transition: var(--transition);
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

        /* ============================================
           PRELOADER
           ============================================ */
        .preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--primary-dark);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 99999;
            transition: opacity 0.6s ease, visibility 0.6s ease;
        }

        .preloader.hidden {
            opacity: 0;
            visibility: hidden;
        }

        .preloader-content {
            text-align: center;
        }

        .preloader-logo {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            color: var(--secondary);
            letter-spacing: 4px;
            animation: preloaderPulse 1.5s ease-in-out infinite;
        }

        .preloader-bar {
            width: 120px;
            height: 3px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 10px;
            margin: 20px auto 0;
            overflow: hidden;
        }

        .preloader-bar::after {
            content: '';
            display: block;
            width: 40%;
            height: 100%;
            background: var(--secondary);
            border-radius: 10px;
            animation: preloaderSlide 1.2s ease-in-out infinite;
        }

        @keyframes preloaderPulse {

            0%,
            100% {
                opacity: 0.6;
                transform: scale(1);
            }

            50% {
                opacity: 1;
                transform: scale(1.02);
            }
        }

        @keyframes preloaderSlide {
            0% {
                transform: translateX(-100%);
            }

            100% {
                transform: translateX(350%);
            }
        }

        /* ============================================
           CURSOR
           ============================================ */
        .custom-cursor {
            width: 20px;
            height: 20px;
            border: 2px solid var(--secondary);
            border-radius: 50%;
            position: fixed;
            pointer-events: none;
            z-index: 99998;
            transition: transform 0.15s ease, opacity 0.15s ease;
            mix-blend-mode: difference;
        }

        .custom-cursor.hover {
            transform: scale(2.5);
            background: rgba(212, 168, 83, 0.15);
        }

        /* ============================================
           NAVBAR
           ============================================ */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            padding: 20px 0;
            transition: var(--transition);
        }

        .navbar.scrolled {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            padding: 12px 0;
            box-shadow: var(--shadow-sm);
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
            transition: var(--transition);
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
            letter-spacing: 0.5px;
            transition: var(--transition);
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
            transition: var(--transition);
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
            letter-spacing: 0.5px;
            transition: var(--transition);
        }

        .nav-cta::after {
            display: none !important;
        }

        .nav-cta:hover {
            background: var(--secondary-light);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(212, 168, 83, 0.35);
        }

        .hamburger {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
            padding: 5px;
            z-index: 1001;
        }

        .hamburger span {
            width: 28px;
            height: 2.5px;
            background: var(--white);
            border-radius: 10px;
            transition: var(--transition);
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
            transition: right 0.5s cubic-bezier(0.77, 0, 0.175, 1);
            z-index: 999;
        }

        .mobile-nav.active {
            right: 0;
        }

        .mobile-nav a {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            color: var(--white);
            opacity: 0;
            transform: translateY(20px);
            transition: var(--transition);
        }

        .mobile-nav.active a {
            opacity: 1;
            transform: translateY(0);
        }

        .mobile-nav.active a:nth-child(1) {
            transition-delay: 0.1s;
        }

        .mobile-nav.active a:nth-child(2) {
            transition-delay: 0.2s;
        }

        .mobile-nav.active a:nth-child(3) {
            transition-delay: 0.3s;
        }

        .mobile-nav.active a:nth-child(4) {
            transition-delay: 0.4s;
        }

        .mobile-nav.active a:nth-child(5) {
            transition-delay: 0.5s;
        }

        /* ============================================
           HERO
           ============================================ */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 50%, var(--primary-light) 100%);
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 800px;
            height: 800px;
            background: radial-gradient(circle, rgba(212, 168, 83, 0.12) 0%, transparent 70%);
            border-radius: 50%;
            animation: heroFloat 8s ease-in-out infinite;
        }

        .hero::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -10%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.05) 0%, transparent 70%);
            border-radius: 50%;
            animation: heroFloat 10s ease-in-out infinite reverse;
        }

        @keyframes heroFloat {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }

            33% {
                transform: translate(30px, -30px) scale(1.05);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.95);
            }
        }

        .hero-content {
            position: relative;
            z-index: 2;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
        }

        .hero-text {
            animation: heroFadeIn 1s ease 0.5s both;
        }

        @keyframes heroFadeIn {
            from {
                opacity: 0;
                transform: translateY(40px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(212, 168, 83, 0.15);
            border: 1px solid rgba(212, 168, 83, 0.3);
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 0.8rem;
            color: var(--secondary);
            font-weight: 500;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 24px;
        }

        .hero-badge::before {
            content: '';
            width: 8px;
            height: 8px;
            background: var(--secondary);
            border-radius: 50%;
            animation: badgePulse 2s ease infinite;
        }

        @keyframes badgePulse {

            0%,
            100% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: 0.5;
                transform: scale(1.5);
            }
        }

        .hero h1 {
            font-size: 3.8rem;
            color: var(--white);
            margin-bottom: 20px;
            line-height: 1.1;
        }

        .hero h1 .highlight {
            color: var(--secondary);
            position: relative;
        }

        .hero h1 .highlight::after {
            content: '';
            position: absolute;
            bottom: 5px;
            left: 0;
            width: 100%;
            height: 8px;
            background: rgba(212, 168, 83, 0.2);
            border-radius: 4px;
        }

        .hero-desc {
            font-size: 1.1rem;
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 40px;
            max-width: 480px;
            line-height: 1.8;
        }

        .hero-buttons {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 16px 36px;
            border-radius: 50px;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            border: none;
            transition: var(--transition);
            font-family: 'Inter', sans-serif;
            letter-spacing: 0.3px;
        }

        .btn-primary {
            background: var(--secondary);
            color: var(--dark);
        }

        .btn-primary:hover {
            background: var(--secondary-light);
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(212, 168, 83, 0.35);
        }

        .btn-outline {
            background: transparent;
            color: var(--white);
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .btn-outline:hover {
            border-color: var(--white);
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-3px);
        }

        .hero-stats {
            display: flex;
            gap: 40px;
            margin-top: 50px;
            padding-top: 30px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .stat-item h3 {
            font-size: 2rem;
            color: var(--secondary);
            font-family: 'Inter', sans-serif;
            font-weight: 700;
        }

        .stat-item p {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.5);
            margin-top: 4px;
        }

        .hero-visual {
            position: relative;
            animation: heroFadeIn 1s ease 0.8s both;
        }

        .hero-image-wrapper {
            position: relative;
            width: 100%;
            aspect-ratio: 1;
            max-width: 520px;
            margin: 0 auto;
        }

        .hero-image-main {
            width: 85%;
            height: 85%;
            background: linear-gradient(145deg, var(--cream) 0%, var(--cream-dark) 100%);
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 8rem;
            animation: morphBlob 8s ease-in-out infinite;
            overflow: hidden;
        }

        @keyframes morphBlob {

            0%,
            100% {
                border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
            }

            25% {
                border-radius: 58% 42% 75% 25% / 76% 46% 54% 24%;
            }

            50% {
                border-radius: 50% 50% 33% 67% / 55% 27% 73% 45%;
            }

            75% {
                border-radius: 33% 67% 58% 42% / 63% 68% 32% 37%;
            }
        }

        .hero-float-card {
            position: absolute;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: var(--radius-md);
            padding: 16px 20px;
            box-shadow: var(--shadow-lg);
            animation: floatCard 4s ease-in-out infinite;
        }

        .hero-float-card.card-1 {
            top: 10%;
            right: -5%;
            animation-delay: 0s;
        }

        .hero-float-card.card-2 {
            bottom: 15%;
            left: -5%;
            animation-delay: 1.5s;
        }

        .hero-float-card .card-icon {
            font-size: 1.5rem;
            margin-bottom: 6px;
        }

        .hero-float-card .card-label {
            font-size: 0.7rem;
            color: var(--gray-light);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .hero-float-card .card-value {
            font-size: 1rem;
            font-weight: 700;
            color: var(--dark);
        }

        @keyframes floatCard {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-15px);
            }
        }

        .hero-dots {
            position: absolute;
            bottom: 40px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 12px;
            z-index: 3;
        }

        .hero-dots span {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            cursor: pointer;
            transition: var(--transition);
        }

        .hero-dots span.active {
            background: var(--secondary);
            transform: scale(1.2);
        }

        /* ============================================
           SECTION COMMON
           ============================================ */
        section {
            padding: 100px 0;
        }

        .section-header {
            text-align: center;
            max-width: 600px;
            margin: 0 auto 60px;
        }

        .section-tag {
            display: inline-block;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 3px;
            color: var(--secondary);
            margin-bottom: 12px;
            position: relative;
        }

        .section-tag::before,
        .section-tag::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 30px;
            height: 1px;
            background: var(--secondary);
        }

        .section-tag::before {
            right: calc(100% + 12px);
        }

        .section-tag::after {
            left: calc(100% + 12px);
        }

        .section-header h2 {
            font-size: 2.8rem;
            color: var(--dark);
            margin-bottom: 16px;
        }

        .section-header p {
            color: var(--gray);
            font-size: 1.05rem;
            line-height: 1.8;
        }

        /* ============================================
           ABOUT
           ============================================ */
        .about {
            background: var(--cream);
        }

        .about-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 80px;
            align-items: center;
        }

        .about-image {
            position: relative;
        }

        .about-img-main {
            width: 100%;
            aspect-ratio: 4/5;
            background: linear-gradient(145deg, var(--primary) 0%, var(--primary-light) 100%);
            border-radius: var(--radius-xl);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 6rem;
            position: relative;
            overflow: hidden;
        }

        .about-img-main::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, transparent 60%, rgba(0, 0, 0, 0.2));
        }

        .about-img-accent {
            position: absolute;
            bottom: -20px;
            right: -20px;
            width: 200px;
            height: 200px;
            background: var(--secondary);
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            color: var(--dark);
            z-index: 2;
        }

        .about-img-accent .accent-number {
            font-family: 'Playfair Display', serif;
            font-size: 3rem;
            font-weight: 700;
            line-height: 1;
        }

        .about-img-accent .accent-text {
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .about-content h2 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        .about-content h2 span {
            color: var(--primary);
        }

        .about-content>p {
            color: var(--gray);
            margin-bottom: 30px;
            line-height: 1.8;
        }

        .about-features {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }

        .about-feature {
            display: flex;
            align-items: flex-start;
            gap: 14px;
        }

        .about-feature-icon {
            width: 48px;
            height: 48px;
            min-width: 48px;
            background: var(--white);
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            box-shadow: var(--shadow-sm);
        }

        .about-feature h4 {
            font-family: 'Inter', sans-serif;
            font-size: 0.95rem;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .about-feature p {
            font-size: 0.82rem;
            color: var(--gray-light);
            line-height: 1.5;
        }

        /* ============================================
           SERVICES
           ============================================ */
        .services-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }

        .service-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            padding: 40px 30px;
            text-align: center;
            transition: var(--transition);
            border: 1px solid rgba(0, 0, 0, 0.04);
            position: relative;
            overflow: hidden;
        }

        .service-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            transform: scaleX(0);
            transform-origin: left;
            transition: var(--transition);
        }

        .service-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-xl);
        }

        .service-card:hover::before {
            transform: scaleX(1);
        }

        .service-icon {
            width: 80px;
            height: 80px;
            background: var(--cream);
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin: 0 auto 24px;
            transition: var(--transition);
        }

        .service-card:hover .service-icon {
            background: var(--primary);
            transform: rotateY(180deg);
        }

        .service-card h3 {
            font-size: 1.3rem;
            margin-bottom: 12px;
        }

        .service-card p {
            color: var(--gray);
            font-size: 0.92rem;
            line-height: 1.7;
        }

        /* ============================================
           MENU (UPDATED - EVENT BASED)
           ============================================ */
        .menu {
            background: var(--cream);
        }

        .menu-tabs {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 50px;
            flex-wrap: wrap;
        }

        .menu-tab {
            padding: 10px 24px;
            border-radius: 50px;
            font-size: 0.88rem;
            font-weight: 500;
            cursor: pointer;
            border: 2px solid transparent;
            background: var(--white);
            color: var(--gray);
            transition: var(--transition);
            font-family: 'Inter', sans-serif;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .menu-tab:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        .menu-tab.active {
            background: var(--primary);
            color: var(--white);
            border-color: var(--primary);
        }

        .tab-icon {
            font-size: 1rem;
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }

        .menu-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            overflow: hidden;
            transition: var(--transition);
            border: 1px solid rgba(0, 0, 0, 0.04);
            display: flex;
            flex-direction: column;
        }

        .menu-card.hidden-card {
            display: none;
        }

        .menu-card.show-card {
            display: flex;
            animation: fadeInUp 0.5s ease forwards;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .menu-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-lg);
        }

        .menu-card-img {
            width: 100%;
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
            position: relative;
            overflow: hidden;
        }

        .menu-card-img::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.05), transparent);
        }

        .menu-card-badge {
            position: absolute;
            top: 16px;
            left: 16px;
            background: var(--secondary);
            color: var(--dark);
            padding: 4px 14px;
            border-radius: 50px;
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            z-index: 2;
        }

        .menu-card-body {
            padding: 24px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .menu-card-category {
            display: inline-block;
            font-size: 0.72rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: var(--secondary-dark);
            background: rgba(212, 168, 83, 0.1);
            padding: 4px 12px;
            border-radius: 50px;
            margin-bottom: 10px;
            width: fit-content;
        }

        .menu-card-body h3 {
            font-size: 1.2rem;
            margin-bottom: 8px;
        }

        .menu-card-body>p {
            color: var(--gray);
            font-size: 0.88rem;
            margin-bottom: 16px;
            line-height: 1.6;
        }

        .menu-card-detail {
            margin-bottom: 16px;
            padding: 12px 16px;
            background: var(--cream);
            border-radius: var(--radius-sm);
        }

        .menu-detail-item {
            font-size: 0.82rem;
            color: var(--gray);
            padding: 4px 0;
            line-height: 1.4;
            border-bottom: 1px dashed rgba(0, 0, 0, 0.06);
        }

        .menu-detail-item:last-child {
            border-bottom: none;
        }

        .menu-card:hover .menu-card-detail {
            background: rgba(26, 86, 50, 0.05);
        }

        .menu-card-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: auto;
        }

        .menu-price {
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--primary);
        }

        .menu-price small {
            font-size: 0.75rem;
            color: var(--gray-light);
            font-family: 'Inter', sans-serif;
            font-weight: 400;
        }

        .menu-order-btn {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: var(--primary);
            color: var(--white);
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            transition: var(--transition);
            flex-shrink: 0;
        }

        .menu-order-btn:hover {
            background: var(--secondary);
            color: var(--dark);
            transform: rotate(90deg);
        }

        /* Category Colors */
        .menu-img-wedding {
            background: linear-gradient(145deg, #fff5f5 0%, #ffe0e0 100%) !important;
        }

        .menu-img-selamatan {
            background: linear-gradient(145deg, #f0fdf4 0%, #d1fae5 100%) !important;
        }

        .menu-img-birthday {
            background: linear-gradient(145deg, #fef3c7 0%, #fde68a 100%) !important;
        }

        .menu-img-study {
            background: linear-gradient(145deg, #ede9fe 0%, #ddd6fe 100%) !important;
        }

        .menu-img-rapat {
            background: linear-gradient(145deg, #eff6ff 0%, #dbeafe 100%) !important;
        }

        /* Order Popup */
        .order-popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(8px);
            z-index: 10000;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transition: var(--transition);
        }

        .order-popup-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .order-popup {
            background: var(--white);
            border-radius: var(--radius-xl);
            padding: 48px;
            max-width: 500px;
            width: 90%;
            text-align: center;
            transform: scale(0.8) translateY(30px);
            transition: var(--transition);
            box-shadow: var(--shadow-xl);
        }

        .order-popup-overlay.active .order-popup {
            transform: scale(1) translateY(0);
        }

        .order-popup-icon {
            font-size: 3rem;
            margin-bottom: 16px;
        }

        .order-popup h3 {
            font-size: 1.5rem;
            margin-bottom: 12px;
            color: var(--dark);
        }

        .order-popup p {
            color: var(--gray);
            font-size: 0.95rem;
            margin-bottom: 8px;
        }

        .order-popup .popup-package {
            font-weight: 700;
            color: var(--primary);
            font-size: 1.1rem;
        }

        .order-popup-buttons {
            display: flex;
            gap: 12px;
            margin-top: 24px;
            justify-content: center;
        }

        .popup-btn {
            padding: 12px 32px;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            border: none;
            font-family: 'Inter', sans-serif;
        }

        .popup-btn-primary {
            background: var(--primary);
            color: var(--white);
        }

        .popup-btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }

        .popup-btn-secondary {
            background: var(--cream);
            color: var(--dark);
        }

        .popup-btn-secondary:hover {
            background: var(--cream-dark);
        }

        /* ============================================
           STEPS
           ============================================ */
        .steps-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
            position: relative;
        }

        .steps-grid::before {
            content: '';
            position: absolute;
            top: 50px;
            left: 12%;
            right: 12%;
            height: 2px;
            background: linear-gradient(90deg, var(--primary), var(--secondary), var(--primary));
            z-index: 0;
        }

        .step-card {
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .step-number {
            width: 100px;
            height: 100px;
            background: var(--white);
            border: 3px solid var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            transition: var(--transition);
        }

        .step-number span {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary);
        }

        .step-card:hover .step-number {
            background: var(--primary);
            transform: scale(1.1);
        }

        .step-card:hover .step-number span {
            color: var(--white);
        }

        .step-card h3 {
            font-size: 1.15rem;
            margin-bottom: 10px;
        }

        .step-card p {
            color: var(--gray);
            font-size: 0.88rem;
            line-height: 1.6;
        }

        /* ============================================
           TESTIMONIALS
           ============================================ */
        .testimonials {
            background: var(--primary-dark);
            position: relative;
            overflow: hidden;
        }

        .testimonials::before {
            content: '';
            position: absolute;
            top: -200px;
            right: -200px;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(212, 168, 83, 0.08) 0%, transparent 70%);
            border-radius: 50%;
        }

        .testimonials .section-header h2 {
            color: var(--white);
        }

        .testimonials .section-header p {
            color: rgba(255, 255, 255, 0.5);
        }

        .testimonials-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }

        .testimonial-card {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: var(--radius-lg);
            padding: 36px;
            transition: var(--transition);
            backdrop-filter: blur(10px);
        }

        .testimonial-card:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-5px);
        }

        .testimonial-stars {
            display: flex;
            gap: 4px;
            margin-bottom: 20px;
            color: var(--secondary);
            font-size: 0.9rem;
        }

        .testimonial-text {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.95rem;
            line-height: 1.8;
            margin-bottom: 24px;
            font-style: italic;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .testimonial-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--white);
        }

        .testimonial-author h4 {
            font-family: 'Inter', sans-serif;
            font-size: 0.95rem;
            color: var(--white);
            font-weight: 600;
        }

        .testimonial-author p {
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.4);
        }

        /* ============================================
           PRICING
           ============================================ */
        .pricing-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            align-items: start;
        }

        .pricing-card {
            background: var(--white);
            border-radius: var(--radius-xl);
            padding: 40px;
            border: 2px solid rgba(0, 0, 0, 0.06);
            transition: var(--transition);
            position: relative;
        }

        .pricing-card.featured {
            border-color: var(--primary);
            transform: scale(1.05);
        }

        .pricing-card.featured::before {
            content: 'Populer';
            position: absolute;
            top: -14px;
            left: 50%;
            transform: translateX(-50%);
            background: var(--primary);
            color: var(--white);
            padding: 6px 24px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .pricing-card:hover {
            box-shadow: var(--shadow-xl);
        }

        .pricing-name {
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: var(--gray-light);
            margin-bottom: 8px;
        }

        .pricing-price {
            font-family: 'Playfair Display', serif;
            font-size: 3rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 4px;
        }

        .pricing-price small {
            font-size: 1rem;
            color: var(--gray-light);
            font-family: 'Inter', sans-serif;
            font-weight: 400;
        }

        .pricing-desc {
            color: var(--gray);
            font-size: 0.88rem;
            margin-bottom: 30px;
            padding-bottom: 30px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.06);
        }

        .pricing-features {
            margin-bottom: 30px;
        }

        .pricing-features li {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 0;
            font-size: 0.9rem;
            color: var(--gray);
        }

        .pricing-features li .check {
            color: var(--primary);
            font-weight: 700;
        }

        .pricing-btn {
            display: block;
            width: 100%;
            padding: 16px;
            border-radius: 50px;
            text-align: center;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            transition: var(--transition);
            border: 2px solid var(--primary);
            background: transparent;
            color: var(--primary);
            font-family: 'Inter', sans-serif;
        }

        .pricing-btn:hover {
            background: var(--primary);
            color: var(--white);
        }

        .pricing-card.featured .pricing-btn {
            background: var(--primary);
            color: var(--white);
        }

        .pricing-card.featured .pricing-btn:hover {
            background: var(--primary-dark);
        }

        /* ============================================
           CTA
           ============================================ */
        .cta {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .cta::before,
        .cta::after {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: rgba(212, 168, 83, 0.06);
        }

        .cta::before {
            top: -200px;
            left: -100px;
        }

        .cta::after {
            bottom: -200px;
            right: -100px;
        }

        .cta h2 {
            font-size: 3rem;
            color: var(--white);
            margin-bottom: 16px;
            position: relative;
            z-index: 1;
        }

        .cta p {
            color: rgba(255, 255, 255, 0.7);
            font-size: 1.1rem;
            margin-bottom: 40px;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
            position: relative;
            z-index: 1;
        }

        .cta .btn-primary {
            position: relative;
            z-index: 1;
        }

        /* ============================================
           CONTACT
           ============================================ */
        .contact {
            background: var(--cream);
        }

        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
        }

        .contact-info h3 {
            font-size: 1.8rem;
            margin-bottom: 16px;
        }

        .contact-info>p {
            color: var(--gray);
            margin-bottom: 30px;
            line-height: 1.8;
        }

        .contact-details {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .contact-detail {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .contact-detail-icon {
            width: 52px;
            height: 52px;
            min-width: 52px;
            background: var(--white);
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            box-shadow: var(--shadow-sm);
        }

        .contact-detail h4 {
            font-family: 'Inter', sans-serif;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 2px;
        }

        .contact-detail p {
            font-size: 0.85rem;
            color: var(--gray);
        }

        .contact-form {
            background: var(--white);
            border-radius: var(--radius-xl);
            padding: 40px;
            box-shadow: var(--shadow-md);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--dark);
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 14px 18px;
            border: 2px solid rgba(0, 0, 0, 0.08);
            border-radius: var(--radius-sm);
            font-size: 0.95rem;
            font-family: 'Inter', sans-serif;
            transition: var(--transition);
            background: var(--cream);
            color: var(--dark);
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--primary);
            background: var(--white);
            box-shadow: 0 0 0 4px rgba(26, 86, 50, 0.08);
        }

        .form-group textarea {
            height: 130px;
            resize: vertical;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .form-submit {
            width: 100%;
            padding: 16px;
            background: var(--primary);
            color: var(--white);
            border: none;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            font-family: 'Inter', sans-serif;
            letter-spacing: 0.5px;
        }

        .form-submit:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(26, 86, 50, 0.3);
        }

        .success-message {
            background: var(--primary);
            color: var(--white);
            padding: 16px 24px;
            border-radius: var(--radius-sm);
            margin-bottom: 20px;
            font-size: 0.9rem;
            animation: slideDown 0.5s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ============================================
           FOOTER
           ============================================ */
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
            transition: var(--transition);
            font-size: 0.9rem;
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
            transition: var(--transition);
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
            font-family: 'Inter', sans-serif;
            transition: var(--transition);
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
            font-size: 0.85rem;
            cursor: pointer;
            transition: var(--transition);
            font-family: 'Inter', sans-serif;
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

        .footer-bottom a {
            color: var(--secondary);
        }

        /* ============================================
           SCROLL TO TOP
           ============================================ */
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
            transform: translateY(20px);
            transition: var(--transition);
            box-shadow: 0 8px 25px rgba(26, 86, 50, 0.3);
        }

        .scroll-top.visible {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .scroll-top:hover {
            background: var(--secondary);
            color: var(--dark);
            transform: translateY(-4px);
        }

        /* ============================================
           SCROLL ANIMATIONS
           ============================================ */
        .reveal {
            opacity: 0;
            transform: translateY(40px);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        .reveal-left {
            opacity: 0;
            transform: translateX(-60px);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }

        .reveal-left.active {
            opacity: 1;
            transform: translateX(0);
        }

        .reveal-right {
            opacity: 0;
            transform: translateX(60px);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }

        .reveal-right.active {
            opacity: 1;
            transform: translateX(0);
        }

        .reveal-scale {
            opacity: 0;
            transform: scale(0.8);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }

        .reveal-scale.active {
            opacity: 1;
            transform: scale(1);
        }

        .delay-1 {
            transition-delay: 0.1s;
        }

        .delay-2 {
            transition-delay: 0.2s;
        }

        .delay-3 {
            transition-delay: 0.3s;
        }

        .delay-4 {
            transition-delay: 0.4s;
        }

        .delay-5 {
            transition-delay: 0.5s;
        }

        /* ============================================
           RESPONSIVE
           ============================================ */
        @media (max-width: 1024px) {
            .hero h1 {
                font-size: 3rem;
            }

            .hero-content {
                gap: 40px;
            }

            .services-grid,
            .menu-grid,
            .testimonials-grid,
            .pricing-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .steps-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .steps-grid::before {
                display: none;
            }

            .footer-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .pricing-card.featured {
                transform: scale(1);
            }
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .hamburger {
                display: flex;
            }

            .hero-content {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .hero h1 {
                font-size: 2.5rem;
            }

            .hero-desc {
                margin: 0 auto 40px;
            }

            .hero-buttons {
                justify-content: center;
            }

            .hero-stats {
                justify-content: center;
            }

            .hero-visual {
                order: -1;
            }

            .hero-image-wrapper {
                max-width: 350px;
            }

            .about-grid {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .services-grid,
            .menu-grid,
            .testimonials-grid,
            .pricing-grid {
                grid-template-columns: 1fr;
            }

            .steps-grid {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .contact-grid {
                grid-template-columns: 1fr;
            }

            .footer-grid {
                grid-template-columns: 1fr;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .section-header h2 {
                font-size: 2rem;
            }

            .cta h2 {
                font-size: 2rem;
            }

            .custom-cursor {
                display: none;
            }
        }

        @media (max-width: 480px) {
            .hero h1 {
                font-size: 2rem;
            }

            .hero-stats {
                flex-direction: column;
                gap: 16px;
                align-items: center;
            }

            .about-features {
                grid-template-columns: 1fr;
            }

            .newsletter-form {
                flex-direction: column;
            }

            .footer-bottom {
                flex-direction: column;
                gap: 8px;
                text-align: center;
            }
        }
    </style>
</head>

<body>

    <!-- Preloader -->
    <div class="preloader" id="preloader">
        <div class="preloader-content">
            <div class="preloader-logo">MEALVYN</div>
            <div class="preloader-bar"></div>
        </div>
    </div>

    <!-- Custom Cursor -->
    <div class="custom-cursor" id="cursor"></div>

    <!-- Navbar -->
    <nav class="navbar" id="navbar">
        <div class="container">
            <a href="{{ route('home') }}" class="nav-logo">Meal<span>vyn</span></a>
            <div class="nav-links">
                <a href="{{ route('home') }}" class="active">Beranda</a>
                <a href="#about">Tentang</a>
                <a href="#services">Layanan</a>
                <a href="#menu">Menu</a>
                <a href="#pricing">Harga</a>
                <a href="#contact" class="nav-cta">Pesan Sekarang</a>
            </div>
            <div class="hamburger" id="hamburger">
                <span></span><span></span><span></span>
            </div>
        </div>
    </nav>

    <!-- Mobile Nav -->
    <div class="mobile-nav" id="mobileNav">
        <a href="{{ route('home') }}" onclick="closeMobileNav()">Beranda</a>
        <a href="#about" onclick="closeMobileNav()">Tentang</a>
        <a href="#services" onclick="closeMobileNav()">Layanan</a>
        <a href="#menu" onclick="closeMobileNav()">Menu</a>
        <a href="#contact" onclick="closeMobileNav()">Kontak</a>
    </div>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <div class="hero-badge">✨ Premium Catering</div>
                    <h1>Rasa <span class="highlight">Sempurna</span> untuk Setiap Momen</h1>
                    <p class="hero-desc">Mealvyn menghadirkan pengalaman kuliner premium dengan bahan-bahan segar pilihan, dimasak oleh chef berpengalaman untuk acara spesial Anda.</p>
                    <div class="hero-buttons">
                        <a href="#menu" class="btn btn-primary">Lihat Menu <span>→</span></a>
                        <a href="#about" class="btn btn-outline">Pelajari Lebih</a>
                    </div>
                    <div class="hero-stats">
                        <div class="stat-item">
                            <h3><span class="counter" data-target="5000">0</span>+</h3>
                            <p>Pelanggan Puas</p>
                        </div>
                        <div class="stat-item">
                            <h3><span class="counter" data-target="120">0</span>+</h3>
                            <p>Menu Pilihan</p>
                        </div>
                        <div class="stat-item">
                            <h3><span class="counter" data-target="8">0</span></h3>
                            <p>Tahun Pengalaman</p>
                        </div>
                    </div>
                </div>
                <div class="hero-visual">
                    <div class="hero-image-wrapper">
                        <div class="hero-image-main">🍽️</div>
                        <div class="hero-float-card card-1">
                            <div class="card-icon">⭐</div>
                            <div class="card-label">Rating</div>
                            <div class="card-value">4.9 / 5.0</div>
                        </div>
                        <div class="hero-float-card card-2">
                            <div class="card-icon">🚚</div>
                            <div class="card-label">Pengiriman</div>
                            <div class="card-value">Gratis</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hero-dots">
            <span class="active"></span><span></span><span></span>
        </div>
    </section>

    <!-- About Section -->
    <section class="about" id="about">
        <div class="container">
            <div class="about-grid">
                <div class="about-image reveal-left">
                    <div class="about-img-main">‍🍳</div>
                    <div class="about-img-accent">
                        <div class="accent-number">8+</div>
                        <div class="accent-text">Tahun</div>
                    </div>
                </div>
                <div class="about-content reveal-right">
                    <div class="section-tag">Tentang Kami</div>
                    <h2>Cita Rasa <span>Autentik</span> dengan Sentuhan Modern</h2>
                    <p>Mealvyn lahir dari passion mendalam terhadap kuliner Indonesia. Kami menggabungkan resep tradisional dengan teknik modern untuk menghasilkan hidangan yang tak hanya lezat, tapi juga memukau secara visual.</p>
                    <div class="about-features">
                        <div class="about-feature">
                            <div class="about-feature-icon">🌿</div>
                            <div>
                                <h4>Bahan Segar</h4>
                                <p>100% bahan pilihan dari supplier terpercaya</p>
                            </div>
                        </div>
                        <div class="about-feature">
                            <div class="about-feature-icon">👨‍</div>
                            <div>
                                <h4>Chef Profesional</h4>
                                <p>Tim chef berpengalaman 10+ tahun</p>
                            </div>
                        </div>
                        <div class="about-feature">
                            <div class="about-feature-icon">🕐</div>
                            <div>
                                <h4>Tepat Waktu</h4>
                                <p>Garansi pengiriman sesuai jadwal</p>
                            </div>
                        </div>
                        <div class="about-feature">
                            <div class="about-feature-icon">💎</div>
                            <div>
                                <h4>Premium Quality</h4>
                                <p>Standar kualitas restoran bintang 5</p>
                            </div>
                        </div>
                    </div>
                    <a href="#contact" class="btn btn-primary">Hubungi Kami →</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services" id="services">
        <div class="container">
            <div class="section-header reveal">
                <div class="section-tag">Layanan Kami</div>
                <h2>Solusi Catering untuk Segala Acara</h2>
                <p>Dari acara intimate hingga grand celebration, Mealvyn siap menjadi partner kuliner terpercaya Anda.</p>
            </div>
            <div class="services-grid">
                <div class="service-card reveal delay-1">
                    <div class="service-icon">🎉</div>
                    <h3>Catering Event</h3>
                    <p>Layanan catering lengkap untuk pernikahan, ulang tahun, gathering perusahaan, dan berbagai acara spesial lainnya.</p>
                </div>
                <div class="service-card reveal delay-2">
                    <div class="service-icon">📦</div>
                    <h3>Meal Box</h3>
                    <p>Paket meal box praktis dan bergizi untuk kebutuhan harian kantor, acara seminar, atau aktivitas outdoor.</p>
                </div>
                <div class="service-card reveal delay-3">
                    <div class="service-icon">🍱</div>
                    <h3>Nasi Box Premium</h3>
                    <p>Nasi box dengan presentasi premium, cocok untuk meeting bisnis, workshop, dan acara formal.</p>
                </div>
                <div class="service-card reveal delay-1">
                    <div class="service-icon">🎂</div>
                    <h3>Dessert & Pastry</h3>
                    <p>Koleksi dessert dan pastry artisan yang sempurna untuk melengkapi setiap momen manis Anda.</p>
                </div>
                <div class="service-card reveal delay-2">
                    <div class="service-icon">☕</div>
                    <h3>Coffee Break</h3>
                    <p>Paket coffee break lengkap dengan snack premium untuk menemani sesi meeting dan diskusi Anda.</p>
                </div>
                <div class="service-card reveal delay-3">
                    <div class="service-icon">🥗</div>
                    <h3>Diet & Healthy</h3>
                    <p>Menu sehat dan diet yang dirancang oleh nutrisionis profesional, tanpa mengorbankan cita rasa.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Menu Section (UPDATED - EVENT BASED) -->
    <section class="menu" id="menu">
        <div class="container">
            <div class="section-header reveal">
                <div class="section-tag">Paket Menu</div>
                <h2>Menu Berdasarkan Acara</h2>
                <p>Pilih kategori acara Anda dan temukan paket menu terbaik yang sudah kami rancang khusus.</p>
            </div>

            <div class="menu-tabs reveal">
                <button class="menu-tab active" data-filter="all"><span class="tab-icon">🎯</span> Semua Paket</button>
                <button class="menu-tab" data-filter="pernikahan"><span class="tab-icon">💒</span> Pernikahan</button>
                <button class="menu-tab" data-filter="selamatan"><span class="tab-icon">🤲</span> Selamatan</button>
                <button class="menu-tab" data-filter="ulangtahun"><span class="tab-icon">🎂</span> Ulang Tahun</button>
                <button class="menu-tab" data-filter="studytour"><span class="tab-icon"></span> Study Tour</button>
                <button class="menu-tab" data-filter="rapat"><span class="tab-icon"></span> Rapat</button>
            </div>

            <div class="menu-grid" id="menuGrid">
                <!-- PERNIKAHAN -->
                <div class="menu-card reveal delay-1" data-category="pernikahan">
                    <div class="menu-card-img menu-img-wedding"><span class="menu-card-badge">Best Seller</span>💍</div>
                    <div class="menu-card-body">
                        <div class="menu-card-category">Paket Pernikahan</div>
                        <h3>Paket Sakinah Mawaddah</h3>
                        <p>Paket lengkap untuk resepsi pernikahan impian Anda dengan menu pilihan premium.</p>
                        <div class="menu-card-detail">
                            <div class="menu-detail-item">🍚 Nasi Mandhi / Nasi Kuning</div>
                            <div class="menu-detail-item"> Rendang Daging Sapi</div>
                            <div class="menu-detail-item">🍗 Ayam Bakar Taliwang</div>
                            <div class="menu-detail-item">🥘 Gulai Kambing</div>
                            <div class="menu-detail-item">🥗 Salad Segar & Gado-gado</div>
                            <div class="menu-detail-item">🍮 Es Buah / Puding</div>
                            <div class="menu-detail-item"> Buah Potong</div>
                        </div>
                        <div class="menu-card-footer">
                            <div class="menu-price">Rp 85K <small>/pax</small></div>
                            <button class="menu-order-btn" onclick="orderMenu('Paket Sakinah Mawaddah')">+</button>
                        </div>
                    </div>
                </div>
                <div class="menu-card reveal delay-2" data-category="pernikahan">
                    <div class="menu-card-img menu-img-wedding"><span class="menu-card-badge">Premium</span>👑</div>
                    <div class="menu-card-body">
                        <div class="menu-card-category">Paket Pernikahan</div>
                        <h3>Paket Mahar Agung</h3>
                        <p>Paket eksklusif dengan menu buffet lengkap dan live cooking station.</p>
                        <div class="menu-card-detail">
                            <div class="menu-detail-item">🍚 Nasi Mandhi / Biryani</div>
                            <div class="menu-detail-item">🥩 Wagyu Rendang</div>
                            <div class="menu-detail-item">🐟 Ikan Bakar Jimbaran</div>
                            <div class="menu-detail-item"> Udang Saus Padang</div>
                            <div class="menu-detail-item">🥗 Prune Salad & Sop Buntut</div>
                            <div class="menu-detail-item">🍰 Dessert Bar (3 pilihan)</div>
                            <div class="menu-detail-item">🍹 Welcome Drink</div>
                            <div class="menu-detail-item"> Fresh Fruit Platter</div>
                        </div>
                        <div class="menu-card-footer">
                            <div class="menu-price">Rp 150K <small>/pax</small></div>
                            <button class="menu-order-btn" onclick="orderMenu('Paket Mahar Agung')">+</button>
                        </div>
                    </div>
                </div>
                <div class="menu-card reveal delay-3" data-category="pernikahan">
                    <div class="menu-card-img menu-img-wedding">✨</div>
                    <div class="menu-card-body">
                        <div class="menu-card-category">Paket Pernikahan</div>
                        <h3>Paket Akad Nikah</h3>
                        <p>Paket sederhana namun elegan khusus untuk acara akad nikah.</p>
                        <div class="menu-card-detail">
                            <div class="menu-detail-item">🍚 Nasi Kuning Tumpeng</div>
                            <div class="menu-detail-item"> Ayam Goreng Kremes</div>
                            <div class="menu-detail-item">🥚 Telur Balado</div>
                            <div class="menu-detail-item">🥬 Lalapan & Sambal</div>
                            <div class="menu-detail-item">🍮 Kolak Pisang / Puding</div>
                            <div class="menu-detail-item"> Teh / Air Mineral</div>
                        </div>
                        <div class="menu-card-footer">
                            <div class="menu-price">Rp 55K <small>/pax</small></div>
                            <button class="menu-order-btn" onclick="orderMenu('Paket Akad Nikah')">+</button>
                        </div>
                    </div>
                </div>

                <!-- SELAMATAN -->
                <div class="menu-card reveal delay-1" data-category="selamatan">
                    <div class="menu-card-img menu-img-selamatan"><span class="menu-card-badge">Populer</span>🤲</div>
                    <div class="menu-card-body">
                        <div class="menu-card-category">Paket Selamatan</div>
                        <h3>Paket Syukuran</h3>
                        <p>Paket lengkap untuk acara selamatan, tasyakuran, dan doa bersama.</p>
                        <div class="menu-card-detail">
                            <div class="menu-detail-item">🍚 Nasi Putih / Nasi Kuning</div>
                            <div class="menu-detail-item">🍗 Ayam Bakar / Goreng</div>
                            <div class="menu-detail-item"> Perkedel / Bakwan</div>
                            <div class="menu-detail-item"> Acar & Kerupuk</div>
                            <div class="menu-detail-item">🍌 Pisang / Buah</div>
                            <div class="menu-detail-item">🍮 Puding / Kue Basah</div>
                            <div class="menu-detail-item">🍵 Teh Manis / Air Mineral</div>
                        </div>
                        <div class="menu-card-footer">
                            <div class="menu-price">Rp 35K <small>/pax</small></div>
                            <button class="menu-order-btn" onclick="orderMenu('Paket Syukuran')">+</button>
                        </div>
                    </div>
                </div>
                <div class="menu-card reveal delay-2" data-category="selamatan">
                    <div class="menu-card-img menu-img-selamatan">🕌</div>
                    <div class="menu-card-body">
                        <div class="menu-card-category">Paket Selamatan</div>
                        <h3>Paket Hajatan</h3>
                        <p>Paket lengkap untuk acara hajatan, khitanan, atau syukuran besar.</p>
                        <div class="menu-card-detail">
                            <div class="menu-detail-item">🍚 Nasi Kebuli / Mandhi</div>
                            <div class="menu-detail-item">🥩 Rendang / Gulai</div>
                            <div class="menu-detail-item">🍗 Ayam Bakar Spesial</div>
                            <div class="menu-detail-item">🥘 Sayur Asem / Sop</div>
                            <div class="menu-detail-item">🥗 Gado-gado / Karedok</div>
                            <div class="menu-detail-item">🍧 Es Buah / Kolak</div>
                            <div class="menu-detail-item">🍉 Buah-buahan</div>
                            <div class="menu-detail-item"> Teh / Jus / Air Mineral</div>
                        </div>
                        <div class="menu-card-footer">
                            <div class="menu-price">Rp 65K <small>/pax</small></div>
                            <button class="menu-order-btn" onclick="orderMenu('Paket Hajatan')">+</button>
                        </div>
                    </div>
                </div>
                <div class="menu-card reveal delay-3" data-category="selamatan">
                    <div class="menu-card-img menu-img-selamatan"><span class="menu-card-badge">Hemat</span>📦</div>
                    <div class="menu-card-body">
                        <div class="menu-card-category">Paket Selamatan</div>
                        <h3>Paket Nasi Box Doa</h3>
                        <p>Nasi box praktis untuk selamatan sederhana dan doa bersama.</p>
                        <div class="menu-card-detail">
                            <div class="menu-detail-item">🍚 Nasi Putih</div>
                            <div class="menu-detail-item">🍗 Ayam Goreng</div>
                            <div class="menu-detail-item">🥚 Telur Balado</div>
                            <div class="menu-detail-item">🥒 Acar</div>
                            <div class="menu-detail-item">🍌 Pisang</div>
                            <div class="menu-detail-item">🍵 Air Mineral</div>
                        </div>
                        <div class="menu-card-footer">
                            <div class="menu-price">Rp 25K <small>/box</small></div>
                            <button class="menu-order-btn" onclick="orderMenu('Paket Nasi Box Doa')">+</button>
                        </div>
                    </div>
                </div>

                <!-- ULANG TAHUN -->
                <div class="menu-card reveal delay-1" data-category="ulangtahun">
                    <div class="menu-card-img menu-img-birthday"><span class="menu-card-badge">Fun Party</span></div>
                    <div class="menu-card-body">
                        <div class="menu-card-category">Paket Ulang Tahun</div>
                        <h3>Paket Birthday Kids</h3>
                        <p>Paket seru untuk pesta ulang tahun anak-anak dengan menu favorit mereka.</p>
                        <div class="menu-card-detail">
                            <div class="menu-detail-item">🍔 Mini Burger / Hotdog</div>
                            <div class="menu-detail-item">🍕 Pizza Slice</div>
                            <div class="menu-detail-item">🍟 French Fries</div>
                            <div class="menu-detail-item">🍗 Chicken Nugget</div>
                            <div class="menu-detail-item">🧃 Juice Box</div>
                            <div class="menu-detail-item">🎂 Birthday Cake (custom)</div>
                            <div class="menu-detail-item"> Candy Bar</div>
                        </div>
                        <div class="menu-card-footer">
                            <div class="menu-price">Rp 75K <small>/pax</small></div>
                            <button class="menu-order-btn" onclick="orderMenu('Paket Birthday Kids')">+</button>
                        </div>
                    </div>
                </div>
                <div class="menu-card reveal delay-2" data-category="ulangtahun">
                    <div class="menu-card-img menu-img-birthday"><span class="menu-card-badge">Elegant</span>🥂</div>
                    <div class="menu-card-body">
                        <div class="menu-card-category">Paket Ulang Tahun</div>
                        <h3>Paket Sweet Seventeen</h3>
                        <p>Paket elegan untuk ulang tahun remaja dengan menu kekinian dan aesthetic.</p>
                        <div class="menu-card-detail">
                            <div class="menu-detail-item">🍝 Pasta / Spaghetti</div>
                            <div class="menu-detail-item"> Chicken Steak</div>
                            <div class="menu-detail-item">🥗 Caesar Salad</div>
                            <div class="menu-detail-item">🍟 Loaded Fries</div>
                            <div class="menu-detail-item">🧋 Bubble Tea / Smoothie</div>
                            <div class="menu-detail-item">🍰 Mini Cupcakes (6 pcs)</div>
                            <div class="menu-detail-item">🎂 Custom Cake</div>
                        </div>
                        <div class="menu-card-footer">
                            <div class="menu-price">Rp 95K <small>/pax</small></div>
                            <button class="menu-order-btn" onclick="orderMenu('Paket Sweet Seventeen')">+</button>
                        </div>
                    </div>
                </div>
                <div class="menu-card reveal delay-3" data-category="ulangtahun">
                    <div class="menu-card-img menu-img-birthday">🎉</div>
                    <div class="menu-card-body">
                        <div class="menu-card-category">Paket Ulang Tahun</div>
                        <h3>Paket Ulang Tahun Dewasa</h3>
                        <p>Paket santai dan nikmat untuk perayaan ulang tahun orang dewasa.</p>
                        <div class="menu-card-detail">
                            <div class="menu-detail-item">🍚 Nasi Goreng Spesial</div>
                            <div class="menu-detail-item">🍖 Sate Ayam / Kambing</div>
                            <div class="menu-detail-item">🥘 Tongseng / Sup Kambing</div>
                            <div class="menu-detail-item">🥗 Gado-gado</div>
                            <div class="menu-detail-item"> Es Campur / Es Teler</div>
                            <div class="menu-detail-item">🍰 Slice Cake</div>
                        </div>
                        <div class="menu-card-footer">
                            <div class="menu-price">Rp 65K <small>/pax</small></div>
                            <button class="menu-order-btn" onclick="orderMenu('Paket Ulang Tahun Dewasa')">+</button>
                        </div>
                    </div>
                </div>

                <!-- STUDY TOUR -->
                <div class="menu-card reveal delay-1" data-category="studytour">
                    <div class="menu-card-img menu-img-study"><span class="menu-card-badge">Praktis</span>🎒</div>
                    <div class="menu-card-body">
                        <div class="menu-card-category">Paket Study Tour</div>
                        <h3>Paket Snack Box Siswa</h3>
                        <p>Snack box praktis dan bergizi untuk anak-anak selama perjalanan study tour.</p>
                        <div class="menu-card-detail">
                            <div class="menu-detail-item">🍞 Roti Bakar / Sandwich</div>
                            <div class="menu-detail-item"> Juice Box</div>
                            <div class="menu-detail-item">🍪 Cookies / Biskuit</div>
                            <div class="menu-detail-item">🍇 Buah Potong</div>
                            <div class="menu-detail-item">💧 Air Mineral</div>
                        </div>
                        <div class="menu-card-footer">
                            <div class="menu-price">Rp 18K <small>/box</small></div>
                            <button class="menu-order-btn" onclick="orderMenu('Paket Snack Box Siswa')">+</button>
                        </div>
                    </div>
                </div>
                <div class="menu-card reveal delay-2" data-category="studytour">
                    <div class="menu-card-img menu-img-study"><span class="menu-card-badge">Lengkap</span>🍱</div>
                    <div class="menu-card-body">
                        <div class="menu-card-category">Paket Study Tour</div>
                        <h3>Paket Lunch Box Siswa</h3>
                        <p>Nasi box lengkap dan bergizi untuk makan siang selama study tour.</p>
                        <div class="menu-card-detail">
                            <div class="menu-detail-item"> Nasi Putih</div>
                            <div class="menu-detail-item">🍗 Ayam Goreng / Bakar</div>
                            <div class="menu-detail-item">🥚 Telur Dadar / Ceplok</div>
                            <div class="menu-detail-item">🥒 Acar Timun</div>
                            <div class="menu-detail-item">🍌 Pisang / Buah</div>
                            <div class="menu-detail-item">🧃 Juice</div>
                            <div class="menu-detail-item">💧 Air Mineral</div>
                        </div>
                        <div class="menu-card-footer">
                            <div class="menu-price">Rp 28K <small>/box</small></div>
                            <button class="menu-order-btn" onclick="orderMenu('Paket Lunch Box Siswa')">+</button>
                        </div>
                    </div>
                </div>
                <div class="menu-card reveal delay-3" data-category="studytour">
                    <div class="menu-card-img menu-img-study"></div>
                    <div class="menu-card-body">
                        <div class="menu-card-category">Paket Study Tour</div>
                        <h3>Paket Bento Box Premium</h3>
                        <p>Bento box premium dengan menu sehat dan menarik untuk siswa.</p>
                        <div class="menu-card-detail">
                            <div class="menu-detail-item">🍚 Nasi Onigiri</div>
                            <div class="menu-detail-item">🍗 Chicken Katsu</div>
                            <div class="menu-detail-item">🥕 Vegetable Roll</div>
                            <div class="menu-detail-item">🍳 Tamagoyaki</div>
                            <div class="menu-detail-item"> Fruit Cup</div>
                            <div class="menu-detail-item">🥛 Yakult / Juice</div>
                        </div>
                        <div class="menu-card-footer">
                            <div class="menu-price">Rp 38K <small>/box</small></div>
                            <button class="menu-order-btn" onclick="orderMenu('Paket Bento Box Premium')">+</button>
                        </div>
                    </div>
                </div>

                <!-- RAPAT -->
                <div class="menu-card reveal delay-1" data-category="rapat">
                    <div class="menu-card-img menu-img-rapat"><span class="menu-card-badge">Meeting</span></div>
                    <div class="menu-card-body">
                        <div class="menu-card-category">Paket Rapat</div>
                        <h3>Paket Coffee Break</h3>
                        <p>Paket coffee break lengkap untuk menemani sesi meeting dan diskusi.</p>
                        <div class="menu-card-detail">
                            <div class="menu-detail-item">☕ Kopi / Teh / Susu</div>
                            <div class="menu-detail-item">🥐 Croissant / Danish</div>
                            <div class="menu-detail-item">🍰 Mini Cake (2 pcs)</div>
                            <div class="menu-detail-item"> Cookies / Biskuit</div>
                            <div class="menu-detail-item">🍎 Fruit Platter</div>
                            <div class="menu-detail-item">💧 Air Mineral</div>
                        </div>
                        <div class="menu-card-footer">
                            <div class="menu-price">Rp 45K <small>/pax</small></div>
                            <button class="menu-order-btn" onclick="orderMenu('Paket Coffee Break')">+</button>
                        </div>
                    </div>
                </div>
                <div class="menu-card reveal delay-2" data-category="rapat">
                    <div class="menu-card-img menu-img-rapat"><span class="menu-card-badge">Seminar</span>📋</div>
                    <div class="menu-card-body">
                        <div class="menu-card-category">Paket Rapat</div>
                        <h3>Paket Seminar Box</h3>
                        <p>Nasi box profesional untuk seminar, workshop, dan training karyawan.</p>
                        <div class="menu-card-detail">
                            <div class="menu-detail-item">🍚 Nasi Putih / Nasi Goreng</div>
                            <div class="menu-detail-item">🍗 Ayam / Beef Steak</div>
                            <div class="menu-detail-item">🥗 Salad / Vegetable</div>
                            <div class="menu-detail-item">🍎 Buah Segar</div>
                            <div class="menu-detail-item"> Juice / Teh</div>
                            <div class="menu-detail-item">💧 Air Mineral</div>
                        </div>
                        <div class="menu-card-footer">
                            <div class="menu-price">Rp 55K <small>/box</small></div>
                            <button class="menu-order-btn" onclick="orderMenu('Paket Seminar Box')">+</button>
                        </div>
                    </div>
                </div>
                <div class="menu-card reveal delay-3" data-category="rapat">
                    <div class="menu-card-img menu-img-rapat"><span class="menu-card-badge">Full Day</span>🏢</div>
                    <div class="menu-card-body">
                        <div class="menu-card-category">Paket Rapat</div>
                        <h3>Paket Full Day Meeting</h3>
                        <p>Paket lengkap pagi-siang-sore untuk meeting seharian penuh.</p>
                        <div class="menu-card-detail">
                            <div class="menu-detail-item">🌅 Morning: Kopi + Pastry</div>
                            <div class="menu-detail-item">🍽️ Lunch: Nasi Box Premium</div>
                            <div class="menu-detail-item">☕ Afternoon: Coffee Break 2</div>
                            <div class="menu-detail-item"> Fruit & Snack</div>
                            <div class="menu-detail-item">💧 Air Mineral (3 botol)</div>
                        </div>
                        <div class="menu-card-footer">
                            <div class="menu-price">Rp 120K <small>/pax</small></div>
                            <button class="menu-order-btn" onclick="orderMenu('Paket Full Day Meeting')">+</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="how-it-works" id="how">
        <div class="container">
            <div class="section-header reveal">
                <div class="section-tag">Cara Pesan</div>
                <h2>Mudah & Cepat</h2>
                <p>Hanya 4 langkah sederhana untuk menikmati catering premium dari Mealvyn.</p>
            </div>
            <div class="steps-grid">
                <div class="step-card reveal delay-1">
                    <div class="step-number"><span>1</span></div>
                    <h3>Pilih Menu</h3>
                    <p>Jelajahi berbagai pilihan menu dan paket catering yang kami tawarkan.</p>
                </div>
                <div class="step-card reveal delay-2">
                    <div class="step-number"><span>2</span></div>
                    <h3>Tentukan Jadwal</h3>
                    <p>Pilih tanggal dan waktu pengiriman sesuai kebutuhan acara Anda.</p>
                </div>
                <div class="step-card reveal delay-3">
                    <div class="step-number"><span>3</span></div>
                    <h3>Konfirmasi</h3>
                    <p>Tim kami akan menghubungi untuk konfirmasi detail pesanan Anda.</p>
                </div>
                <div class="step-card reveal delay-4">
                    <div class="step-number"><span>4</span></div>
                    <h3>Nikmati</h3>
                    <p>Pesanan diantar tepat waktu dan siap dinikmati bersama orang tersayang.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="testimonials" id="testimonials">
        <div class="container">
            <div class="section-header reveal">
                <div class="section-tag">Testimoni</div>
                <h2>Apa Kata Mereka</h2>
                <p>Kepuasan pelanggan adalah prioritas utama kami. Inilah cerita dari mereka yang telah mempercayakan acaranya kepada Mealvyn.</p>
            </div>
            <div class="testimonials-grid">
                <div class="testimonial-card reveal delay-1">
                    <div class="testimonial-stars">★ ★ ★ ★ ★</div>
                    <p class="testimonial-text">"Mealvyn benar-benar luar biasa! Catering untuk pernikahan kami sempurna. Semua tamu memuji rasa makanannya. Terima kasih Mealvyn!"</p>
                    <div class="testimonial-author">
                        <div class="testimonial-avatar">SA</div>
                        <div>
                            <h4>Sarah Amelia</h4>
                            <p>Wedding Event</p>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card reveal delay-2">
                    <div class="testimonial-stars">★ ★ ★ ★ ★</div>
                    <p class="testimonial-text">"Kami sudah berlangganan meal box untuk kantor selama 2 tahun. Kualitas selalu konsisten dan pengiriman selalu tepat waktu."</p>
                    <div class="testimonial-author">
                        <div class="testimonial-avatar">BR</div>
                        <div>
                            <h4>Budi Raharjo</h4>
                            <p>Corporate Client</p>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card reveal delay-3">
                    <div class="testimonial-stars">★ ★ ★ ★ ★</div>
                    <p class="testimonial-text">"Rendangnya juara! Bumbunya meresap sempurna dan porsinya generous. Definitely the best catering in town. Highly recommended!"</p>
                    <div class="testimonial-author">
                        <div class="testimonial-avatar">DW</div>
                        <div>
                            <h4>Dewi Wulandari</h4>
                            <p>Regular Customer</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing -->
    <section class="pricing" id="pricing">
        <div class="container">
            <div class="section-header reveal">
                <div class="section-tag">Paket Harga</div>
                <h2>Pilih Paket Terbaik Anda</h2>
                <p>Kami menawarkan berbagai paket catering yang dapat disesuaikan dengan kebutuhan dan budget Anda.</p>
            </div>
            <div class="pricing-grid">
                <div class="pricing-card reveal delay-1">
                    <div class="pricing-name">Silver</div>
                    <div class="pricing-price">Rp 35K <small>/pax</small></div>
                    <p class="pricing-desc">Cocok untuk acara casual dan gathering kecil</p>
                    <ul class="pricing-features">
                        <li><span class="check">✓</span> Nasi + 1 Lauk Utama</li>
                        <li><span class="check">✓</span> 1 Lauk Pendamping</li>
                        <li><span class="check">✓</span> Sambal & Kerupuk</li>
                        <li><span class="check">✓</span> Air Mineral</li>
                        <li><span class="check">✓</span> Minimal 30 Pax</li>
                    </ul>
                    <button class="pricing-btn">Pilih Paket</button>
                </div>
                <div class="pricing-card featured reveal delay-2">
                    <div class="pricing-name">Gold</div>
                    <div class="pricing-price">Rp 65K <small>/pax</small></div>
                    <p class="pricing-desc">Pilihan terbaik untuk acara spesial Anda</p>
                    <ul class="pricing-features">
                        <li><span class="check">✓</span> Nasi + 2 Lauk Utama</li>
                        <li><span class="check">✓</span> 2 Lauk Pendamping</li>
                        <li><span class="check">✓</span> Salad & Dessert</li>
                        <li><span class="check">✓</span> Minuman Segar</li>
                        <li><span class="check">✓</span> Free Decorasi Meja</li>
                        <li><span class="check">✓</span> Minimal 50 Pax</li>
                    </ul>
                    <button class="pricing-btn">Pilih Paket</button>
                </div>
                <div class="pricing-card reveal delay-3">
                    <div class="pricing-name">Platinum</div>
                    <div class="pricing-price">Rp 120K <small>/pax</small></div>
                    <p class="pricing-desc">Pengalaman dining premium tak terlupakan</p>
                    <ul class="pricing-features">
                        <li><span class="check">✓</span> Buffet Full Menu</li>
                        <li><span class="check">✓</span> Live Cooking Station</li>
                        <li><span class="check">✓</span> Premium Dessert Bar</li>
                        <li><span class="check">✓</span> Welcome Drink</li>
                        <li><span class="check">✓</span> Dedicated Chef</li>
                        <li><span class="check">✓</span> Minimal 100 Pax</li>
                    </ul>
                    <button class="pricing-btn">Pilih Paket</button>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="cta">
        <div class="container reveal">
            <h2>Siap Menikmati Catering Premium?</h2>
            <p>Hubungi kami sekarang dan dapatkan konsultasi gratis untuk acara spesial Anda.</p>
            <a href="#contact" class="btn btn-primary">Konsultasi Gratis →</a>
        </div>
    </section>

    <!-- Contact -->
    <section class="contact" id="contact">
        <div class="container">
            <div class="section-header reveal">
                <div class="section-tag">Hubungi Kami</div>
                <h2>Mari Berdiskusi</h2>
                <p>Ceritakan kebutuhan catering Anda dan tim kami akan segera merespons.</p>
            </div>
            <div class="contact-grid">
                <div class="contact-info reveal-left">
                    <h3>Informasi Kontak</h3>
                    <p>Jangan ragu untuk menghubungi kami. Tim Mealvyn siap membantu mewujudkan acara impian Anda.</p>
                    <div class="contact-details">
                        <div class="contact-detail">
                            <div class="contact-detail-icon">📍</div>
                            <div>
                                <h4>Alamat</h4>
                                <p>Jl. Sudirman No. 123, Jakarta Selatan</p>
                            </div>
                        </div>
                        <div class="contact-detail">
                            <div class="contact-detail-icon">📞</div>
                            <div>
                                <h4>Telepon</h4>
                                <p>+62 812 3456 7890</p>
                            </div>
                        </div>
                        <div class="contact-detail">
                            <div class="contact-detail-icon">✉️</div>
                            <div>
                                <h4>Email</h4>
                                <p>hello@mealvyn.id</p>
                            </div>
                        </div>
                        <div class="contact-detail">
                            <div class="contact-detail-icon"></div>
                            <div>
                                <h4>Jam Operasional</h4>
                                <p>Senin - Sabtu: 08.00 - 20.00 WIB</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="contact-form reveal-right">
                    @if(session('success'))
                    <div class="success-message">✅ {{ session('success') }}</div>
                    @endif
                    <form action="{{ route('contact.submit') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group"><label for="name">Nama Lengkap</label><input type="text" id="name" name="name" placeholder="John Doe" required></div>
                            <div class="form-group"><label for="email">Email</label><input type="email" id="email" name="email" placeholder="john@email.com" required></div>
                        </div>
                        <div class="form-group"><label for="phone">No. Telepon</label><input type="text" id="phone" name="phone" placeholder="+62 812 xxxx xxxx" required></div>
                        <div class="form-group"><label for="message">Pesan</label><textarea id="message" name="message" placeholder="Ceritakan kebutuhan catering Anda..." required></textarea></div>
                        <button type="submit" class="form-submit">Kirim Pesan →</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <a href="{{ route('home') }}" class="nav-logo">Meal<span>vyn</span></a>
                    <p>Mealvyn adalah layanan catering premium yang menghadirkan cita rasa autentik dengan sentuhan modern untuk setiap momen spesial Anda.</p>
                    <div class="footer-socials">
                        <a href="#" class="footer-social">📘</a>
                        <a href="#" class="footer-social"></a>
                        <a href="#" class="footer-social">🐦</a>
                        <a href="#" class="footer-social"></a>
                    </div>
                </div>
                <div>
                    <h4>Menu</h4>
                    <ul class="footer-links">
                        <li><a href="#home">Beranda</a></li>
                        <li><a href="#about">Tentang</a></li>
                        <li><a href="#services">Layanan</a></li>
                        <li><a href="#menu">Menu</a></li>
                        <li><a href="#pricing">Harga</a></li>
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
                <p>Dibuat Ahmad Ibrahimovic</p>
            </div>
        </div>
    </footer>

    <!-- Order Popup -->
    <div class="order-popup-overlay" id="orderPopup">
        <div class="order-popup">
            <div class="order-popup-icon">🎉</div>
            <h3>Paket Dipilih!</h3>
            <p>Anda memilih:</p>
            <p class="popup-package" id="popupPackageName">-</p>
            <p style="font-size:0.85rem; margin-top:12px;">Tim kami akan menghubungi Anda untuk konfirmasi pesanan.</p>
            <div class="order-popup-buttons">
                <button class="popup-btn popup-btn-secondary" onclick="closeOrderPopup()">Batal</button>
                <a href="#contact" class="popup-btn popup-btn-primary" onclick="closeOrderPopup()">Pesan Sekarang</a>
            </div>
        </div>
    </div>

    <!-- Scroll to Top -->
    <button class="scroll-top" id="scrollTop">↑</button>

    <!-- ============================================
         JAVASCRIPT
         ============================================ -->
    <script>
        // Preloader
        window.addEventListener('load', function() {
            setTimeout(function() {
                document.getElementById('preloader').classList.add('hidden');
            }, 1500);
        });

        // Custom Cursor
        const cursor = document.getElementById('cursor');
        if (window.innerWidth > 768) {
            document.addEventListener('mousemove', function(e) {
                cursor.style.left = e.clientX - 10 + 'px';
                cursor.style.top = e.clientY - 10 + 'px';
            });
            document.querySelectorAll('a, button, .menu-tab, .service-card, .menu-card').forEach(function(el) {
                el.addEventListener('mouseenter', function() {
                    cursor.classList.add('hover');
                });
                el.addEventListener('mouseleave', function() {
                    cursor.classList.remove('hover');
                });
            });
        }

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

        // Active Nav Link
        const sections = document.querySelectorAll('section[id]');
        window.addEventListener('scroll', function() {
            let current = '';
            sections.forEach(function(section) {
                if (window.scrollY >= section.offsetTop - 150) current = section.getAttribute('id');
            });
            document.querySelectorAll('.nav-links a').forEach(function(link) {
                link.classList.remove('active');
                if (link.getAttribute('href') === '#' + current || (current === 'home' && link.getAttribute('href') === '{{ route("home") }}')) {
                    link.classList.add('active');
                }
            });
        });

        // Scroll Reveal
        function revealOnScroll() {
            document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-scale').forEach(function(el) {
                if (el.getBoundingClientRect().top < window.innerHeight - 120) el.classList.add('active');
            });
        }
        window.addEventListener('scroll', revealOnScroll);
        window.addEventListener('load', revealOnScroll);

        // Counter Animation
        function animateCounters() {
            document.querySelectorAll('.counter').forEach(function(counter) {
                const target = parseInt(counter.getAttribute('data-target'));
                const step = target / (2000 / 16);
                let current = 0;
                const observer = new IntersectionObserver(function(entries) {
                    entries.forEach(function(entry) {
                        if (entry.isIntersecting) {
                            const timer = setInterval(function() {
                                current += step;
                                if (current < target) {
                                    counter.textContent = Math.floor(current).toLocaleString('id-ID');
                                } else {
                                    counter.textContent = target.toLocaleString('id-ID');
                                    clearInterval(timer);
                                }
                            }, 16);
                            observer.unobserve(entry.target);
                        }
                    });
                }, {
                    threshold: 0.5
                });
                observer.observe(counter);
            });
        }
        animateCounters();

        // Menu Filter by Event Category
        const menuTabs = document.querySelectorAll('.menu-tab');
        const menuCards = document.querySelectorAll('.menu-card');
        menuTabs.forEach(function(tab) {
            tab.addEventListener('click', function() {
                menuTabs.forEach(function(t) {
                    t.classList.remove('active');
                });
                tab.classList.add('active');
                const filter = tab.getAttribute('data-filter');
                menuCards.forEach(function(card, index) {
                    if (filter === 'all' || card.getAttribute('data-category') === filter) {
                        card.classList.remove('hidden-card');
                        card.classList.add('show-card');
                        card.style.animationDelay = (index % 3) * 0.1 + 's';
                    } else {
                        card.classList.add('hidden-card');
                        card.classList.remove('show-card');
                    }
                });
            });
        });

        // Order Popup
        function orderMenu(packageName) {
            document.getElementById('popupPackageName').textContent = packageName;
            document.getElementById('orderPopup').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeOrderPopup() {
            document.getElementById('orderPopup').classList.remove('active');
            document.body.style.overflow = '';
        }
        document.getElementById('orderPopup').addEventListener('click', function(e) {
            if (e.target === this) closeOrderPopup();
        });
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeOrderPopup();
        });

        // Order Button Click Effect
        document.querySelectorAll('.menu-order-btn').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                this.textContent = '✓';
                this.style.background = 'var(--secondary)';
                this.style.color = 'var(--dark)';
                const self = this;
                setTimeout(function() {
                    self.textContent = '+';
                    self.style.background = '';
                    self.style.color = '';
                }, 2000);
            });
        });

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

        // Smooth Scroll for Anchors
        document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
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

        // Parallax on Hero
        window.addEventListener('scroll', function() {
            const scrolled = window.scrollY;
            const heroVisual = document.querySelector('.hero-visual');
            if (heroVisual && scrolled < window.innerHeight) {
                heroVisual.style.transform = 'translateY(' + (scrolled * 0.15) + 'px)';
            }
        });

        // Pricing Button Effect
        document.querySelectorAll('.pricing-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                this.textContent = '✓ Terpilih!';
                this.style.background = 'var(--secondary)';
                this.style.borderColor = 'var(--secondary)';
                this.style.color = 'var(--dark)';
                const self = this;
                setTimeout(function() {
                    self.textContent = 'Pilih Paket';
                    self.style.background = '';
                    self.style.borderColor = '';
                    self.style.color = '';
                }, 2000);
            });
        });
    </script>
</body>

</html>