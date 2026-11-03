<!DOCTYPE html>
<html lang="pt-AO" data-theme="dark" class="scroll-smooth">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/toast.css">
    <script src="/toast.js"></script>
    <script src="/auth-session.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Planos RACHI Academy: matricule-se nos melhores cursos de tecnologia, IA e negócios em Angola</title>
    <meta name="description"
        content="Planos RACHI Academy com acesso a cursos práticos de tecnologia, IA, programação, dados, cibersegurança e liderança. Certificação reconhecida, mentorias e projetos reais.">
    <link rel="canonical" href="https://rachi.ao/academy">

    <x-public-footer unit="academy" />

    <!-- Lógica Alpine.js & Lucide -->
    <script>
        function rachiAcademyPlans() {
            return {
                billingCycle: 'biennial', // 'annual' ou 'biennial'
                activeFaq: 1,
                mobileMenuOpen: false,
                openCursos: false,
                activeMegaTab: 'carreiras',
                isLoggedIn: false,
                currentUser: null,
                userMenuOpen: false,

                async checkAuth() { this.currentUser = await window.RachiSession.session(); this.isLoggedIn = !!this.currentUser; },

                getUserInitials(name) {
                    if (!name) return 'AL';
                    const parts = name.trim().split(' ');
                    if (parts.length === 1) return parts[0].substring(0, 2).toUpperCase();
                    return (parts[0][0] + parts[parts.length - 1][0]).toUpperCase();
                },

                async logout() { await window.RachiSession.logout(); },

                init() {
                    this.checkAuth();




                    if (window.lucide) {
                        this.$nextTick(() => lucide.createIcons());
                    }
                }
            }
        }

        function rachiCatalogScroller() {
            return {
                isPaused: false,
                activeCategory: 'all',
                scrollInterval: null,
                init() {
                    this.$nextTick(() => {
                        this.startScrolling();
                    });
                },
                startScrolling() {
                    this.stopScrolling();
                    const track = this.$refs.scrollerTrack;
                    if (!track) return;
                    this.scrollInterval = setInterval(() => {
                        if (!this.isPaused && track) {
                            const half = track.scrollWidth / 2;
                            if (half > 0 && track.scrollLeft >= (half - 4)) {
                                track.scrollLeft -= half;
                            } else {
                                track.scrollLeft += 1;
                            }
                        }
                    }, 28);
                },
                stopScrolling() {
                    if (this.scrollInterval) {
                        clearInterval(this.scrollInterval);
                        this.scrollInterval = null;
                    }
                },
                pause() {
                    this.isPaused = true;
                },
                resume() {
                    this.isPaused = false;
                },
                scrollLeftBy(amount) {
                    const track = this.$refs.scrollerTrack;
                    if (track) {
                        track.scrollBy({ left: -amount, behavior: 'smooth' });
                    }
                },
                scrollRightBy(amount) {
                    const track = this.$refs.scrollerTrack;
                    if (track) {
                        track.scrollBy({ left: amount, behavior: 'smooth' });
                    }
                },
                setCategory(cat) {
                    this.activeCategory = cat;
                },
                matchesCategory(catName) {
                    if (this.activeCategory === 'all') return true;
                    if (!catName) return false;
                    const clean = catName.toLowerCase();
                    if (this.activeCategory === 'ti') {
                        return clean.includes('tecnologia') || clean.includes('ti') || clean.includes('ciber') || clean.includes('digital') || clean.includes('automação') || clean.includes('sistemas');
                    }
                    if (this.activeCategory === 'gestao') {
                        return clean.includes('gestão') || clean.includes('liderança') || clean.includes('vendas') || clean.includes('corporativa') || clean.includes('contabilidade') || clean.includes('negócios') || clean.includes('profissional');
                    }
                    return true;
                }
            };
        }

        document.addEventListener('DOMContentLoaded', function () {
            if (typeof lucide !== 'undefined') lucide.createIcons();
        });
    </script>



<script src="/worker-public.js"></script>    @include('components.theme-toggle-fab')
</body>

</html>
