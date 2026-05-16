<x-guest-layout>
    <!-- Session Status -->
    @if (session('status'))
        <div class="session-status">
            {{ session('status') }}
        </div>
    @endif

    <div class="mb-6">
        <h1 class="text-xl font-bold" style="color:#e2e8f0;">Entrar na plataforma</h1>
        <p style="color:rgba(148,163,184,0.7);font-size:0.85rem;margin-top:4px;">Acesse o painel de controle da sua frota</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="auth-label">E-mail</label>
            <div class="input-group">
                <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                    <polyline points="22,6 12,13 2,6"/>
                </svg>
                <input id="email"
                       class="auth-input"
                       type="email"
                       name="email"
                       value="{{ old('email') }}"
                       required
                       autofocus
                       autocomplete="username"
                       placeholder="seu@email.com">
            </div>
            @error('email')
                <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="auth-label">Senha</label>
            <div class="input-group">
                <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                </svg>
                <input id="password"
                       class="auth-input"
                       type="password"
                       name="password"
                       required
                       autocomplete="current-password"
                       placeholder="••••••••">
            </div>
            @error('password')
                <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember + Forgot -->
        <div class="flex items-center justify-between mb-6 mt-2">
            <label class="remember-label">
                <input id="remember_me" type="checkbox" name="remember">
                Lembrar acesso
            </label>

            @if (Route::has('password.request'))
                <a class="auth-link" href="{{ route('password.request') }}">
                    Esqueci a senha
                </a>
            @endif
        </div>

        <!-- Submit -->
        <button type="submit" class="auth-btn">
            Entrar
        </button>

        <div class="auth-divider"></div>

        <p class="text-center" style="color:rgba(148,163,184,0.6);font-size:0.85rem;">
            Não tem conta?
            <a href="{{ route('register') }}" class="auth-link font-semibold" style="color:#a5b4fc;">
                Criar conta gratuita
            </a>
        </p>
    </form>
</x-guest-layout>
