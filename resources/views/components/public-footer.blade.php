@props([
    'unit' => 'global',
    'title' => null,
    'description' => null,
    'supportTitle' => null,
    'supportText' => null,
    'supportWhatsApp' => '+244 923 000 001',
    'supportWhatsAppUrl' => 'https://wa.me/244923000001',
    'supportEmail' => null,
    'supportHours' => 'Segunda a Sexta, 08h às 17h',
    'copyright' => null,
])

@php
    $configs = [
        'global' => [
            'title' => 'RACHI — Soluções Inteligentes',
            'desc' => 'Ecossistema integrado de soluções corporativas em Angola: tecnologia, produção gráfica, formação profissional e capital humano.',
            'support_title' => 'Apoio ao Cliente',
            'support_text' => 'Suporte Técnico WhatsApp',
            'email' => 'geral@rachi.ao',
            'copyright' => '© 2026 RACHI — Soluções Inteligentes. Todos os direitos reservados.',
        ],
        'academy' => [
            'title' => 'RACHI Academy',
            'desc' => 'Formação executiva, tecnologia, inteligência artificial e programas corporativos para profissionais e empresas em Angola.',
            'support_title' => 'Apoio ao Aluno & Matrículas',
            'support_text' => 'Secretaria Académica WhatsApp',
            'email' => 'academy@rachi.ao',
            'copyright' => '© 2026 RACHI Academy. Todos os direitos reservados.',
        ],
        'store' => [
            'title' => 'Loja RACHI Tec',
            'desc' => 'Canal oficial de suprimentos corporativos, equipamentos de informática, cabos, redes e tecnologia da RACHI em Angola.',
            'support_title' => 'Apoio ao Cliente & Vendas',
            'support_text' => 'Atendimento Comercial WhatsApp',
            'email' => 'loja@rachi.ao',
            'copyright' => '© 2026 RACHI Tec — Loja Corporativa Oficial. Todos os direitos reservados.',
        ],
        'tec' => [
            'title' => 'RACHI Tec',
            'desc' => 'Soluções corporativas completas em tecnologia, infraestrutura de redes, cloud, cibersegurança e assistência técnica especializada.',
            'support_title' => 'Apoio Técnico & Suporte',
            'support_text' => 'Suporte Técnico TI WhatsApp',
            'email' => 'tec@rachi.ao',
            'copyright' => '© 2026 RACHI Tec. Todos os direitos reservados.',
        ],
        'capital' => [
            'title' => 'RACHI Human Capital',
            'desc' => 'Serviços empresariais, recursos humanos, contabilidade, regularização documental e consultoria executiva em Angola.',
            'support_title' => 'Apoio & Consultoria',
            'support_text' => 'Falar com Consultor WhatsApp',
            'email' => 'capital@rachi.ao',
            'copyright' => '© 2026 RACHI Human Capital. Todos os direitos reservados.',
        ],
        'print' => [
            'title' => 'RACHI Print',
            'desc' => 'Produção gráfica de alta definição, brindes corporativos, sinalética de grande formato e comunicação visual em Angola.',
            'support_title' => 'Apoio ao Cliente & Balcão',
            'support_text' => 'Orçamentos & Balcão WhatsApp',
            'email' => 'print@rachi.ao',
            'copyright' => '© 2026 RACHI Print. Todos os direitos reservados.',
        ],
    ];

    $cfg = $configs[$unit] ?? $configs['global'];
    $finalTitle = $title ?? $cfg['title'];
    $finalDesc = $description ?? $cfg['desc'];
    $finalSupportTitle = $supportTitle ?? $cfg['support_title'];
    $finalSupportText = $supportText ?? $cfg['support_text'];
    $finalEmail = $supportEmail ?? $cfg['email'];
    $finalCopyright = $copyright ?? $cfg['copyright'];
@endphp

<!-- ============================================================== -->
<!-- FOOTER PADRONIZADO RACHI (MODELO LIMPO: DESKTOP & MOBILE)       -->
<!-- ============================================================== -->
<footer class="bg-slate-100 dark:bg-[#071326] text-slate-700 dark:text-slate-300 pt-10 sm:pt-14 pb-28 sm:pb-12 border-t border-slate-200 dark:border-white/10 transition-colors duration-300 mt-16 sm:mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- 1. BLOCO SUPERIOR: IDENTIDADE DA MARCA & APOIO AO CLIENTE -->
        <div class="space-y-4">
            <div>
                <div class="flex items-center gap-3">
                    <img src="/images/logo-rachi.png" alt="RACHI" class="h-8 sm:h-9 w-auto object-contain dark:hidden" onerror="this.onerror=null; this.src='/images/logo-rachi-dark.png'">
                    <img src="/images/logo-rachi-light.png" alt="RACHI" class="h-8 sm:h-9 w-auto object-contain hidden dark:block" onerror="this.onerror=null; this.src='/images/logo-rachi-light.png'">
                    <h3 class="font-bold text-base sm:text-lg text-slate-900 dark:text-white tracking-tight">
                        {{ $finalTitle }}
                    </h3>
                </div>
                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 mt-2 max-w-2xl leading-relaxed">
                    {{ $finalDesc }}
                </p>
            </div>

            <div class="pt-1">
                <h4 class="font-bold text-xs sm:text-sm text-slate-900 dark:text-white">
                    {{ $finalSupportTitle }}
                </h4>
                <div class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 mt-1.5 flex flex-wrap items-center gap-x-4 gap-y-1.5">
                    <a href="{{ $supportWhatsAppUrl }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 dark:hover:text-emerald-300 font-semibold transition-colors">
                        <svg class="w-4 h-4 shrink-0 fill-current" viewBox="0 0 24 24">
                            <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.275.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.045.072.045.419-.099.824zm-3.396-9.416c-4.284 0-7.766 3.481-7.766 7.766 0 1.371.357 2.658 1.018 3.782l-1.082 3.95 4.053-1.063c1.076.598 2.316.931 3.777.931 4.284 0 7.766-3.482 7.766-7.766 0-4.284-3.482-7.766-7.766-7.766z"/>
                        </svg>
                        <span>{{ $finalSupportText }}</span>
                    </a>
                    <span class="text-slate-400 dark:text-slate-600 hidden sm:inline">•</span>
                    <span class="text-slate-500 dark:text-slate-400">{{ $supportHours }}</span>
                </div>
            </div>
        </div>

        <!-- DIVISÓRIA SUTIL -->
        <div class="border-t border-slate-200/80 dark:border-white/10 my-6"></div>

        <!-- 2. BLOCO MÉDIO: SEDE & CONTACTOS | FORMAS DE PAGAMENTO | NAVEGAÇÃO -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-7 sm:gap-8">
            
            <!-- Sede & Contactos -->
            <div class="space-y-3">
                <h4 class="font-bold text-xs sm:text-sm text-slate-900 dark:text-white">
                    Sede &amp; Contactos
                </h4>
                <div class="space-y-2.5 text-xs sm:text-sm text-slate-600 dark:text-slate-400">
                    <p class="flex items-start gap-2.5">
                        <svg class="w-4 h-4 text-amber-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>Rua Ndunduma, Miramar – Luanda, Angola (Por detrás do BFA)</span>
                    </p>
                    <p class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 text-amber-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <span>+244 972 888 585 / 923 000 001</span>
                    </p>
                    <p class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 text-amber-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <span>{{ $finalEmail }}</span>
                    </p>
                </div>
            </div>

            <!-- Formas de Pagamento -->
            <div class="space-y-3">
                <h4 class="font-bold text-xs sm:text-sm text-slate-900 dark:text-white">
                    Formas de Pagamento
                </h4>
                <div class="space-y-2.5 text-xs sm:text-sm text-slate-600 dark:text-slate-400">
                    <p class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 text-amber-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                        </svg>
                        <span>Multicaixa Express / TPA</span>
                    </p>
                    <p class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 text-amber-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"/>
                        </svg>
                        <span>Transferência Bancária (IBAN)</span>
                    </p>
                    <p class="flex items-center gap-2.5 text-xs text-slate-500 dark:text-slate-400">
                        <svg class="w-4 h-4 text-amber-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>Facturação a 30 dias (Empresas)</span>
                    </p>
                </div>
            </div>

            <!-- Coluna 3: Unidades RACHI / Departamentos -->
            <div class="space-y-3">
                @if($unit === 'store')
                    <h4 class="font-bold text-xs sm:text-sm text-slate-900 dark:text-white">Departamentos</h4>
                    <ul class="space-y-2 text-xs sm:text-sm text-slate-600 dark:text-slate-400">
                        <li><a href="/loja#catalogo" class="hover:text-amber-500 dark:hover:text-amber-400 transition">Laptops &amp; Computadores</a></li>
                        <li><a href="/loja#catalogo" class="hover:text-amber-500 dark:hover:text-amber-400 transition">Cabos &amp; Redes</a></li>
                        <li><a href="/loja#catalogo" class="hover:text-amber-500 dark:hover:text-amber-400 transition">Smartwatches &amp; TV Box</a></li>
                        <li><a href="/loja#catalogo" class="hover:text-amber-500 dark:hover:text-amber-400 transition">Áudio &amp; Consumíveis</a></li>
                    </ul>
                @elseif($unit === 'academy')
                    <h4 class="font-bold text-xs sm:text-sm text-slate-900 dark:text-white">RACHI Academy</h4>
                    <ul class="space-y-2 text-xs sm:text-sm text-slate-600 dark:text-slate-400">
                        <li><a href="/academy#cursos" class="hover:text-blue-500 dark:hover:text-sky-400 transition">Catálogo de Cursos</a></li>
                        <li><a href="/aluno-dashboard" class="hover:text-blue-500 dark:hover:text-sky-400 transition">Área do Aluno</a></li>
                        <li><a href="/academy#modalidades" class="hover:text-blue-500 dark:hover:text-sky-400 transition">Modalidades &amp; Preços</a></li>
                        <li><a href="/contacto" class="hover:text-blue-500 dark:hover:text-sky-400 transition">Matrículas &amp; Contactos</a></li>
                    </ul>
                @else
                    <h4 class="font-bold text-xs sm:text-sm text-slate-900 dark:text-white">Soluções RACHI</h4>
                    <ul class="space-y-2 text-xs sm:text-sm text-slate-600 dark:text-slate-400">
                        <li><a href="/capital" class="hover:text-emerald-500 dark:hover:text-emerald-400 transition">RACHI Human Capital</a></li>
                        <li><a href="/academy" class="hover:text-indigo-500 dark:hover:text-indigo-400 transition">RACHI Academy</a></li>
                        <li><a href="/tec" class="hover:text-sky-500 dark:hover:text-sky-400 transition">RACHI Tec</a></li>
                        <li><a href="/print" class="hover:text-amber-500 dark:hover:text-amber-400 transition">RACHI Print</a></li>
                    </ul>
                @endif
            </div>

            <!-- Coluna 4: Institucional & Legal -->
            <div class="space-y-3">
                <h4 class="font-bold text-xs sm:text-sm text-slate-900 dark:text-white">Institucional &amp; Legal</h4>
                <ul class="space-y-2 text-xs sm:text-sm text-slate-600 dark:text-slate-400">
                    <li><a href="/privacidade" class="hover:text-slate-900 dark:hover:text-white transition">Política de Privacidade</a></li>
                    <li><a href="/termos" class="hover:text-slate-900 dark:hover:text-white transition">Termos &amp; Condições</a></li>
                    <li><a href="/reclamacoes-e-denuncia" class="hover:text-slate-900 dark:hover:text-white transition font-medium">Reclamações e Denúncia</a></li>
                    <li><a href="/loja" class="hover:text-slate-900 dark:hover:text-white transition">Loja Corporativa</a></li>
                    <li><a href="/contacto" class="hover:text-slate-900 dark:hover:text-white transition">Fale Connosco</a></li>
                </ul>
            </div>

        </div>

        <!-- DIVISÓRIA SUTIL -->
        <div class="border-t border-slate-200/80 dark:border-white/10 my-6"></div>

        <!-- 3. BLOCO INFERIOR: COPYRIGHT CENTRADO & SELETOR DE IDIOMAS -->
        <div class="flex flex-col items-center justify-center text-center gap-2 text-xs text-slate-500 dark:text-slate-400">
            <p>{{ $finalCopyright }}</p>
            <div class="flex items-center justify-center gap-3 text-xs pt-1">
                <button type="button" onclick="setRachiLanguage('pt')" data-rachi-lang="pt" class="cursor-pointer font-bold text-amber-500 dark:text-amber-400 hover:opacity-100 transition" title="Português">PT</button>
                <span class="text-slate-400 opacity-60">|</span>
                <button type="button" onclick="setRachiLanguage('en')" data-rachi-lang="en" class="cursor-pointer opacity-70 hover:opacity-100 hover:text-amber-500 dark:hover:text-amber-400 transition" title="English">EN</button>
                <span class="text-slate-400 opacity-60">|</span>
                <button type="button" onclick="setRachiLanguage('zh-CN')" data-rachi-lang="zh-CN" class="cursor-pointer opacity-70 hover:opacity-100 hover:text-amber-500 dark:hover:text-amber-400 transition" title="中文 (Mandarim)">中文</button>
            </div>
        </div>

    </div>
</footer>
