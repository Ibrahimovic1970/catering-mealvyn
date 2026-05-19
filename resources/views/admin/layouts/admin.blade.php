<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Mealvyn</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #1a5632;
            --primary-light: #2d7a4a;
            --primary-dark: #0e3a20;
            --secondary: #d4a853;
            --danger: #dc3545;
            --warning: #ffc107;
            --success: #28a745;
            --info: #17a2b8;
            --light: #f8f9fa;
            --dark: #1a1a1a;
            --gray: #6b6b6b;
            --white: #ffffff;
            --sidebar-width: 260px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f5f5f5;
            color: var(--dark);
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--primary-dark);
            color: var(--white);
            overflow-y: auto;
            z-index: 1000;
            transition: all 0.3s;
        }

        .sidebar-header {
            padding: 24px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-header h2 {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
        }

        .sidebar-header h2 span {
            color: var(--secondary);
        }

        .sidebar-menu {
            padding: 20px 0;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: rgba(255, 255, 255, 0.1);
            color: var(--white);
            border-left: 4px solid var(--secondary);
        }

        .sidebar-menu a i {
            font-size: 1.2rem;
            width: 24px;
        }

        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: all 0.3s;
        }

        .topbar {
            background: var(--white);
            padding: 16px 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .topbar h1 {
            font-size: 1.5rem;
            font-weight: 600;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .user-info {
            text-align: right;
        }

        .user-info .name {
            font-weight: 600;
            color: var(--dark);
        }

        .user-info .role {
            font-size: 0.85rem;
            color: var(--gray);
            text-transform: capitalize;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: var(--primary);
            color: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.2rem;
            cursor: pointer;
        }

        .content {
            padding: 30px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 24px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: var(--white);
            padding: 24px;
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
        }

        .stat-icon.primary {
            background: rgba(26, 86, 50, 0.1);
        }

        .stat-icon.success {
            background: rgba(40, 167, 69, 0.1);
        }

        .stat-icon.warning {
            background: rgba(255, 193, 7, 0.1);
        }

        .stat-icon.info {
            background: rgba(23, 162, 184, 0.1);
        }

        .stat-content h3 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .stat-content p {
            color: var(--gray);
            font-size: 0.9rem;
        }

        .card {
            background: var(--white);
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .card-header {
            padding: 20px 24px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-header h3 {
            font-size: 1.2rem;
            font-weight: 600;
        }

        .card-body {
            padding: 24px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td {
            padding: 12px 16px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        table th {
            background: var(--light);
            font-weight: 600;
            color: var(--gray);
            font-size: 0.85rem;
            text-transform: uppercase;
        }

        table tr:hover {
            background: var(--light);
        }

        .badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-block;
        }

        .badge-success {
            background: rgba(40, 167, 69, 0.15);
            color: var(--success);
        }

        .badge-warning {
            background: rgba(255, 193, 7, 0.15);
            color: #b8860b;
        }

        .badge-danger {
            background: rgba(220, 53, 69, 0.15);
            color: var(--danger);
        }

        .badge-info {
            background: rgba(23, 162, 184, 0.15);
            color: var(--info);
        }

        .badge-primary {
            background: rgba(26, 86, 50, 0.15);
            color: var(--primary);
        }

        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-primary {
            background: var(--primary);
            color: var(--white);
        }

        .btn-primary:hover {
            background: var(--primary-dark);
        }

        .btn-success {
            background: var(--success);
            color: var(--white);
        }

        .btn-success:hover {
            background: #218838;
        }

        .btn-warning {
            background: var(--warning);
            color: var(--dark);
        }

        .btn-warning:hover {
            background: #e0a800;
        }

        .btn-danger {
            background: var(--danger);
            color: var(--white);
        }

        .btn-danger:hover {
            background: #c82333;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 0.85rem;
        }

        .alert {
            padding: 16px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .alert-success {
            background: rgba(40, 167, 69, 0.1);
            color: var(--success);
            border: 1px solid rgba(40, 167, 69, 0.2);
        }

        .alert-danger {
            background: rgba(220, 53, 69, 0.1);
            color: var(--danger);
            border: 1px solid rgba(220, 53, 69, 0.2);
        }

        /* User Dropdown Menu */
        .user-dropdown {
            position: relative;
        }

        .user-dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            top: 120%;
            background: white;
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
            min-width: 240px;
            z-index: 1000;
            margin-top: 8px;
            overflow: hidden;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .user-dropdown-content.show {
            display: block;
        }

        .user-dropdown-header {
            padding: 16px;
            border-bottom: 1px solid #f0f0f0;
            background: linear-gradient(135deg, #f9f9f9 0%, #ffffff 100%);
        }

        .user-dropdown-header .name {
            font-weight: 700;
            color: var(--dark);
            font-size: 1rem;
            margin-bottom: 4px;
        }

        .user-dropdown-header .role {
            font-size: 0.8rem;
            color: var(--gray);
            text-transform: capitalize;
        }

        .user-dropdown-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 16px;
            color: var(--dark);
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.2s;
            cursor: pointer;
        }

        .user-dropdown-item:hover {
            background: #f0fdf4;
        }

        .user-dropdown-item.logout {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            color: #dc2626;
            font-weight: 600;
            border-top: 1px solid #f0f0f0;
        }

        .user-dropdown-item.logout:hover {
            background: linear-gradient(135deg, #fecaca 0%, #fca5a5 100%);
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
    @stack('styles')
</head>

<body>
    <!-- Sidebar (UPDATED - Hapus "Lihat Website") -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <h2>Meal<span>vyn</span></h2>
            <p style="font-size: 0.85rem; opacity: 0.8; margin-top: 4px;">Admin Panel</p>
        </div>
        <nav class="sidebar-menu">
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span>📊</span> Dashboard
            </a>
            <a href="{{ route('admin.pemesanan.index') }}" class="{{ request()->routeIs('admin.pemesanan.*') ? 'active' : '' }}">
                <span>📦</span> Pesanan
            </a>
            <a href="{{ route('admin.paket.index') }}" class="{{ request()->routeIs('admin.paket.*') ? 'active' : '' }}">
                <span>🍱</span> Kelola Paket
            </a>
            @if(auth()->user()->isAdmin())
            <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <span>👥</span> Manajemen User
            </a>
            @endif
            <!-- DIHAPUS: Menu "Lihat Website" -->
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Topbar (UPDATED - Dropdown Menu) -->
        <div class="topbar">
            <h1>@yield('page-title', 'Dashboard')</h1>
            <div class="user-menu">
                <div class="user-info">
                    <div class="name">{{ auth()->user()->name }}</div>
                    <div class="role">{{ ucfirst(auth()->user()->level) }}</div>
                </div>

                <!-- User Dropdown Button -->
                <div class="user-dropdown">
                    <div class="user-avatar" onclick="toggleUserDropdown()" style="transition: all 0.3s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>

                    <!-- Dropdown Menu Content -->
                    <div id="userDropdownMenu" class="user-dropdown-content">
                        <div class="user-dropdown-header">
                            <div class="name">{{ auth()->user()->name }}</div>
                            <div class="role">{{ ucfirst(auth()->user()->level) }}</div>
                        </div>

                        @if(auth()->user()->isAdmin() || auth()->user()->isCEO())
                        <a href="{{ route('admin.dashboard') }}" class="user-dropdown-item">
                            <span style="font-size: 1.1rem;">⚙️</span>
                            <span>Dashboard Admin</span>
                        </a>
                        @endif

                        <a href="{{ route('home') }}" class="user-dropdown-item">
                            <span style="font-size: 1.1rem;">🏠</span>
                            <span>Beranda</span>
                        </a>

                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="user-dropdown-item logout" style="width: 100%; border: none; cursor: pointer; text-align: left;">
                                <span style="font-size: 1.1rem;">🚪</span>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="content">
            @if(session('success'))
            <div class="alert alert-success">
                <span>✓</span> {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger">
                <span>✕</span> {{ session('error') }}
            </div>
            @endif

            @yield('content')
        </div>
    </div>

    <script>
        // Toggle User Dropdown
        function toggleUserDropdown() {
            const dropdown = document.getElementById('userDropdownMenu');
            dropdown.classList.toggle('show');
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('userDropdownMenu');
            const avatar = event.target.closest('.user-avatar');

            if (!avatar && dropdown.classList.contains('show')) {
                dropdown.classList.remove('show');
            }
        });

        // Auto hide alert
        setTimeout(() => {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-20px)';
                setTimeout(() => alert.remove(), 300);
            });
        }, 5000);
    </script>
    @stack('scripts')
</body>

</html>