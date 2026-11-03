<!DOCTYPE html>
<html lang="pt" class="scroll-smooth">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/toast.css">
    <script src="/toast.js"></script>
    <script src="/auth-session.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RACHI Print — Impressão Institucional, Brindes &amp; Produção Gráfica Corporativa</title>
    <meta name="description" content="RACHI Print — Impressão de documentos institucionais, materiais promocionais, produção gráfica corporativa e gráfica para eventos com acabamentos de alta qualidade em Angola.">

    <x-public-footer unit="print" />

    <!-- Bottom Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (window.lucide) {
                window.lucide.createIcons();
            }
        });
    </script>
<script src="/worker-public.js"></script>    @include('components.theme-toggle-fab')
</body>
</html>
