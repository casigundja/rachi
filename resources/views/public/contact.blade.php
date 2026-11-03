<!DOCTYPE html>
<html lang="pt">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/toast.css">
    <script src="/toast.js"></script>
    <script src="/auth-session.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto ” Fale Connosco ” RACHI Soluções Inteligentes</title>
    <meta name="description" content="Entre em contacto com a RACHI. Conte-nos o seu desafio e receba a solução ideal em tecnologia, gráfica, formação e capital humano em Angola.">
    <x-public-footer unit="global" />
    </div>

    <!-- Script Implementation -->
    <script>
        function contactForm() {
            return {
                isSubmitting: false,
                formSent: new URLSearchParams(window.location.search).get('enviado') === '1',
                charCount: 0,
                formData: {
                    nome: '',
                    email: '',
                    telefone: '',
                    unidade: (function() {
                        const p = new URLSearchParams(window.location.search);
                        const val = p.get('unidade') || p.get('area');
                        const valid = ['RACHI Tec', 'RACHI Print', 'RACHI Academy', 'RACHI Human Capital'];
                        return valid.includes(val) ? val : 'RACHI Tec';
                    })(),
                    mensagem: ''
                },
                getPlaceholder() {
                    switch(this.formData.unidade) {
                        case 'RACHI Tec': return 'Descreva a necessidade em infraestrutura de TI, redes estruturadas, suporte ou servidores...';
                        case 'RACHI Print': return 'Indique os materiais gráficos, tiragens pretendidas, formatos ou brindes corporativos...';
                        case 'RACHI Academy': return 'Qual o programa executivo ou necessidade de formação corporativa da sua equipa?';
                        case 'RACHI Human Capital': return 'Descreva a necessidade em recrutamento especializado, consultoria de RH ou gestão...';
                        default: return 'Descreva sucintamente a sua necessidade corporativa ou pedido de cotação...';
                    }
                },
                async handleFormSubmit() {
                    this.isSubmitting = true;
                    try {
                        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                        const res = await fetch('/contacto', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': token || ''
                            },
                            body: JSON.stringify(this.formData)
                        });
                        const data = await res.json();
                        if (!res.ok || data.success === false) {
                            throw new Error(data.message || 'Erro ao enviar a mensagem.');
                        }
                        this.formSent = true;
                        if (typeof showToast === 'function') {
                            showToast(data.message || 'A sua mensagem foi registada com sucesso! A equipa entrará em contacto em breve.', 'Mensagem Enviada!', 'success', 4500);
                        }
                        this.formData.nome = '';
                        this.formData.email = '';
                        this.formData.telefone = '';
                        this.formData.unidade = 'RACHI Tec';
                        this.formData.mensagem = '';
                        this.charCount = 0;
                        this.$nextTick(() => { if (window.lucide) lucide.createIcons(); });
                    } catch (err) {
                        if (typeof showToast === 'function') {
                            showToast(err.message, 'Atenção', 'error', 4500);
                        } else {
                            alert(err.message);
                        }
                    } finally {
                        this.isSubmitting = false;
                    }
                }
            };
        }

        function rachiApp() {
            return {
                currentView: 'public',
                currentTab: 'contacto',
                mobileMenuOpen: false,
                solutionsOpen: false,
                customerTab: 'dashboard',
                currentUser: null,
                contactSubject: 'Orçamento de Projeto',
                toast: {
                    show: false,
                    title: '',
                    message: '',
                    type: 'success',
                    timer: null
                },
                init() {
                    window.showToast = (msg, title, type, dur) => this.showToast(msg, title, type, dur);
                    this.restoreUserSession();

                    this.$nextTick(() => {
                        if (window.lucide) lucide.createIcons();
                    });
                },
                async restoreUserSession() { this.currentUser = await window.RachiSession.session(); this.isLoggedIn = !!this.currentUser; },
                async logout() { await window.RachiSession.logout(); },
                copyText(text, label = 'Item') {
                    if (navigator.clipboard && navigator.clipboard.writeText) {
                        navigator.clipboard.writeText(text).then(() => {
                            this.showToast(`${label} copiado para a área de transferência: ${text}`, 'Copiado!', 'success', 2800);
                        }).catch(() => {
                            this.fallbackCopy(text, label);
                        });
                    } else {
                        this.fallbackCopy(text, label);
                    }
                },
                fallbackCopy(text, label) {
                    const el = document.createElement('textarea');
                    el.value = text;
                    document.body.appendChild(el);
                    el.select();
                    document.execCommand('copy');
                    document.body.removeChild(el);
                    this.showToast(`${label} copiado: ${text}`, 'Copiado!', 'success', 2800);
                },
                showToast(message, title = 'Notificação', type = 'success', duration = 6000) { return RachiToast.show(message, { title, type, duration }); },
                submitContactForm(e) {
                    const form = e.target;
                    this.showToast(
                        'A sua mensagem sobre "' + this.contactSubject + '" foi registada com sucesso! A equipa da RACHI entrará em contacto muito brevemente.',
                        'Mensagem Enviada!',
                        'success',
                        4500
                    );
                    form.reset();
                    this.contactSubject = 'Orçamento de Projeto';
                },
                goToHome() {
                    window.location.href = '/#home';
                },
                loginModal: false,
                cartDrawer: false,
                cart: [],
                get cartTotal() {
                    return this.cart.reduce((sum, item) => sum + item.price, 0);
                },
                loginAs(role) {
                    window.location.href = '/';
                }
            };
        }

        document.addEventListener('DOMContentLoaded', () => {
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });
    </script>

    <!-- Toast Notification (Auto-Dismiss) - Royal Blue & White Palette -->
    <div x-show="toast.show" 
         x-transition:enter="transition ease-out duration-300 transform" 
         x-transition:enter-start="opacity-0 translate-y-2 scale-95" 
         x-transition:enter-end="opacity-100 translate-y-0 scale-100" 
         x-transition:leave="transition ease-in duration-200 transform" 
         x-transition:leave-start="opacity-100 translate-y-0 scale-100" 
         x-transition:leave-end="opacity-0 translate-y-2 scale-95" 
         x-cloak 
         class="fixed bottom-6 right-6 z-50 max-w-md w-full bg-[#071326]/95 backdrop-blur-xl border border-blue-500/30 shadow-2xl rounded-2xl p-4 text-white">
        <div class="flex items-start gap-3">
            <div class="w-10 h-10 rounded-xl bg-blue-500/20 text-[#00a3e0] flex items-center justify-center flex-shrink-0">
                <i data-lucide="check-circle-2" class="w-6 h-6"></i>
            </div>
            <div class="flex-1 pr-2">
                <h4 class="text-sm font-bold text-white" x-text="toast.title"></h4>
                <p class="text-xs text-slate-300 mt-0.5 leading-relaxed" x-text="toast.message"></p>
            </div>
            <button @click="toast.show = false" class="text-slate-400 hover:text-white transition p-1">
                <i data-lucide="x" class="w-4 h-4"></i>
            </button>
        </div>
        <div class="w-full bg-white/10 h-1 rounded-full mt-3 overflow-hidden">
            <div class="bg-gradient-to-r from-[#0050f0] to-[#00a3e0] h-full w-full animate-[shrink_3.5s_linear_forwards]"></div>
        </div>
    </div>
<script src="/worker-public.js"></script>    @include('components.theme-toggle-fab')
</body>
</html>
