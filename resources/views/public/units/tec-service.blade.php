<!DOCTYPE html>
<html lang="pt" class="scroll-smooth">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/toast.css">
    <script src="/toast.js"></script>
    <script src="/auth-session.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $service['title'] }} — RACHI Tec (Sistemas & TI)</title>
    <meta name="description" content="{{ $service['short_desc'] }}">

    <x-public-footer unit="tec" />

    <!-- Inicialização Lucide Icons -->
    <script>
        
        function rachiServicePage() {
            return {
                mobileMenuOpen: false,
                openSol: false,
                init() {
                    const handleScroll = () => {
                        const nav = document.getElementById('navbar');
                        if (nav) {
                            if (window.scrollY > 30) {
                                nav.classList.add('header-scrolled');
                            } else {
                                nav.classList.remove('header-scrolled');
                            }
                        }
                    };
                    window.addEventListener('scroll', handleScroll, { passive: true });
                    handleScroll();
                }
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            if (window.lucide) {
                window.lucide.createIcons();
            }
        });
    </script>
    @include('components.theme-toggle-fab')
</body>
</html>
