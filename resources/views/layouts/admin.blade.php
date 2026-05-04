<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Dashboard - CleanPro')</title>

    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --forest:    #546B41;
            --sage:      #99AD7A;
            --linen:     #DCCCAC;
            --cream:     #FFF8EC;
            --forest-dk: #3d5030;
            --sage-lt:   #b8c99e;
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Plus Jakarta Sans', 'Figtree', sans-serif;
            background: var(--cream);
        }

        /* Sidebar */
        aside {
            background: linear-gradient(180deg, var(--forest-dk) 0%, var(--forest) 100%);
            border-right: 1px solid rgba(153,173,122,0.15);
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.2rem;
            font-weight: 800;
            color: var(--cream);
            text-decoration: none;
        }

        .sidebar-brand .brand-icon {
            width: 36px;
            height: 36px;
            background: var(--sage);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            color: var(--forest-dk);
        }

        .sidebar-divider {
            border-color: rgba(153,173,122,0.2);
            margin: 1rem 0;
        }

        .nav-label {
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: rgba(220,204,172,0.45);
            padding: 0 1rem;
            margin-bottom: 0.35rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0.6rem 1rem;
            border-radius: 10px;
            font-size: 0.875rem;
            font-weight: 500;
            color: rgba(255,248,236,0.75);
            text-decoration: none;
            transition: background 0.18s, color 0.18s;
        }

        .nav-link:hover {
            background: rgba(153,173,122,0.18);
            color: var(--cream);
        }

        .nav-link.active {
            background: var(--sage);
            color: var(--forest-dk);
            font-weight: 700;
            box-shadow: 0 2px 10px rgba(84,107,65,0.35);
        }

        .nav-link .nav-icon {
            width: 28px;
            height: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 7px;
            background: rgba(255,248,236,0.08);
            font-size: 0.8rem;
        }

        .nav-link.active .nav-icon {
            background: rgba(84,107,65,0.25);
        }

        .sidebar-footer-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0.55rem 1rem;
            border-radius: 10px;
            font-size: 0.85rem;
            font-weight: 500;
            color: rgba(220,204,172,0.7);
            text-decoration: none;
            background: none;
            border: none;
            width: 100%;
            cursor: pointer;
            transition: background 0.18s;
        }

        .sidebar-footer-link:hover {
            background: rgba(220,204,172,0.1);
            color: var(--cream);
        }

        /* Top Nav */
        .topnav {
            background: white;
            border-bottom: 1px solid var(--linen);
            box-shadow: 0 1px 6px rgba(84,107,65,0.06);
        }

        .topnav-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            border: 2px solid var(--sage);
            object-fit: cover;
        }

        .topnav-username {
            font-size: 0.875rem;
            font-weight: 700;
            color: var(--forest);
        }

        /* Alerts */
        .alert-error {
            background: #fef2f2;
            border-left: 4px solid #ef4444;
            color: #b91c1c;
            padding: 1rem 1.25rem;
            border-radius: 0 10px 10px 0;
            margin-bottom: 1rem;
        }

        .alert-success {
            background: #f0fdf0;
            border-left: 4px solid var(--sage);
            color: var(--forest-dk);
            padding: 1rem 1.25rem;
            border-radius: 0 10px 10px 0;
            margin-bottom: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .alert-close {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 1.25rem;
            opacity: 0.6;
        }

        /* Cards & Tables */
        .stat-card {
            background: white;
            border: 1px solid var(--linen);
            border-radius: 20px;
            padding: 1.5rem;
            transition: all 0.2s;
        }

        .stat-card:hover {
            box-shadow: 0 8px 20px rgba(84,107,65,0.08);
            border-color: var(--sage);
        }

        .data-table {
            background: white;
            border-radius: 20px;
            border: 1px solid var(--linen);
            overflow: hidden;
        }

        .data-table thead {
            background: var(--cream);
        }

        .data-table th {
            padding: 1rem 1.5rem;
            text-align: left;
            font-weight: 700;
            color: var(--forest-dk);
            font-size: 0.8rem;
            letter-spacing: 0.05em;
        }

        .data-table td {
            padding: 1rem 1.5rem;
            border-top: 1px solid var(--linen);
            font-size: 0.85rem;
            color: #374151;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 0.25rem 0.7rem;
            border-radius: 999px;
            font-size: 0.7rem;
            font-weight: 700;
        }

        .badge-pending { background: #fef3c7; color: #b45309; }
        .badge-confirmed { background: #e0f2fe; color: #0369a1; }
        .badge-completed { background: #dcfce7; color: #15803d; }
        .badge-cancelled { background: #fee2e2; color: #b91c1c; }

        .quick-action-card {
            background: white;
            border: 1px solid var(--linen);
            border-radius: 20px;
            padding: 1.5rem;
            transition: all 0.2s;
            text-decoration: none;
            display: block;
        }

        .quick-action-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 24px rgba(84,107,65,0.12);
            border-color: var(--sage);
        }
    </style>
</head>
<body>
    <div class="min-h-screen flex">
        <!-- Sidebar (Desktop) -->
        <aside class="w-64 hidden md:flex flex-col sticky top-0 h-screen overflow-y-auto">
            <div class="px-5 py-6">
                <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
                    <span class="brand-icon"><i class="fas fa-leaf"></i></span>
                    <span>CleanPro</span>
                </a>
            </div>
            <hr class="sidebar-divider mx-5">

            <nav class="px-4 flex-1 space-y-1">
                <p class="nav-label">Menu Utama</p>
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <span class="nav-icon"><i class="fas fa-chart-line"></i></span> Dashboard
                </a>
                <a href="{{ route('admin.bookings') }}" class="nav-link {{ request()->routeIs('admin.bookings*') ? 'active' : '' }}">
                    <span class="nav-icon"><i class="fas fa-calendar-check"></i></span> Bookings
                </a>
                <a href="{{ route('admin.packages') }}" class="nav-link {{ request()->routeIs('admin.packages*') ? 'active' : '' }}">
                    <span class="nav-icon"><i class="fas fa-box-open"></i></span> Packages
                </a>
                <a href="{{ route('admin.faqs') }}" class="nav-link {{ request()->routeIs('admin.faqs*') ? 'active' : '' }}">
                    <span class="nav-icon"><i class="fas fa-circle-question"></i></span> FAQ
                </a>
            </nav>

            <div class="px-4 pb-6 mt-4">
                <hr class="sidebar-divider">
                <a href="{{ route('home') }}" class="sidebar-footer-link">
                    <i class="fas fa-globe w-4 text-center"></i> Lihat Website
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="sidebar-footer-link">
                        <i class="fas fa-arrow-right-from-bracket w-4 text-center"></i> Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-w-0">
            <!-- Top Nav -->
            <nav class="topnav px-5 py-3 flex justify-between items-center">
                <div class="flex items-center md:hidden">
                    <button id="mobile-menu-btn" class="text-gray-600 hover:text-gray-900">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
                <div class="flex-1"></div>
                <div class="flex items-center gap-3">
                    <span class="topnav-username">{{ Auth::user()->name }}</span>
                    <img src="https://via.placeholder.com/40" class="topnav-avatar" alt="Avatar">
                </div>
            </nav>

            <!-- Main Content Area -->
            <main class="flex-1 p-5 md:p-8">
                @if ($errors->any())
                    <div class="alert-error">
                        <p class="font-bold mb-1">Terjadi Kesalahan!</p>
                        <ul class="list-disc ml-5 mt-1 space-y-0.5 text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert-success">
                        <span class="text-sm font-medium">{{ session('success') }}</span>
                        <button class="alert-close" onclick="this.parentElement.style.display='none'">&times;</button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert-error" style="display:flex;justify-content:space-between;align-items:center;">
                        <span class="text-sm font-medium">{{ session('error') }}</span>
                        <button class="alert-close" onclick="this.parentElement.style.display='none'">&times;</button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script>
        document.getElementById('mobile-menu-btn')?.addEventListener('click', () => {
            // Implement mobile sidebar toggle if needed
        });
    </script>
</body>
</html>