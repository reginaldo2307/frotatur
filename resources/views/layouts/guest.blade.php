<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>FrotaTur — Gestão de Frotas</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            * { font-family: 'Inter', sans-serif; }

            .auth-bg {
                min-height: 100vh;
                background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 40%, #0c1445 70%, #0f172a 100%);
                position: relative;
                overflow: hidden;
            }

            .auth-bg::before {
                content: '';
                position: absolute;
                width: 600px;
                height: 600px;
                border-radius: 50%;
                background: radial-gradient(circle, rgba(99,102,241,0.15) 0%, transparent 70%);
                top: -200px;
                right: -150px;
                pointer-events: none;
            }

            .auth-bg::after {
                content: '';
                position: absolute;
                width: 400px;
                height: 400px;
                border-radius: 50%;
                background: radial-gradient(circle, rgba(139,92,246,0.12) 0%, transparent 70%);
                bottom: -100px;
                left: -100px;
                pointer-events: none;
            }

            .auth-card {
                background: rgba(255,255,255,0.04);
                backdrop-filter: blur(24px);
                -webkit-backdrop-filter: blur(24px);
                border: 1px solid rgba(255,255,255,0.1);
                border-radius: 24px;
                box-shadow:
                    0 32px 64px rgba(0,0,0,0.4),
                    0 0 0 1px rgba(255,255,255,0.05) inset;
            }

            .brand-logo-wrap {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 12px;
                margin-bottom: 8px;
            }

            .brand-icon {
                width: 48px;
                height: 48px;
                background: linear-gradient(135deg, #6366f1, #8b5cf6);
                border-radius: 14px;
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: 0 8px 24px rgba(99,102,241,0.4);
            }

            .brand-name {
                font-size: 2rem;
                font-weight: 800;
                background: linear-gradient(135deg, #e0e7ff, #c4b5fd);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                letter-spacing: -0.5px;
            }

            .brand-tagline {
                color: rgba(196,181,253,0.7);
                font-size: 0.8rem;
                font-weight: 500;
                letter-spacing: 0.15em;
                text-transform: uppercase;
            }

            /* Input styling */
            .auth-input {
                width: 100%;
                background: rgba(255,255,255,0.06) !important;
                border: 1px solid rgba(255,255,255,0.12) !important;
                border-radius: 12px !important;
                color: #e2e8f0 !important;
                padding: 12px 16px !important;
                font-size: 0.9rem !important;
                transition: all 0.2s ease !important;
                outline: none !important;
            }

            .auth-input::placeholder {
                color: rgba(148,163,184,0.5) !important;
            }

            .auth-input:focus {
                border-color: rgba(99,102,241,0.6) !important;
                background: rgba(99,102,241,0.08) !important;
                box-shadow: 0 0 0 3px rgba(99,102,241,0.15) !important;
            }

            .auth-label {
                display: block;
                color: rgba(196,181,253,0.9);
                font-size: 0.82rem;
                font-weight: 500;
                margin-bottom: 6px;
                letter-spacing: 0.02em;
            }

            .auth-btn {
                width: 100%;
                background: linear-gradient(135deg, #6366f1, #8b5cf6) !important;
                color: white !important;
                border: none !important;
                border-radius: 12px !important;
                padding: 13px 24px !important;
                font-size: 0.9rem !important;
                font-weight: 600 !important;
                cursor: pointer !important;
                transition: all 0.25s ease !important;
                letter-spacing: 0.02em !important;
                box-shadow: 0 8px 24px rgba(99,102,241,0.35) !important;
            }

            .auth-btn:hover {
                transform: translateY(-1px) !important;
                box-shadow: 0 12px 32px rgba(99,102,241,0.5) !important;
                background: linear-gradient(135deg, #4f46e5, #7c3aed) !important;
            }

            .auth-btn:active {
                transform: translateY(0) !important;
            }

            .auth-link {
                color: #a5b4fc;
                font-size: 0.85rem;
                text-decoration: none;
                transition: color 0.2s;
            }
            .auth-link:hover {
                color: #c4b5fd;
                text-decoration: underline;
            }

            .auth-divider {
                height: 1px;
                background: rgba(255,255,255,0.07);
                margin: 20px 0;
            }

            .auth-error {
                color: #fca5a5;
                font-size: 0.8rem;
                margin-top: 4px;
            }

            .session-status {
                background: rgba(16,185,129,0.15);
                border: 1px solid rgba(16,185,129,0.3);
                border-radius: 10px;
                color: #6ee7b7;
                padding: 10px 14px;
                font-size: 0.85rem;
                margin-bottom: 16px;
            }

            .remember-label {
                display: flex;
                align-items: center;
                gap: 8px;
                color: rgba(148,163,184,0.9);
                font-size: 0.85rem;
                cursor: pointer;
            }

            .remember-label input[type="checkbox"] {
                width: 16px;
                height: 16px;
                accent-color: #6366f1;
                border-radius: 4px;
            }

            /* Floating particles */
            .particle {
                position: absolute;
                border-radius: 50%;
                opacity: 0.4;
                animation: float linear infinite;
                pointer-events: none;
            }

            @keyframes float {
                0% { transform: translateY(100vh) rotate(0deg); opacity: 0; }
                10% { opacity: 0.4; }
                90% { opacity: 0.4; }
                100% { transform: translateY(-100px) rotate(720deg); opacity: 0; }
            }

            /* Input group with icon */
            .input-group {
                position: relative;
            }
            .input-icon {
                position: absolute;
                left: 14px;
                top: 50%;
                transform: translateY(-50%);
                color: rgba(148,163,184,0.5);
                pointer-events: none;
                width: 16px;
                height: 16px;
            }
            .input-group .auth-input {
                padding-left: 42px !important;
            }

            /* Stats bar below form */
            .trust-bar {
                display: flex;
                gap: 24px;
                justify-content: center;
                margin-top: 28px;
            }
            .trust-item {
                text-align: center;
            }
            .trust-number {
                font-size: 1.1rem;
                font-weight: 700;
                color: #a5b4fc;
            }
            .trust-label {
                font-size: 0.7rem;
                color: rgba(148,163,184,0.6);
                text-transform: uppercase;
                letter-spacing: 0.1em;
            }
        </style>
    </head>
    <body>
        <div class="auth-bg flex flex-col items-center justify-center px-4 py-12 relative">

            <!-- Floating particles -->
            <div class="particle" style="width:4px;height:4px;background:#6366f1;left:10%;animation-duration:12s;animation-delay:0s;"></div>
            <div class="particle" style="width:3px;height:3px;background:#8b5cf6;left:25%;animation-duration:9s;animation-delay:2s;"></div>
            <div class="particle" style="width:5px;height:5px;background:#4f46e5;left:60%;animation-duration:15s;animation-delay:4s;"></div>
            <div class="particle" style="width:3px;height:3px;background:#7c3aed;left:80%;animation-duration:11s;animation-delay:1s;"></div>
            <div class="particle" style="width:4px;height:4px;background:#6366f1;left:45%;animation-duration:13s;animation-delay:6s;"></div>

            <!-- Brand Header -->
            <div class="text-center mb-8">
                <a href="/" class="inline-block">
                    <div class="brand-logo-wrap">
                        <div class="brand-icon">
                            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 17H23M3 17V9L7 4H17L21 9V17M7 4V9H17V4M9 17V13H15V17" stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                <circle cx="6" cy="19.5" r="1.5" fill="white"/>
                                <circle cx="18" cy="19.5" r="1.5" fill="white"/>
                            </svg>
                        </div>
                        <span class="brand-name">FrotaTur</span>
                    </div>
                    <p class="brand-tagline">Gestão Inteligente de Frotas</p>
                </a>
            </div>

            <!-- Card -->
            <div class="auth-card w-full max-w-md p-8">
                {{ $slot }}
            </div>

            <!-- Trust bar -->
            <div class="trust-bar">
                <div class="trust-item">
                    <div class="trust-number">500+</div>
                    <div class="trust-label">Veículos</div>
                </div>
                <div class="trust-item">
                    <div class="trust-number">99.9%</div>
                    <div class="trust-label">Uptime</div>
                </div>
                <div class="trust-item">
                    <div class="trust-number">100%</div>
                    <div class="trust-label">Seguro</div>
                </div>
            </div>

            <p class="text-center mt-6" style="color:rgba(148,163,184,0.4);font-size:0.75rem;">
                © {{ date('Y') }} FrotaTur. Todos os direitos reservados.
            </p>
        </div>
    </body>
</html>
