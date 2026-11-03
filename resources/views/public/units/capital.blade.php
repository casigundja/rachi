<!DOCTYPE html>
<html lang="pt" class="scroll-smooth">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/toast.css">
    <script src="/toast.js"></script>
    <script src="/auth-session.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RACHI Human Capital — Serviços Empresariais, Recursos Humanos &amp; Contabilidade</title>
    <meta name="description" content="RACHI Human Capital — Serviços empresariais, recursos humanos, contabilidade e regularização documental em Angola.">

    <x-public-footer unit="capital" />

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (window.lucide) {
                lucide.createIcons();
            }
        });
    </script>
<script src="/worker-public.js"></script>    @include('components.theme-toggle-fab')
</body>
</html>
