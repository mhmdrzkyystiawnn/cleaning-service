<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CleanPro') }} - Login</title>

    <!-- Fonts & Icons -->
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
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', 'Figtree', sans-serif;
            background: linear-gradient(135deg, var(--forest-dk) 0%, var(--forest) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 1rem;
        }

        .auth-container {
            width: 100%;
            max-width: 440px;
            margin: 0 auto;
        }

        .auth-card {
            background: white;
            border-radius: 32px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            padding: 2rem;
            border: 1px solid var(--linen);
        }

        .auth-logo {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .auth-logo a {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--forest);
            text-decoration: none;
        }

        .logo-icon {
            width: 44px;
            height: 44px;
            background: linear-gradient(135deg, var(--forest), var(--sage));
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--cream);
            font-size: 1.2rem;
        }

        .input-group {
            margin-bottom: 1.25rem;
        }

        .input-label {
            display: block;
            font-size: 0.8rem;
            font-weight: 700;
            color: var(--forest-dk);
            margin-bottom: 0.4rem;
        }

        .input-field {
            width: 100%;
            padding: 0.7rem 1rem;
            border: 1.5px solid var(--linen);
            border-radius: 14px;
            font-size: 0.9rem;
            transition: border-color 0.2s, box-shadow 0.2s;
            background: var(--cream);
            font-family: inherit;
        }

        .input-field:focus {
            outline: none;
            border-color: var(--sage);
            box-shadow: 0 0 0 3px rgba(153,173,122,0.2);
            background: white;
        }

        .error-message {
            color: #dc2626;
            font-size: 0.7rem;
            margin-top: 0.25rem;
            display: block;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin: 1rem 0;
        }

        .checkbox-group input {
            width: 1rem;
            height: 1rem;
            accent-color: var(--forest);
        }

        .checkbox-group label {
            font-size: 0.85rem;
            color: #374151;
        }

        .btn-login {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            width: 100%;
            background: var(--forest);
            color: white;
            font-weight: 800;
            padding: 0.75rem;
            border-radius: 14px;
            border: none;
            cursor: pointer;
            transition: background 0.2s, transform 0.15s;
            font-size: 0.9rem;
        }

        .btn-login:hover {
            background: var(--forest-dk);
            transform: translateY(-1px);
        }

        .auth-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1.5rem;
            font-size: 0.8rem;
        }

        .auth-footer a {
            color: var(--forest);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.18s;
        }

        .auth-footer a:hover {
            color: var(--forest-dk);
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-logo">
                <a href="{{ route('home') }}">
                    <span class="logo-icon"><i class="fas fa-leaf"></i></span>
                    CleanPro
                </a>
            </div>

            {{ $slot }}
        </div>
    </div>
</body>
</html>