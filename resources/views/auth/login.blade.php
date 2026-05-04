<x-guest-layout>
    <!-- Session Status -->
    @if (session('status'))
        <div class="mb-4 text-sm text-green-600">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div class="input-group">
            <label for="email" class="input-label">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                   class="input-field">
            @error('email')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <!-- Password -->
        <div class="input-group">
            <label for="password" class="input-label">Password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                   class="input-field">
            @error('password')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="checkbox-group">
            <input type="checkbox" name="remember" id="remember_me">
            <label for="remember_me">Ingat saya</label>
        </div>

        <button type="submit" class="btn-login">
            <i class="fas fa-key"></i> Masuk
        </button>

        <div class="auth-footer">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">Lupa password?</a>
            @endif
            <a href="{{ route('register') }}">Belum punya akun? Daftar</a>
        </div>
    </form>
</x-guest-layout>