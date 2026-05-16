<x-guest-layout>
    <div class="mb-6">
        <h1 class="text-xl font-bold" style="color:#e2e8f0;">Criar sua conta</h1>
        <p style="color:rgba(148,163,184,0.7);font-size:0.85rem;margin-top:4px;">Comece a gerenciar sua frota gratuitamente</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mb-4">
            <label for="name" class="auth-label">Nome completo</label>
            <div class="input-group">
                <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                    <circle cx="12" cy="7" r="4"/>
                </svg>
                <input id="name"
                       class="auth-input"
                       type="text"
                       name="name"
                       value="{{ old('name') }}"
                       required
                       autofocus
                       autocomplete="name"
                       placeholder="João da Silva">
            </div>
            @error('name')
                <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

        <!-- Company Name -->
        <div class="mb-4">
            <label for="company_name" class="auth-label">Nome da empresa</label>
            <div class="input-group">
                <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                    <polyline points="9 22 9 12 15 12 15 22"/>
                </svg>
                <input id="company_name"
                       class="auth-input"
                       type="text"
                       name="company_name"
                       value="{{ old('company_name') }}"
                       required
                       autocomplete="organization"
                       placeholder="Transportes Silva Ltda">
            </div>
            @error('company_name')
                <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

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
                       autocomplete="new-password"
                       placeholder="Mínimo 8 caracteres">
            </div>
            @error('password')
                <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-6">
            <label for="password_confirmation" class="auth-label">Confirmar senha</label>
            <div class="input-group">
                <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <input id="password_confirmation"
                       class="auth-input"
                       type="password"
                       name="password_confirmation"
                       required
                       autocomplete="new-password"
                       placeholder="Repita a senha">
            </div>
            @error('password_confirmation')
                <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit -->
        <button type="submit" class="auth-btn">
            Criar conta grátis
        </button>

        <div class="auth-divider"></div>

        <p class="text-center" style="color:rgba(148,163,184,0.6);font-size:0.85rem;">
            Já tem conta?
            <a href="{{ route('login') }}" class="auth-link font-semibold" style="color:#a5b4fc;">
                Fazer login
            </a>
        </p>
    </form>
</x-guest-layout>
