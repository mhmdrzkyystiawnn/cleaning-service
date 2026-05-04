<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'CleanPro - Layanan Pembersihan Profesional')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            :root {
                --forest:    #546B41;
                --sage:      #99AD7A;
                --linen:     #DCCCAC;
                --cream:     #FFF8EC;
                --forest-dk: #3d5030;
                --sage-lt:   #b8c99e;
                --linen-lt:  #ede0ca;
            }

            * { box-sizing: border-box; }

            body {
                font-family: 'Plus Jakarta Sans', 'Figtree', sans-serif;
                background-color: var(--cream);
                color: #1f2937;
            }

            /* ── Navbar ── */
            .navbar {
                background: rgba(255,248,236,0.95);
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
                border-bottom: 1px solid var(--linen);
                box-shadow: 0 1px 8px rgba(84,107,65,0.07);
                position: sticky;
                top: 0;
                z-index: 40;
            }

            .nav-brand {
                display: flex;
                align-items: center;
                gap: 8px;
                font-size: 1.35rem;
                font-weight: 800;
                color: var(--forest);
                text-decoration: none;
                letter-spacing: -0.02em;
            }

            .nav-brand-icon {
                width: 34px;
                height: 34px;
                background: linear-gradient(135deg, var(--forest), var(--sage));
                border-radius: 10px;
                display: flex;
                align-items: center;
                justify-content: center;
                color: var(--cream);
                font-size: 0.9rem;
            }

            .nav-link {
                font-size: 0.875rem;
                font-weight: 500;
                color: #4b5563;
                text-decoration: none;
                padding: 0.3rem 0.1rem;
                position: relative;
                transition: color 0.18s;
            }

            .nav-link::after {
                content: '';
                position: absolute;
                left: 0; bottom: -2px;
                width: 0; height: 2px;
                background: var(--sage);
                border-radius: 2px;
                transition: width 0.2s;
            }

            .nav-link:hover { color: var(--forest); }
            .nav-link:hover::after { width: 100%; }

            .nav-link.active {
                color: var(--forest);
                font-weight: 600;
            }

            .nav-link.active::after { width: 100%; }

            .nav-admin-badge {
                display: inline-flex;
                align-items: center;
                gap: 5px;
                padding: 0.3rem 0.75rem;
                background: rgba(220,204,172,0.4);
                border: 1px solid var(--linen);
                color: var(--forest-dk);
                border-radius: 8px;
                font-size: 0.8rem;
                font-weight: 700;
                text-decoration: none;
                transition: background 0.18s;
            }

            .nav-admin-badge:hover {
                background: var(--linen);
            }

            .nav-btn-login {
                font-size: 0.875rem;
                font-weight: 600;
                color: var(--forest);
                text-decoration: none;
                transition: color 0.18s;
            }

            .nav-btn-login:hover { color: var(--forest-dk); }

            .nav-btn-register {
                display: inline-block;
                background: var(--forest);
                color: var(--cream);
                font-size: 0.875rem;
                font-weight: 700;
                padding: 0.5rem 1.1rem;
                border-radius: 10px;
                text-decoration: none;
                transition: background 0.18s, box-shadow 0.18s;
                box-shadow: 0 2px 8px rgba(84,107,65,0.2);
            }

            .nav-btn-register:hover {
                background: var(--forest-dk);
                box-shadow: 0 4px 14px rgba(84,107,65,0.3);
            }

            /* User dropdown */
            .nav-user-btn {
                display: flex;
                align-items: center;
                gap: 6px;
                font-size: 0.875rem;
                font-weight: 600;
                color: var(--forest);
                background: none;
                border: none;
                cursor: pointer;
                padding: 0.35rem 0.6rem;
                border-radius: 8px;
                transition: background 0.18s;
            }

            .nav-user-btn:hover { background: rgba(84,107,65,0.08); }

            .dropdown-menu {
                position: absolute;
                right: 0;
                top: 50%;
                width: 180px;
                background: white;
                border: 1px solid var(--linen);
                border-radius: 14px;
                box-shadow: 0 8px 32px rgba(84,107,65,0.12);
                overflow: hidden;
                display: none;
                z-index: 50;
            }

            .group:hover .dropdown-menu { display: block; }

            .dropdown-item {
                display: block;
                padding: 0.6rem 1rem;
                font-size: 0.85rem;
                color: #374151;
                text-decoration: none;
                transition: background 0.15s, color 0.15s;
            }

            .dropdown-item:hover {
                background: var(--cream);
                color: var(--forest);
            }

            .dropdown-item-btn {
                width: 100%;
                text-align: left;
                background: none;
                border: none;
                cursor: pointer;
                padding: 0.6rem 1rem;
                font-size: 0.85rem;
                color: #374151;
                transition: background 0.15s, color 0.15s;
            }

            .dropdown-item-btn:hover {
                background: var(--cream);
                color: var(--forest);
            }

            /* ── Alerts ── */
            .alert {
                display: flex;
                justify-content: space-between;
                align-items: flex-start;
                padding: 0.9rem 1.1rem;
                border-radius: 0 12px 12px 0;
                margin: 1rem 1rem 0;
                font-size: 0.875rem;
            }

            .alert-success {
                background: rgba(153,173,122,0.12);
                border-left: 4px solid var(--sage);
                color: var(--forest-dk);
            }

            .alert-error {
                background: #fef2f2;
                border-left: 4px solid #ef4444;
                color: #b91c1c;
            }

            .alert-close {
                background: none;
                border: none;
                cursor: pointer;
                font-size: 1.1rem;
                opacity: 0.55;
                line-height: 1;
                padding: 0 0 0 0.5rem;
                flex-shrink: 0;
            }

            .alert-close:hover { opacity: 1; }

            /* ── Footer ── */
            .footer {
                background: linear-gradient(170deg, var(--forest-dk) 0%, var(--forest) 100%);
                color: var(--cream);
                padding: 4rem 0 0;
                margin-top: 5rem;
            }

            .footer-brand {
                display: flex;
                align-items: center;
                gap: 8px;
                font-size: 1.2rem;
                font-weight: 800;
                color: var(--cream);
                margin-bottom: 0.75rem;
            }

            .footer-brand-icon {
                width: 32px;
                height: 32px;
                background: var(--sage);
                border-radius: 9px;
                display: flex;
                align-items: center;
                justify-content: center;
                color: var(--forest-dk);
                font-size: 0.85rem;
            }

            .footer-desc {
                font-size: 0.85rem;
                color: rgba(220,204,172,0.65);
                line-height: 1.7;
            }

            .footer-heading {
                font-size: 0.8rem;
                font-weight: 700;
                letter-spacing: 0.1em;
                text-transform: uppercase;
                color: var(--sage);
                margin-bottom: 1rem;
            }

            .footer-link {
                display: block;
                font-size: 0.85rem;
                color: rgba(220,204,172,0.65);
                text-decoration: none;
                padding: 0.2rem 0;
                transition: color 0.18s;
            }

            .footer-link:hover { color: var(--cream); }

            .footer-contact-item {
                display: flex;
                align-items: flex-start;
                gap: 8px;
                font-size: 0.85rem;
                color: rgba(220,204,172,0.65);
                margin-bottom: 0.5rem;
                line-height: 1.5;
            }

            .footer-contact-icon {
                color: var(--sage);
                width: 14px;
                text-align: center;
                margin-top: 2px;
                flex-shrink: 0;
            }

            .footer-bottom {
                border-top: 1px solid rgba(153,173,122,0.2);
                padding: 1.25rem 0;
                margin-top: 3rem;
                text-align: center;
                font-size: 0.8rem;
                color: rgba(220,204,172,0.4);
            }

            /* ── Mobile menu ── */
            #mobile-menu {
                background: white;
                border-top: 1px solid var(--linen);
            }

            .mobile-link {
                display: block;
                padding: 0.65rem 0.75rem;
                font-size: 0.9rem;
                font-weight: 500;
                color: #4b5563;
                text-decoration: none;
                border-radius: 8px;
                transition: background 0.15s, color 0.15s;
            }

            .mobile-link:hover {
                background: var(--cream);
                color: var(--forest);
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen flex flex-col">

            <!-- Navigation -->
            <nav class="navbar">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between items-center h-16">

                        <!-- Brand -->
                        <a href="{{ route('home') }}" class="nav-brand">
                            <span class="nav-brand-icon"><i class="fas fa-leaf"></i></span>
                            CleanPro
                        </a>

                        <!-- Desktop Nav -->
                        <div class="hidden md:flex items-center gap-6">
                            <a href="{{ route('home') }}"    class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                            <a href="{{ route('katalog') }}" class="nav-link {{ request()->routeIs('katalog') ? 'active' : '' }}">Katalog</a>
                            <a href="{{ route('about') }}"   class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">Tentang Kami</a>
                            <a href="{{ route('faq') }}"     class="nav-link {{ request()->routeIs('faq') ? 'active' : '' }}">FAQ</a>

                            @auth
                                @if(Auth::user()->is_admin)
                                    <a href="{{ route('admin.dashboard') }}" class="nav-admin-badge">
                                        <i class="fas fa-shield-halved" style="font-size:0.7rem;"></i>Admin Panel
                                    </a>
                                @else
                                    <a href="{{ route('bookings.list') }}" class="nav-link {{ request()->routeIs('bookings.list') ? 'active' : '' }}">My Bookings</a>
                                @endif

                                <div class="relative group">
    <button class="nav-user-btn flex items-center gap-2 cursor-pointer">
        <i class="fas fa-circle-user"></i>
        {{ Auth::user()->name }}
        <i class="fas fa-chevron-down" style="font-size:0.65rem; opacity:0.6;"></i>
    </button>

    <div class="dropdown-menu absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10 hidden group-hover:block">
        <a href="{{ route('dashboard') }}" class="dropdown-item block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
            <i class="fas fa-tachometer-alt mr-2" style="opacity:0.5;"></i> Dashboard
        </a>
        <form method="POST" action="{{ route('logout') }}" class="block">
            @csrf
            <button type="submit" class="dropdown-item-btn w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                <i class="fas fa-arrow-right-from-bracket mr-2" style="opacity:0.5;"></i> Logout
            </button>
        </form>
    </div>
</div>
                            @else
                                <a href="{{ route('login') }}"    class="nav-btn-login">Login</a>
                                <a href="{{ route('register') }}" class="nav-btn-register">Daftar</a>
                            @endauth
                        </div>

                        <!-- Mobile toggle -->
                        <button class="md:hidden text-gray-600 hover:text-gray-900 transition" id="mobile-menu-btn">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                    </div>
                </div>

                <!-- Mobile Menu -->
                <div id="mobile-menu" class="hidden md:hidden">
                    <div class="px-3 pt-2 pb-3 space-y-1 max-w-7xl mx-auto">
                        <a href="{{ route('home') }}"    class="mobile-link">Home</a>
                        <a href="{{ route('katalog') }}" class="mobile-link">Katalog</a>
                        <a href="{{ route('about') }}"   class="mobile-link">Tentang Kami</a>
                        <a href="{{ route('faq') }}"     class="mobile-link">FAQ</a>
                        @auth
                            <a href="{{ route('bookings.list') }}" class="mobile-link">My Bookings</a>
                            <a href="{{ route('profile.edit') }}"  class="mobile-link">Profile</a>
                        @else
                            <a href="{{ route('login') }}"    class="mobile-link">Login</a>
                            <a href="{{ route('register') }}" class="mobile-link" style="color:var(--forest);font-weight:700;">Daftar</a>
                        @endauth
                    </div>
                </div>
            </nav>

            <!-- Alert Messages -->
            @if ($errors->any())
                <div class="alert alert-error">
                    <div>
                        <p class="font-bold mb-1">Terjadi Kesalahan!</p>
                        <ul class="list-disc ml-5 mt-1 space-y-0.5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    <span>{{ session('success') }}</span>
                    <button class="alert-close" onclick="this.parentElement.style.display='none'">&times;</button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-error">
                    <span>{{ session('error') }}</span>
                    <button class="alert-close" onclick="this.parentElement.style.display='none'">&times;</button>
                </div>
            @endif

            <!-- Main Content -->
            <main class="flex-1">
                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="footer">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-8 pb-8">

                        <!-- Brand col -->
                        <div>
                            <div class="footer-brand">
                                <span class="footer-brand-icon"><i class="fas fa-leaf"></i></span>
                                CleanPro
                            </div>
                            <p class="footer-desc">Layanan pembersihan profesional dan terpercaya untuk rumah dan kantor Anda.</p>
                        </div>

                        <!-- Layanan -->
                        <div>
                            <p class="footer-heading">Layanan</p>
                            <a href="{{ route('katalog') }}" class="footer-link">Katalog Paket</a>
                            <a href="{{ route('about') }}"   class="footer-link">Tentang Kami</a>
                            <a href="{{ route('faq') }}"     class="footer-link">FAQ</a>
                        </div>

                        <!-- Akun -->
                        <div>
                            <p class="footer-heading">Akun</p>
                            @auth
                                <a href="{{ route('bookings.list') }}" class="footer-link">My Bookings</a>
                                <a href="{{ route('profile.edit') }}"  class="footer-link">Profile</a>
                            @else
                                <a href="{{ route('login') }}"    class="footer-link">Login</a>
                                <a href="{{ route('register') }}" class="footer-link">Daftar</a>
                            @endauth
                        </div>

                        <!-- Kontak -->
                        <div>
                            <p class="footer-heading">Hubungi Kami</p>
                            <div class="footer-contact-item">
                                <i class="fas fa-phone footer-contact-icon"></i>
                                +62 821-1234-5678
                            </div>
                            <div class="footer-contact-item">
                                <i class="fas fa-envelope footer-contact-icon"></i>
                                info@cleanpro.com
                            </div>
                            <div class="footer-contact-item">
                                <i class="fas fa-location-dot footer-contact-icon"></i>
                                Jakarta, Indonesia
                            </div>
                        </div>
                    </div>
                </div>

                <div class="footer-bottom">
                    <p>&copy; 2026 CleanPro. All rights reserved.</p>
                </div>
            </footer>
        </div>

        <script>
            document.getElementById('mobile-menu-btn')?.addEventListener('click', function() {
                document.getElementById('mobile-menu').classList.toggle('hidden');
            });
        </script>
    </body>
</html>