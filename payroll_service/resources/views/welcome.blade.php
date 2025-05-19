<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --bs-primary: #FF4433;
            --bs-primary-rgb: 255, 68, 51;
            --bs-primary-hover: #E53E2E;
            --bs-dark: #161615;
            --bs-light: #F8F8F7;
            --bs-body-font-family: 'Inter', sans-serif;
        }

        body {
            font-family: var(--bs-body-font-family);
            background-color: var(--bs-light);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .btn-primary {
            background-color: var(--bs-primary);
            border-color: var(--bs-primary);
        }

        .btn-primary:hover,
        .btn-primary:focus {
            background-color: var(--bs-primary-hover);
            border-color: var(--bs-primary-hover);
        }

        .btn-outline-dark:hover {
            background-color: var(--bs-dark);
        }

        .text-primary {
            color: var(--bs-primary) !important;
        }

        .welcome-container {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .welcome-card {
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            background-color: #fff;
        }

        .welcome-image {
            background: linear-gradient(135deg, #FF4433 0%, #FF7755 100%);
            position: relative;
            overflow: hidden;
            min-height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .welcome-image svg {
            max-width: 80%;
            height: auto;
            filter: drop-shadow(0px 4px 6px rgba(0, 0, 0, 0.1));
        }

        .welcome-content {
            padding: 2.5rem;
        }

        .step-item {
            position: relative;
            padding-left: 2.5rem;
            margin-bottom: 1.5rem;
        }

        .step-item:before {
            content: '';
            position: absolute;
            left: 0.85rem;
            top: 2rem;
            bottom: -1rem;
            width: 1px;
            background-color: rgba(0, 0, 0, 0.1);
        }

        .step-item:last-child:before {
            display: none;
        }

        .step-circle {
            position: absolute;
            left: 0;
            top: 0.25rem;
            width: 1.75rem;
            height: 1.75rem;
            border-radius: 50%;
            background-color: #fff;
            border: 1px solid rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .step-circle-inner {
            width: 0.75rem;
            height: 0.75rem;
            border-radius: 50%;
            background-color: #e9ecef;
        }

        .nav-link {
            color: rgba(0, 0, 0, 0.65);
            border-radius: 0.5rem;
            padding: 0.5rem 1rem;
            transition: all 0.2s ease;
        }

        .nav-link:hover {
            background-color: rgba(0, 0, 0, 0.05);
            color: rgba(0, 0, 0, 0.8);
        }

        .nav-link.active {
            background-color: var(--bs-primary);
            color: white;
        }

        .animated-element {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.8s ease forwards;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .delay-1 {
            animation-delay: 0.1s;
        }

        .delay-2 {
            animation-delay: 0.2s;
        }

        .delay-3 {
            animation-delay: 0.3s;
        }

        .delay-4 {
            animation-delay: 0.4s;
        }

        /* Dark mode styles */
        .dark-mode {
            background-color: var(--bs-dark);
            color: #f8f9fa;
        }

        .dark-mode .welcome-card {
            background-color: #1a1a1a;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .dark-mode .welcome-content {
            color: #e9ecef;
        }

        .dark-mode .step-circle {
            background-color: #1a1a1a;
            border-color: #444;
        }

        .dark-mode .step-circle-inner {
            background-color: #444;
        }

        .dark-mode .step-item:before {
            background-color: #444;
        }

        .dark-mode .nav-link {
            color: rgba(255, 255, 255, 0.65);
        }

        .dark-mode .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.9);
        }

        .dark-mode .btn-outline-dark {
            color: #f8f9fa;
            border-color: #f8f9fa;
        }

        .dark-mode .btn-outline-dark:hover {
            background-color: #f8f9fa;
            color: #212529;
        }

        .dark-mode .welcome-image {
            background: linear-gradient(135deg, #E53E2E 0%, #FF4433 100%);
        }

        .theme-toggle {
            cursor: pointer;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .theme-toggle:hover {
            background-color: rgba(0, 0, 0, 0.05);
        }

        .dark-mode .theme-toggle:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
    </style>
</head>

<body>
    <div class="container py-4">
        <header class="d-flex justify-content-end mb-4">
            <div class="d-flex align-items-center">
                <div class="theme-toggle me-3" id="themeToggle">
                    <i class="fas fa-sun" id="lightIcon"></i>
                    <i class="fas fa-moon d-none" id="darkIcon"></i>
                </div>

                @if (Route::has('login'))
                    <div>
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn btn-outline-dark">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-dark me-2">Log in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </header>

        <div class="welcome-container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="welcome-card animated-element">
                        <div class="row g-0">
                            <div class="col-lg-5 order-lg-2">
                                <div class="welcome-image h-100 d-flex align-items-center justify-content-center p-4">
                                    <svg viewBox="0 0 438 104" fill="none" xmlns="http://www.w3.org/2000/svg"
                                        class="animated-element delay-1">
                                        <path d="M17.2036 -3H0V102.197H49.5189V86.7187H17.2036V-3Z" fill="white" />
                                        <path
                                            d="M110.256 41.6337C108.061 38.1275 104.945 35.3731 100.905 33.3681C96.8667 31.3647 92.8016 30.3618 88.7131 30.3618C83.4247 30.3618 78.5885 31.3389 74.201 33.2923C69.8111 35.2456 66.0474 37.928 62.9059 41.3333C59.7643 44.7401 57.3198 48.6726 55.5754 53.1293C53.8287 57.589 52.9572 62.274 52.9572 67.1813C52.9572 72.1925 53.8287 76.8995 55.5754 81.3069C57.3191 85.7173 59.7636 89.6241 62.9059 93.0293C66.0474 96.4361 69.8119 99.1155 74.201 101.069C78.5885 103.022 83.4247 103.999 88.7131 103.999C92.8016 103.999 96.8667 102.997 100.905 100.994C104.945 98.9911 108.061 96.2359 110.256 92.7282V102.195H126.563V32.1642H110.256V41.6337ZM108.76 75.7472C107.762 78.4531 106.366 80.8078 104.572 82.8112C102.776 84.8161 100.606 86.4183 98.0637 87.6206C95.5202 88.823 92.7004 89.4238 89.6103 89.4238C86.5178 89.4238 83.7252 88.823 81.2324 87.6206C78.7388 86.4183 76.5949 84.8161 74.7998 82.8112C73.004 80.8078 71.6319 78.4531 70.6856 75.7472C69.7356 73.0421 69.2644 70.1868 69.2644 67.1821C69.2644 64.1758 69.7356 61.3205 70.6856 58.6154C71.6319 55.9102 73.004 53.5571 74.7998 51.5522C76.5949 49.5495 78.738 47.9451 81.2324 46.7427C83.7252 45.5404 86.5178 44.9396 89.6103 44.9396C92.7012 44.9396 95.5202 45.5404 98.0637 46.7427C100.606 47.9451 102.776 49.5487 104.572 51.5522C106.367 53.5571 107.762 55.9102 108.76 58.6154C109.756 61.3205 110.256 64.1758 110.256 67.1821C110.256 70.1868 109.756 73.0421 108.76 75.7472Z"
                                            fill="white" />
                                        <path
                                            d="M242.805 41.6337C240.611 38.1275 237.494 35.3731 233.455 33.3681C229.416 31.3647 225.351 30.3618 221.262 30.3618C215.974 30.3618 211.138 31.3389 206.75 33.2923C202.36 35.2456 198.597 37.928 195.455 41.3333C192.314 44.7401 189.869 48.6726 188.125 53.1293C186.378 57.589 185.507 62.274 185.507 67.1813C185.507 72.1925 186.378 76.8995 188.125 81.3069C189.868 85.7173 192.313 89.6241 195.455 93.0293C198.597 96.4361 202.361 99.1155 206.75 101.069C211.138 103.022 215.974 103.999 221.262 103.999C225.351 103.999 229.416 102.997 233.455 100.994C237.494 98.9911 240.611 96.2359 242.805 92.7282V102.195H259.112V32.1642H242.805V41.6337ZM241.31 75.7472C240.312 78.4531 238.916 80.8078 237.122 82.8112C235.326 84.8161 233.156 86.4183 230.614 87.6206C228.07 88.823 225.251 89.4238 222.16 89.4238C219.068 89.4238 216.275 88.823 213.782 87.6206C211.289 86.4183 209.145 84.8161 207.35 82.8112C205.554 80.8078 204.182 78.4531 203.236 75.7472C202.286 73.0421 201.814 70.1868 201.814 67.1821C201.814 64.1758 202.286 61.3205 203.236 58.6154C204.182 55.9102 205.554 53.5571 207.35 51.5522C209.145 49.5495 211.288 47.9451 213.782 46.7427C216.275 45.5404 219.068 44.9396 222.16 44.9396C225.251 44.9396 228.07 45.5404 230.614 46.7427C233.156 47.9451 235.326 49.5487 237.122 51.5522C238.917 53.5571 240.312 55.9102 241.31 58.6154C242.306 61.3205 242.806 64.1758 242.806 67.1821C242.805 70.1868 242.305 73.0421 241.31 75.7472Z"
                                            fill="white" />
                                        <path d="M438 -3H421.694V102.197H438V-3Z" fill="white" />
                                        <path d="M139.43 102.197H155.735V48.2834H183.712V32.1665H139.43V102.197Z"
                                            fill="white" />
                                        <path
                                            d="M324.49 32.1665L303.995 85.794L283.498 32.1665H266.983L293.748 102.197H314.242L341.006 32.1665H324.49Z"
                                            fill="white" />
                                        <path
                                            d="M376.571 30.3656C356.603 30.3656 340.797 46.8497 340.797 67.1828C340.797 89.6597 356.094 104 378.661 104C391.29 104 399.354 99.1488 409.206 88.5848L398.189 80.0226C398.183 80.031 389.874 90.9895 377.468 90.9895C363.048 90.9895 356.977 79.3111 356.977 73.269H411.075C413.917 50.1328 398.775 30.3656 376.571 30.3656ZM357.02 61.0967C357.145 59.7487 359.023 43.3761 376.442 43.3761C393.861 43.3761 395.978 59.7464 396.099 61.0967H357.02Z"
                                            fill="white" />
                                    </svg>

                                    <div class="position-absolute bottom-0 start-0 end-0 p-4 text-center text-white">
                                        <div class="animated-element delay-2">
                                            <span
                                                class="badge bg-white bg-opacity-25 fw-normal px-3 py-2 mb-2">v{{ Illuminate\Foundation\Application::VERSION }}</span>
                                            <p class="mb-0 small">Built with PHP v{{ PHP_VERSION }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-7 order-lg-1">
                                <div class="welcome-content">
                                    <h1 class="h4 fw-bold mb-1 animated-element delay-1">Let's get started</h1>
                                    <p class="text-muted mb-4 animated-element delay-2">Laravel has an incredibly rich
                                        ecosystem. We suggest starting with the following.</p>

                                    <div class="mb-4 animated-element delay-3">
                                        <div class="step-item">
                                            <div class="step-circle">
                                                <div class="step-circle-inner"></div>
                                            </div>
                                            <h5 class="fs-6 fw-semibold mb-1">Read the Documentation</h5>
                                            <p class="text-muted mb-0">Laravel has the most extensive and thorough
                                                documentation of any modern web application framework.</p>
                                            <a href="https://laravel.com/docs"
                                                class="btn btn-sm btn-link text-primary ps-0 mt-2 d-inline-flex align-items-center">
                                                Learn more
                                                <i class="fas fa-arrow-right ms-1 small"></i>
                                            </a>
                                        </div>

                                        <div class="step-item">
                                            <div class="step-circle">
                                                <div class="step-circle-inner"></div>
                                            </div>
                                            <h5 class="fs-6 fw-semibold mb-1">Watch Laracasts</h5>
                                            <p class="text-muted mb-0">Laracasts offers thousands of video tutorials on
                                                Laravel, PHP, and JavaScript development.</p>
                                            <a href="https://laracasts.com"
                                                class="btn btn-sm btn-link text-primary ps-0 mt-2 d-inline-flex align-items-center">
                                                Start watching
                                                <i class="fas fa-arrow-right ms-1 small"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-wrap gap-2 animated-element delay-4">
                                        <a href="https://cloud.laravel.com" class="btn btn-primary">
                                            <i class="fas fa-cloud me-2"></i>Deploy now
                                        </a>
                                        <a href="https://laravel.com/docs/10.x/installation"
                                            class="btn btn-outline-secondary">
                                            <i class="fas fa-book me-2"></i>Installation Guide
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center mt-4">
                <div class="col-lg-10">
                    <div class="d-flex justify-content-center animated-element delay-4">
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a class="nav-link active" href="https://laravel.com/docs">Docs</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="https://laracasts.com">Laracasts</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="https://laravel-news.com">News</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="https://forge.laravel.com">Forge</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="https://github.com/laravel/laravel">GitHub</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <footer class="py-4 text-center text-muted small animated-element delay-4">
            <p class="mb-0">© {{ date('Y') }} Laravel. Crafted with <i class="fas fa-heart text-danger"></i> by Taylor
                Otwell.</p>
        </footer>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Theme toggle functionality
        const themeToggle = document.getElementById('themeToggle');
        const lightIcon = document.getElementById('lightIcon');
        const darkIcon = document.getElementById('darkIcon');
        const body = document.body;

        // Check for saved theme preference or prefer-color-scheme
        const savedTheme = localStorage.getItem('theme');
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

        // Apply the saved theme or use the browser preference
        if (savedTheme === 'dark' || (!savedTheme && prefersDark)) {
            enableDarkMode();
        } else {
            enableLightMode();
        }

        // Toggle theme when button is clicked
        themeToggle.addEventListener('click', () => {
            if (body.classList.contains('dark-mode')) {
                enableLightMode();
                localStorage.setItem('theme', 'light');
            } else {
                enableDarkMode();
                localStorage.setItem('theme', 'dark');
            }
        });

        function enableDarkMode() {
            body.classList.add('dark-mode');
            lightIcon.classList.add('d-none');
            darkIcon.classList.remove('d-none');
        }

        function enableLightMode() {
            body.classList.remove('dark-mode');
            lightIcon.classList.remove('d-none');
            darkIcon.classList.add('d-none');
        }

        // Add animation to elements when they come into view
        document.addEventListener('DOMContentLoaded', function () {
            const animatedElements = document.querySelectorAll('.animated-element');

            // Trigger animations immediately for elements above the fold
            animatedElements.forEach(element => {
                element.style.animationPlayState = 'running';
            });
        });
    </script>
</body>

</html>