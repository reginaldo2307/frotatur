<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FrotaTur - O Sistema Completo para Gestão de Frotas e Turismo</title>
    
    <meta name="description" content="Plataforma SaaS completa para gestão de frotas de turismo. Controle veículos, viagens, motoristas e financeiro em um só lugar.">
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700|outfit:500,600,700,800&display=swap" rel="stylesheet" />

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['Inter', 'sans-serif'],
                            heading: ['Outfit', 'sans-serif'],
                        },
                        colors: {
                            primary: {
                                50: '#f0f9ff',
                                100: '#e0f2fe',
                                500: '#0ea5e9',
                                600: '#0284c7',
                                700: '#0369a1',
                                900: '#0c4a6e',
                            }
                        }
                    }
                }
            }
        </script>
        <style type="text/tailwindcss">
            @layer utilities {
                .text-balance {
                    text-wrap: balance;
                }
            }
        </style>
    @endif
    <style>
        .gradient-text {
            background: linear-gradient(to right, #0ea5e9, #2563eb);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .hero-bg {
            background-image: radial-gradient(circle at top right, #e0f2fe 0%, transparent 40%),
                              radial-gradient(circle at bottom left, #e0f2fe 0%, transparent 40%);
        }
    </style>
</head>
<body class="font-sans antialiased text-slate-600 bg-white selection:bg-primary-500 selection:text-white overflow-x-hidden">

    <!-- Header -->
    <header class="fixed w-full top-0 z-50 bg-white/80 backdrop-blur-md border-b border-slate-100 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex-shrink-0 flex items-center gap-2">
                    <div class="w-10 h-10 bg-gradient-to-br from-primary-500 to-blue-600 rounded-xl flex items-center justify-center text-white font-heading font-bold text-xl shadow-lg shadow-primary-500/30">
                        FT
                    </div>
                    <span class="font-heading font-bold text-2xl text-slate-900 tracking-tight">Frota<span class="text-primary-600">Tur</span></span>
                </div>
                
                <nav class="hidden md:flex space-x-8">
                    <a href="#recursos" class="text-sm font-medium text-slate-600 hover:text-primary-600 transition-colors">Recursos</a>
                    <a href="#beneficios" class="text-sm font-medium text-slate-600 hover:text-primary-600 transition-colors">Benefícios</a>
                    <a href="#planos" class="text-sm font-medium text-slate-600 hover:text-primary-600 transition-colors">Planos</a>
                </nav>

                <div class="hidden md:flex items-center space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm font-semibold text-slate-900 hover:text-primary-600 transition-colors">Painel de Controle</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-slate-600 hover:text-primary-600 transition-colors">Entrar</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-semibold text-white bg-slate-900 rounded-lg hover:bg-slate-800 transition-all shadow-sm hover:shadow-md">
                                Teste Grátis
                            </a>
                        @endif
                    @endauth
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button class="text-slate-600 hover:text-slate-900 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden hero-bg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-4xl mx-auto">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary-50 border border-primary-100 text-primary-700 text-sm font-medium mb-8">
                    <span class="flex h-2 w-2 rounded-full bg-primary-500"></span>
                    O Sistema SaaS #1 para Turismo
                </div>
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-heading font-extrabold text-slate-900 tracking-tight mb-8 leading-tight text-balance">
                    Gestão Inteligente para sua <span class="gradient-text">Frota de Turismo</span>
                </h1>
                <p class="text-lg md:text-xl text-slate-600 mb-10 max-w-2xl mx-auto leading-relaxed text-balance">
                    Controle total sobre veículos, escalas de motoristas, roteiros de viagens e financeiro. Reduza custos, evite multas e aumente a lucratividade da sua empresa.
                </p>
                <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
                    <a href="{{ route('register') ?? '#' }}" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 text-base font-semibold text-white bg-primary-600 rounded-xl hover:bg-primary-700 transition-all shadow-lg shadow-primary-500/30 hover:-translate-y-0.5">
                        Comece seu Teste Grátis
                        <svg class="ml-2 -mr-1 w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                    <a href="#recursos" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 text-base font-semibold text-slate-700 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 transition-all hover:-translate-y-0.5">
                        Ver Recursos
                    </a>
                </div>
                <div class="mt-10 flex items-center justify-center gap-6 text-sm text-slate-500 font-medium">
                    <div class="flex items-center gap-2"><svg class="w-5 h-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Sem cartão de crédito</div>
                    <div class="flex items-center gap-2"><svg class="w-5 h-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Cancelamento grátis</div>
                    <div class="flex items-center gap-2"><svg class="w-5 h-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Suporte 24/7</div>
                </div>
            </div>
        </div>
        
        <!-- Dashboard Mockup Image Base -->
        <div class="mt-20 relative max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="rounded-2xl bg-slate-900/5 p-2 md:p-4 border border-slate-900/10 backdrop-blur-xl">
                <div class="rounded-xl overflow-hidden shadow-2xl border border-slate-200/50 bg-white aspect-[16/9] relative flex flex-col">
                    <div class="h-12 border-b border-slate-100 flex items-center px-4 gap-2 bg-slate-50/50">
                        <div class="flex gap-1.5">
                            <div class="w-3 h-3 rounded-full bg-red-400"></div>
                            <div class="w-3 h-3 rounded-full bg-amber-400"></div>
                            <div class="w-3 h-3 rounded-full bg-green-400"></div>
                        </div>
                        <div class="mx-auto bg-white border border-slate-200 rounded-md h-6 w-1/3 flex items-center justify-center text-[10px] text-slate-400 font-mono shadow-sm">frotatur.app/dashboard</div>
                    </div>
                    <div class="flex-1 bg-slate-50 flex">
                        <!-- Sidebar Mockup -->
                        <div class="w-48 border-r border-slate-200 bg-white hidden sm:block p-4 space-y-3">
                            <div class="h-4 w-24 bg-slate-200 rounded mb-6"></div>
                            <div class="h-8 w-full bg-primary-50 rounded border border-primary-100"></div>
                            <div class="h-8 w-full bg-slate-50 rounded"></div>
                            <div class="h-8 w-full bg-slate-50 rounded"></div>
                            <div class="h-8 w-full bg-slate-50 rounded"></div>
                        </div>
                        <!-- Content Mockup -->
                        <div class="flex-1 p-6 space-y-6">
                            <div class="flex justify-between items-center">
                                <div class="h-6 w-32 bg-slate-200 rounded"></div>
                                <div class="h-8 w-8 bg-slate-200 rounded-full"></div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                <div class="h-24 bg-white border border-slate-200 rounded-xl shadow-sm p-4"><div class="h-4 w-16 bg-slate-100 rounded mb-2"></div><div class="h-8 w-12 bg-slate-200 rounded"></div></div>
                                <div class="h-24 bg-white border border-slate-200 rounded-xl shadow-sm p-4"><div class="h-4 w-16 bg-slate-100 rounded mb-2"></div><div class="h-8 w-12 bg-slate-200 rounded"></div></div>
                                <div class="h-24 bg-white border border-slate-200 rounded-xl shadow-sm p-4"><div class="h-4 w-16 bg-slate-100 rounded mb-2"></div><div class="h-8 w-12 bg-slate-200 rounded"></div></div>
                                <div class="h-24 bg-white border border-slate-200 rounded-xl shadow-sm p-4"><div class="h-4 w-16 bg-slate-100 rounded mb-2"></div><div class="h-8 w-12 bg-slate-200 rounded"></div></div>
                            </div>
                            <div class="h-64 bg-white border border-slate-200 rounded-xl shadow-sm p-4 flex flex-col">
                                <div class="h-4 w-24 bg-slate-100 rounded mb-4"></div>
                                <div class="flex-1 border-b border-l border-slate-100 relative">
                                    <div class="absolute bottom-0 left-4 w-8 bg-primary-200 rounded-t h-1/3"></div>
                                    <div class="absolute bottom-0 left-16 w-8 bg-primary-400 rounded-t h-2/3"></div>
                                    <div class="absolute bottom-0 left-28 w-8 bg-primary-300 rounded-t h-1/2"></div>
                                    <div class="absolute bottom-0 left-40 w-8 bg-primary-500 rounded-t h-4/5"></div>
                                    <div class="absolute bottom-0 left-52 w-8 bg-primary-600 rounded-t h-full"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Logo Cloud -->
    <section class="py-10 border-y border-slate-100 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <p class="text-center text-sm font-medium text-slate-400 uppercase tracking-wider mb-6">Empresas que confiam na FrotaTur</p>
            <div class="flex flex-wrap justify-center gap-8 md:gap-16 opacity-50 grayscale hover:grayscale-0 transition-all duration-500">
                <div class="text-2xl font-heading font-bold text-slate-800">Turis<span class="text-primary-600">Max</span></div>
                <div class="text-2xl font-heading font-bold text-slate-800">Via<span class="text-primary-600">Sul</span> Transportes</div>
                <div class="text-2xl font-heading font-bold text-slate-800">Expresso<span class="text-primary-600">Tour</span></div>
                <div class="text-2xl font-heading font-bold text-slate-800">Líder<span class="text-primary-600">Frotas</span></div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="recursos" class="py-24 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-primary-600 font-semibold tracking-wide uppercase text-sm mb-3">Tudo em um só lugar</h2>
                <h3 class="text-3xl md:text-4xl font-heading font-bold text-slate-900 mb-6">Recursos Completos para sua Operação</h3>
                <p class="text-lg text-slate-600 text-balance">
                    Substitua planilhas confusas e sistemas desatualizados por uma plataforma moderna, rápida e fácil de usar.
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-slate-100 hover:shadow-lg transition-shadow">
                    <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center text-blue-600 mb-6">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                        </svg>
                    </div>
                    <h4 class="text-xl font-heading font-bold text-slate-900 mb-3">Gestão de Viagens</h4>
                    <p class="text-slate-600 leading-relaxed">
                        Crie roteiros, emita ordens de serviço (OS) automatizadas, controle passageiros e acompanhe o status de cada viagem em tempo real.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-slate-100 hover:shadow-lg transition-shadow">
                    <div class="w-12 h-12 bg-emerald-50 rounded-lg flex items-center justify-center text-emerald-600 mb-6">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
                        </svg>
                    </div>
                    <h4 class="text-xl font-heading font-bold text-slate-900 mb-3">Controle de Frota</h4>
                    <p class="text-slate-600 leading-relaxed">
                        Cadastro completo de veículos (Ônibus, Vans, Micro), controle de documentação com alertas de vencimento e histórico completo.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-slate-100 hover:shadow-lg transition-shadow">
                    <div class="w-12 h-12 bg-amber-50 rounded-lg flex items-center justify-center text-amber-600 mb-6">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h4 class="text-xl font-heading font-bold text-slate-900 mb-3">Manutenção Preventiva</h4>
                    <p class="text-slate-600 leading-relaxed">
                        Agende revisões, registre gastos com peças e oficinas, e evite que seus veículos fiquem parados de forma inesperada.
                    </p>
                </div>

                <!-- Feature 4 -->
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-slate-100 hover:shadow-lg transition-shadow">
                    <div class="w-12 h-12 bg-purple-50 rounded-lg flex items-center justify-center text-purple-600 mb-6">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h4 class="text-xl font-heading font-bold text-slate-900 mb-3">Gestão de Motoristas</h4>
                    <p class="text-slate-600 leading-relaxed">
                        Controle de CNHs, exames toxicológicos, cursos especializados (MOPP, Transporte de Passageiros) e gestão de escalas.
                    </p>
                </div>

                <!-- Feature 5 -->
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-slate-100 hover:shadow-lg transition-shadow">
                    <div class="w-12 h-12 bg-rose-50 rounded-lg flex items-center justify-center text-rose-600 mb-6">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h4 class="text-xl font-heading font-bold text-slate-900 mb-3">Financeiro e Contratos</h4>
                    <p class="text-slate-600 leading-relaxed">
                        Emissão de faturas, controle de contas a pagar e receber, contratos de locação e cálculo automático de rentabilidade por viagem.
                    </p>
                </div>

                <!-- Feature 6 -->
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-slate-100 hover:shadow-lg transition-shadow">
                    <div class="w-12 h-12 bg-indigo-50 rounded-lg flex items-center justify-center text-indigo-600 mb-6">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h4 class="text-xl font-heading font-bold text-slate-900 mb-3">Relatórios e Dashboards</h4>
                    <p class="text-slate-600 leading-relaxed">
                        Tenha visão clara do seu negócio. Relatórios de custos por km rodado, desempenho de veículos e fluxo de caixa em tempo real.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-20 bg-slate-900 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <svg class="h-full w-full" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="grid-pattern" width="40" height="40" patternUnits="userSpaceOnUse">
                        <path d="M0 40V0H40" fill="none" stroke="white" stroke-width="1"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#grid-pattern)"/>
            </svg>
        </div>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h2 class="text-3xl md:text-5xl font-heading font-bold text-white mb-6">Pronto para acelerar o crescimento da sua empresa?</h2>
            <p class="text-xl text-slate-300 mb-10 max-w-2xl mx-auto">
                Junte-se a dezenas de empresas que já transformaram a gestão de suas frotas com o FrotaTur.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('register') ?? '#' }}" class="inline-flex items-center justify-center px-8 py-4 text-base font-bold text-slate-900 bg-white rounded-xl hover:bg-slate-100 transition-all shadow-lg hover:-translate-y-0.5">
                    Criar Conta Gratuita
                </a>
                <a href="#" class="inline-flex items-center justify-center px-8 py-4 text-base font-bold text-white border border-slate-700 bg-slate-800 rounded-xl hover:bg-slate-700 transition-all hover:-translate-y-0.5">
                    Falar com Consultor
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white pt-16 pb-8 border-t border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <div class="col-span-1 md:col-span-1">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-8 h-8 bg-gradient-to-br from-primary-500 to-blue-600 rounded-lg flex items-center justify-center text-white font-heading font-bold text-sm">
                            FT
                        </div>
                        <span class="font-heading font-bold text-xl text-slate-900 tracking-tight">Frota<span class="text-primary-600">Tur</span></span>
                    </div>
                    <p class="text-sm text-slate-500 mb-6">
                        Plataforma inteligente para gestão de frotas focada no mercado de transporte turístico e fretamento.
                    </p>
                </div>
                <div>
                    <h4 class="font-semibold text-slate-900 mb-4">Produto</h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-sm text-slate-500 hover:text-primary-600">Recursos</a></li>
                        <li><a href="#" class="text-sm text-slate-500 hover:text-primary-600">Preços</a></li>
                        <li><a href="#" class="text-sm text-slate-500 hover:text-primary-600">Atualizações</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold text-slate-900 mb-4">Suporte</h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-sm text-slate-500 hover:text-primary-600">Central de Ajuda</a></li>
                        <li><a href="#" class="text-sm text-slate-500 hover:text-primary-600">Tutoriais em Vídeo</a></li>
                        <li><a href="#" class="text-sm text-slate-500 hover:text-primary-600">Contato</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold text-slate-900 mb-4">Legal</h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-sm text-slate-500 hover:text-primary-600">Termos de Uso</a></li>
                        <li><a href="#" class="text-sm text-slate-500 hover:text-primary-600">Política de Privacidade</a></li>
                    </ul>
                </div>
            </div>
            <div class="pt-8 border-t border-slate-100 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-sm text-slate-400">
                    &copy; {{ date('Y') }} FrotaTur. Todos os direitos reservados.
                </p>
                <div class="flex gap-4">
                    <a href="#" class="text-slate-400 hover:text-primary-600">
                        <span class="sr-only">Facebook</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"/></svg>
                    </a>
                    <a href="#" class="text-slate-400 hover:text-primary-600">
                        <span class="sr-only">Instagram</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
