<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="input-group">
            <label for="name" class="input-label">Nama Lengkap</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                   class="input-field">
            @error('name')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <!-- Email -->
        <div class="input-group">
            <label for="email" class="input-label">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                   class="input-field">
            @error('email')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <!-- Password -->
        <div class="input-group">
            <label for="password" class="input-label">Password</label>
            <input id="password" type="password" name="password" required autocomplete="new-password"
                   class="input-field">
            @error('password')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="input-group">
            <label for="password_confirmation" class="input-label">Konfirmasi Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                   class="input-field">
            @error('password_confirmation')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn-login">
            <i class="fas fa-user-plus"></i> Daftar
        </button>

        <div class="auth-footer">
            <a href="{{ route('login') }}">Sudah punya akun? Masuk</a>
        </div>
    </form>
</x-guest-layout>