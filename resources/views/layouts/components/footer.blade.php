
<!-- Footer -->
<footer class="mt-5 footer-bottom">
    {{-- Informações institucionais --}}
    <div class="bg-linear-to-b from-white via-slate-50 to-emerald-50">
        <div class="mx-auto grid w-full max-w-screen-2xl gap-8 px-6 py-10 md:grid-cols-[minmax(0,1fr)_auto] md:items-center md:gap-6 lg:gap-12 lg:px-12">
            <div class="flex min-w-0 flex-col items-center gap-4 text-center md:flex-row md:text-left">
                <a href="https://ufape.edu.br/" target="_blank" rel="noopener noreferrer" aria-label="Acessar o site da UFAPE" class="shrink-0 transition-opacity hover:opacity-80">
                    <img src="{{ asset('img/logo_ufape_principal.png') }}" alt="Universidade Federal do Agreste de Pernambuco" class="h-20 w-auto object-contain md:h-16 lg:h-20">
                </a>
                <div class="min-w-0 space-y-2">
                    <h2 class="text-base font-bold tracking-tight text-slate-900 lg:text-lg">LAPA <span class="font-normal text-slate-400">|</span> Laboratório de Anatomia e Patologia Animal</h2>
                    <address class="flex items-start justify-center gap-2 text-sm leading-6 not-italic text-slate-600 md:justify-start">
                        <i class="fa-solid fa-location-dot mt-1 text-emerald-700" aria-hidden="true"></i>
                        <span>Avenida Bom Pastor, s/n.º - Bairro Boa Vista<br>CEP: 55292-270 - Garanhuns - PE</span>
                    </address>
                </div>
            </div>
            {{-- Informações de contato --}}
            @if ($contato)
                <div class="flex min-w-0 flex-col items-center gap-4 text-sm md:items-start">
                    @if ($contato->email)
                        <a href="mailto:{{ $contato->email }}" class="flex max-w-full items-center gap-3 text-slate-600 transition-colors hover:text-emerald-800">
                            <i class="fa-solid fa-envelope w-4 shrink-0 text-center text-emerald-700" aria-hidden="true"></i>
                            <span class="break-all">{{ $contato->email }}</span>
                        </a>
                    @endif
                    @if ($contato->telefone)
                        <a href="tel:{{ preg_replace('/[^\d+]/', '', $contato->telefone) }}" class="flex items-center gap-3 text-slate-600 transition-colors hover:text-emerald-800">
                            <i class="fa-solid fa-phone w-4 shrink-0 text-center text-emerald-700" aria-hidden="true"></i>
                            <span>{{ $contato->telefone }}</span>
                        </a>
                    @endif
                    {{-- Redes sociais --}}
                    @if ($contato->facebook || $contato->twitter || $contato->instagram)
                        <div class="flex items-center gap-3">
                            @if ($contato->facebook)
                                <a href="{{ $contato->facebook }}" target="_blank" rel="noopener noreferrer" aria-label="Facebook do LAPA" class="flex h-9 w-9 items-center justify-center rounded-lg border border-emerald-200 bg-white/70 text-emerald-800 transition-colors hover:border-emerald-700 hover:bg-emerald-800 hover:text-white">
                                    <i class="fa-brands fa-facebook-f text-sm" aria-hidden="true"></i>
                                </a>
                            @endif
                            @if ($contato->twitter)
                                <a href="{{ $contato->twitter }}" target="_blank" rel="noopener noreferrer" aria-label="Twitter do LAPA" class="flex h-9 w-9 items-center justify-center rounded-lg border border-emerald-200 bg-white/70 text-emerald-800 transition-colors hover:border-emerald-700 hover:bg-emerald-800 hover:text-white">
                                    <i class="fa-brands fa-twitter text-sm" aria-hidden="true"></i>
                                </a>
                            @endif
                            @if ($contato->instagram)
                                <a href="{{ $contato->instagram }}" target="_blank" rel="noopener noreferrer" aria-label="Instagram do LAPA" class="flex h-9 w-9 items-center justify-center rounded-lg border border-emerald-200 bg-white/70 text-emerald-800 transition-colors hover:border-emerald-700 hover:bg-emerald-800 hover:text-white">
                                    <i class="fa-brands fa-instagram text-base" aria-hidden="true"></i>
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>
    {{-- Navegação e informações do LAPA --}}
    <div class="relative bg-linear-to-b from-emerald-800 from-0% via-emerald-900 via-81% to-emerald-950 to-100% text-white">
        <div class="mx-auto grid w-full max-w-screen-2xl grid-cols-1 px-6 py-4 sm:grid-cols-2 sm:gap-x-8 sm:gap-y-2 sm:py-8 lg:grid-cols-4 lg:gap-x-0 lg:px-12 lg:py-10">
            {{-- Atlas Interativo --}}
            <a href="{{ route('atlas.index') }}" class="group flex flex-col items-center border-b border-white/15 px-4 py-6 text-center sm:border-b-0 lg:items-start lg:border-r lg:pr-8 lg:pl-0 lg:py-0 lg:text-left">
                <svg class="mb-2 h-9 w-9 text-emerald-300" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.5C9.5 4.8 6.5 4.5 3 5v13c3.5-.5 6.5-.2 9 1.5 2.5-1.7 5.5-2 9-1.5V5c-3.5-.5-6.5-.2-9 1.5Zm0 0v13" />
                </svg>
                <h3 class="text-base font-semibold">Atlas Interativo</h3>
                <p class="mt-2 max-w-52 flex-1 text-sm leading-6 text-emerald-100/80">Navegue por sistemas, áreas e conteúdos anatômicos.</p>
                <span class="mt-3 inline-flex items-center gap-2 text-sm font-semibold text-emerald-300 transition-colors group-hover:text-white">Acessar <i class="fa-solid fa-chevron-right text-[10px] transition-transform group-hover:translate-x-1" aria-hidden="true"></i></span>
            </a>
            {{-- Anatomia 3D --}}
            <a href="{{ route('modelos-3d.index') }}" class="group flex flex-col items-center border-b border-white/15 px-4 py-6 text-center sm:border-b-0 lg:items-start lg:border-r lg:px-8 lg:py-0 lg:text-left">
                <svg class="mb-2 h-9 w-9 text-emerald-300" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m12 2 9 5-9 5-9-5 9-5Zm-9 5v10l9 5 9-5V7M12 12v10" />
                </svg>
                <h3 class="text-base font-semibold">Anatomia 3D</h3>
                <p class="mt-2 max-w-52 flex-1 text-sm leading-6 text-emerald-100/80">Explore modelos anatômicos tridimensionais.</p>
                <span class="mt-3 inline-flex items-center gap-2 text-sm font-semibold text-emerald-300 transition-colors group-hover:text-white">Acessar <i class="fa-solid fa-chevron-right text-[10px] transition-transform group-hover:translate-x-1" aria-hidden="true"></i></span>
            </a>
            {{-- Sobre o LAPA --}}
            <a href="#" class="group flex flex-col items-center border-b border-white/15 px-4 py-6 text-center sm:border-b-0 lg:items-start lg:border-r lg:px-8 lg:py-0 lg:text-left">
                <svg class="mb-2 h-9 w-9 text-emerald-300" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                    <circle cx="12" cy="12" r="9" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 11v5m0-8h.01" />
                </svg>
                <h3 class="text-base font-semibold">Sobre o LAPA</h3>
                <p class="mt-2 max-w-52 flex-1 text-sm leading-6 text-emerald-100/80">Conheça o laboratório, suas atividades e colaboradores.</p>
                <span class="mt-3 inline-flex items-center gap-2 text-sm font-semibold text-emerald-300 transition-colors group-hover:text-white">Acessar <i class="fa-solid fa-chevron-right text-[10px] transition-transform group-hover:translate-x-1" aria-hidden="true"></i></span>
            </a>
            {{-- Acesso Interno --}}
            <a href="{{ auth()->check() ? route('home') : route('login') }}" class="group flex flex-col items-center px-4 py-6 text-center lg:items-start lg:pr-0 lg:pl-8 lg:py-0 lg:text-left">
                <div class="mb-2 flex h-9 w-9 items-center justify-center">
                    <i class="fa-solid fa-right-to-bracket text-2xl text-emerald-300" aria-hidden="true"></i>
                </div>
                <h3 class="text-base font-semibold">Acesso Interno</h3>
                <p class="mt-2 max-w-52 flex-1 text-sm leading-6 text-emerald-100/80">
                    @auth
                        Acesse sua área e gerencie as atividades do laboratório.
                    @else
                        Entre no sistema para acessar as ferramentas de gestão.
                    @endauth
                </p>
                <span class="mt-3 inline-flex items-center gap-2 text-sm font-semibold text-emerald-300 transition-colors group-hover:text-white">
                    @auth
                        Ir para o painel
                    @else
                        Entrar
                    @endauth
                    <i class="fa-solid fa-chevron-right text-[10px] transition-transform group-hover:translate-x-1" aria-hidden="true"></i>
                </span>
            </a>
        </div>
        {{-- Faixa inferior --}}
        <div class="border-t border-white/15 bg-black/10">
            <div class="mx-auto flex w-full max-w-screen-2xl flex-col items-center justify-between gap-5 px-6 py-6 text-center lg:flex-row lg:px-12 lg:text-left">
                <p class="text-xs text-emerald-100/75">© {{ date('Y') }} LAPA. Todos os direitos reservados.</p>
                <nav aria-label="Links legais" class="flex flex-wrap items-center justify-center gap-x-5 gap-y-3 text-xs text-emerald-100/80">
                    <a href="#" class="transition-colors hover:text-white">Termos de Uso</a>
                    <span class="hidden text-white/25 sm:inline" aria-hidden="true">|</span>
                    <a href="#" class="transition-colors hover:text-white">Política de Privacidade</a>
                    <span class="hidden text-white/25 sm:inline" aria-hidden="true">|</span>
                    <a href="#conteudo-principal" class="transition-colors hover:text-white">Acessibilidade</a>
                </nav>
            </div>
        </div>
    </div>
</footer>


<style>
    .footer-bottom {
        animation: fadeIn 1s ease forwards;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
