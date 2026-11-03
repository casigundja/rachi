<!DOCTYPE html>
<html lang="pt" class="scroll-smooth">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/toast.css">
    <script src="/toast.js"></script>
    <script src="/auth-session.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RACHI Tec — Digitalização, Sistemas de Gestão, Websites &amp; Transformação Digital</title>
    <meta name="description" content="RACHI Tec — Digitalização, sistemas de gestão, websites, transformação digital e suporte técnico especializado em Angola.">

    <x-public-footer unit="tec" />

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (window.lucide) {
                lucide.createIcons();
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (window.lucide) lucide.createIcons();

            const reveals = document.querySelectorAll('.tec-reveal');
            if ('IntersectionObserver' in window && reveals.length > 0) {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('active');
                            observer.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.08, rootMargin: '0px 0px -20px 0px' });
                reveals.forEach(el => observer.observe(el));
            } else {
                reveals.forEach(el => el.classList.add('active'));
            }
        });
    </script>
<script src="/worker-public.js"></script>    @include('components.theme-toggle-fab')
</body>
</html>