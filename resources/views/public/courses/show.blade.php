<!DOCTYPE html>
<html lang="pt-AO" data-theme="dark" class="scroll-smooth">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/toast.css">
    <script src="/toast.js"></script>
    <script src="/auth-session.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $course->name }} — RACHI Academy</title>
    <meta name="description" content="{{ Str::limit($course->short_description ?? $course->description, 160) }}">
    <link rel="canonical" href="{{ url()->current() }}">

    <x-public-footer unit="academy" />

    @if(session('matricula_sucesso'))
    
    @endif

    <!-- Lucide init -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            lucide.createIcons();
        });
    </script>
    @include('components.theme-toggle-fab')
</body>
</html>
