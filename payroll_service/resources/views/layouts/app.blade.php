<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Payroll App')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4361ee;
            --primary-dark: #3a56d4;
            --secondary: #7209b7;
            --success: #2ec4b6;
            --info: #3f8efc;
            --warning: #f9c74f;
            --danger: #e63946;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6c757d;
            --gray-dark: #343a40;
            --gray-light: #f1f3f5;
            --body-bg: #f9fafb;
            --sidebar-width: 280px;
            --sidebar-collapsed-width: 70px;
            --topbar-height: 70px;
            --border-radius: 0.5rem;
            --transition-speed: 0.3s;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--body-bg);
            color: var(--dark);
            overflow-x: hidden;
            position: relative;
            min-height: 100vh;
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: var(--sidebar-width);
            background: white;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            z-index: 1000;
            transition: all var(--transition-speed) ease;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }

        .sidebar-header {
            padding: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .sidebar-logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .sidebar-logo i {
            font-size: 1.75rem;
        }

        .sidebar-toggle {
            background: transparent;
            border: none;
            color: var(--gray);
            cursor: pointer;
            font-size: 1.25rem;
            padding: 0.25rem;
            border-radius: 0.25rem;
            transition: all 0.2s ease;
        }

        .sidebar-toggle:hover {
            color: var(--primary);
            background-color: rgba(67, 97, 238, 0.1);
        }

        .sidebar-menu {
            padding: 1.5rem 0;
            list-style: none;
            margin: 0;
        }

        .sidebar-item {
            margin-bottom: 0.25rem;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            color: var(--gray-dark);
            text-decoration: none;
            transition: all 0.2s ease;
            border-left: 3px solid transparent;
            gap: 0.75rem;
        }

        .sidebar-link:hover, .sidebar-link.active {
            background-color: rgba(67, 97, 238, 0.1);
            color: var(--primary);
            border-left-color: var(--primary);
        }

        .sidebar-link i {
            font-size: 1.25rem;
            min-width: 1.5rem;
            text-align: center;
        }

        .sidebar-link-text {
            transition: opacity var(--transition-speed) ease;
        }

        .sidebar.collapsed .sidebar-link-text,
        .sidebar.collapsed .sidebar-header-text,
        .sidebar.collapsed .sidebar-toggle {
            opacity: 0;
            visibility: hidden;
        }

        .sidebar-divider {
            height: 1px;
            background-color: rgba(0, 0, 0, 0.05);
            margin: 1rem 1.5rem;
        }

        /* Main Content Styles */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            transition: margin-left var(--transition-speed) ease;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .main-wrapper.expanded {
            margin-left: var(--sidebar-collapsed-width);
        }

        .topbar {
            height: var(--topbar-height);
            background-color: white;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1.5rem;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .topbar-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--dark);
        }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-dropdown {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            cursor: pointer;
            padding: 0.5rem 0.75rem;
            border-radius: var(--border-radius);
            transition: all 0.2s ease;
        }

        .user-dropdown:hover {
            background-color: var(--gray-light);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 1rem;
        }

        .user-info {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-weight: 600;
            font-size: 0.875rem;
            color: var(--dark);
        }

        .user-role {
            font-size: 0.75rem;
            color: var(--gray);
        }

        /* Main Content Area */
        .main-content {
            padding: 2rem;
            flex: 1;
        }

        /* Card Styles */
        .card {
            border: none;
            border-radius: var(--border-radius);
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            margin-bottom: 1.5rem;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: transparent;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 1.25rem 1.5rem;
            font-weight: 600;
        }

        .card-body {
            padding: 1.5rem;
        }

        /* Alert Styles */
        .alert {
            border: none;
            border-radius: var(--border-radius);
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .alert-icon {
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .alert-content {
            flex: 1;
        }

        .alert-success {
            background-color: rgba(46, 196, 182, 0.1);
            color: var(--success);
        }

        .alert-danger {
            background-color: rgba(230, 57, 70, 0.1);
            color: var(--danger);
        }

        .alert-warning {
            background-color: rgba(249, 199, 79, 0.1);
            color: var(--warning);
        }

        /* Button Styles */
        .btn {
            border-radius: var(--border-radius);
            padding: 0.5rem 1.25rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
        }

        /* Form Styles */
        .form-control, .form-select {
            border-radius: var(--border-radius);
            padding: 0.75rem 1rem;
            border: 1px solid rgba(0, 0, 0, 0.1);
        }

        .form-control:focus, .form-select:focus {
            box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.25);
            border-color: var(--primary);
        }

        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: var(--gray-dark);
        }

        /* Table Styles */
        .table {
            border-collapse: separate;
            border-spacing: 0;
        }

        .table th {
            font-weight: 600;
            color: var(--gray-dark);
            background-color: var(--gray-light);
            border-bottom: none;
            padding: 1rem;
        }

        .table td {
            padding: 1rem;
            vertical-align: middle;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.02);
        }

        .table-hover tbody tr:hover {
            background-color: rgba(67, 97, 238, 0.05);
        }

        /* Badge Styles */
        .badge {
            padding: 0.5rem 0.75rem;
            font-weight: 500;
            border-radius: 50rem;
        }

        /* Responsive Styles */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.mobile-show {
                transform: translateX(0);
            }

            .main-wrapper {
                margin-left: 0;
            }

            .main-wrapper.expanded {
                margin-left: 0;
            }

            .mobile-sidebar-toggle {
                display: block;
            }
        }

        @media (min-width: 993px) {
            .mobile-sidebar-toggle {
                display: none;
            }
        }

        /* Animation Styles */
        .fade-in {
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="{{ Auth::check() ? (Auth::user()->isAdmin() ? route('admin.dashboard') : route('karyawan.dashboard')) : route('login') }}" class="sidebar-logo">
                <i class="fas fa-money-check-alt"></i>
                <span class="sidebar-header-text">PayrollApp</span>
            </a>
            <button class="sidebar-toggle" id="sidebar-toggle">
                <i class="fas fa-chevron-left"></i>
            </button>
        </div>

        <ul class="sidebar-menu">
            @auth
                @if(Auth::user()->isAdmin())
                    <li class="sidebar-item">
                        <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="fas fa-tachometer-alt"></i>
                            <span class="sidebar-link-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('admin.karyawan.index') }}" class="sidebar-link {{ request()->routeIs('admin.karyawan.*') ? 'active' : '' }}">
                            <i class="fas fa-users"></i>
                            <span class="sidebar-link-text">Kelola Karyawan</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('admin.absensi.rekap') }}" class="sidebar-link {{ request()->routeIs('admin.absensi.*') ? 'active' : '' }}">
                            <i class="fas fa-calendar-check"></i>
                            <span class="sidebar-link-text">Rekap Absensi</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('admin.gaji.index') }}" class="sidebar-link {{ request()->routeIs('admin.gaji.*') ? 'active' : '' }}">
                            <i class="fas fa-wallet"></i>
                            <span class="sidebar-link-text">Hitung Gaji</span>
                        </a>
                    </li>
                    
                    <div class="sidebar-divider"></div>
                    
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">
                            <i class="fas fa-cog"></i>
                            <span class="sidebar-link-text">Pengaturan</span>
                        </a>
                    </li>
                @elseif(Auth::user()->isKaryawan())
                    <li class="sidebar-item">
                        <a href="{{ route('karyawan.dashboard') }}" class="sidebar-link {{ request()->routeIs('karyawan.dashboard') ? 'active' : '' }}">
                            <i class="fas fa-tachometer-alt"></i>
                            <span class="sidebar-link-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">
                            <i class="fas fa-calendar-alt"></i>
                            <span class="sidebar-link-text">Absensi</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">
                            <i class="fas fa-file-invoice-dollar"></i>
                            <span class="sidebar-link-text">Slip Gaji</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">
                            <i class="fas fa-user"></i>
                            <span class="sidebar-link-text">Profil</span>
                        </a>
                    </li>
                @endif
            @endauth
        </ul>
    </aside>

    <!-- Main Content Wrapper -->
    <div class="main-wrapper" id="main-wrapper">
        <!-- Top Navigation Bar -->
        <header class="topbar">
            <div class="d-flex align-items-center">
                <button class="btn btn-sm btn-light me-3 mobile-sidebar-toggle" id="mobile-sidebar-toggle">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="topbar-title">@yield('page-title', 'Dashboard')</h1>
            </div>
            
            <div class="topbar-actions">
                @auth
                <div class="dropdown">
                    <div class="user-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="user-avatar">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <div class="user-info d-none d-md-flex">
                            <span class="user-name">{{ Auth::user()->name }}</span>
                            <span class="user-role">{{ Auth::user()->isAdmin() ? 'Administrator' : 'Karyawan' }}</span>
                        </div>
                        <i class="fas fa-chevron-down ms-2 text-muted"></i>
                    </div>
                    <ul class="dropdown-menu dropdown-menu-end shadow">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i> Profil</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i> Pengaturan</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt me-2"></i> Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
                @endauth
            </div>
        </header>

        <!-- Main Content Area -->
        <main class="main-content fade-in">
            <!-- Alert Messages -->
            @if(session('success'))
                <div class="alert alert-success">
                    <div class="alert-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="alert-content">
                        {{ session('success') }}
                    </div>
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger">
                    <div class="alert-icon">
                        <i class="fas fa-times-circle"></i>
                    </div>
                    <div class="alert-content">
                        {{ session('error') }}
                    </div>
                </div>
            @endif
            
            @if(session('warning'))
                <div class="alert alert-warning">
                    <div class="alert-icon">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div class="alert-content">
                        {{ session('warning') }}
                    </div>
                </div>
            @endif
            
            @if ($errors->any())
                <div class="alert alert-danger">
                    <div class="alert-icon">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>
                    <div class="alert-content">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <!-- Page Content -->
            @yield('content')
        </main>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Sidebar toggle functionality
            const sidebar = document.getElementById('sidebar');
            const mainWrapper = document.getElementById('main-wrapper');
            const sidebarToggle = document.getElementById('sidebar-toggle');
            const mobileSidebarToggle = document.getElementById('mobile-sidebar-toggle');
            
            // Check for saved sidebar state
            const sidebarCollapsed = localStorage.getItem('sidebar-collapsed') === 'true';
            
            if (sidebarCollapsed) {
                sidebar.classList.add('collapsed');
                mainWrapper.classList.add('expanded');
            }
            
            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('collapsed');
                mainWrapper.classList.toggle('expanded');
                
                // Save sidebar state
                localStorage.setItem('sidebar-collapsed', sidebar.classList.contains('collapsed'));
            });
            
            // Mobile sidebar toggle
            mobileSidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('mobile-show');
            });
            
            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(event) {
                const isClickInsideSidebar = sidebar.contains(event.target);
                const isClickOnMobileToggle = mobileSidebarToggle.contains(event.target);
                
                if (!isClickInsideSidebar && !isClickOnMobileToggle && window.innerWidth < 993 && sidebar.classList.contains('mobile-show')) {
                    sidebar.classList.remove('mobile-show');
                }
            });
            
            // Update sidebar icon on collapse/expand
            sidebarToggle.addEventListener('click', function() {
                const icon = sidebarToggle.querySelector('i');
                if (sidebar.classList.contains('collapsed')) {
                    icon.classList.remove('fa-chevron-left');
                    icon.classList.add('fa-chevron-right');
                } else {
                    icon.classList.remove('fa-chevron-right');
                    icon.classList.add('fa-chevron-left');
                }
            });
            
            // Initialize tooltips
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
            
            // Auto-hide alerts after 5 seconds
            const alerts = document.querySelectorAll('.alert:not(.alert-permanent)');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                    alert.style.opacity = '0';
                    alert.style.transform = 'translateY(-10px)';
                    
                    setTimeout(() => {
                        alert.remove();
                    }, 500);
                }, 5000);
            });
        });
    </script>
</body>

</html>