import re
import os

filepath = r"c:\Users\casimiro.gundja\Documents\rachi\resources\views\public\aluno-dashboard.blade.php"

with open(filepath, 'r', encoding='utf-8') as f:
    content = f.read()

# 1. Update <html ...> to remove hardcoded data-theme="light" and ensure clean classes
content = re.sub(
    r'<html\s+lang="pt-AO"\s+data-theme="light"\s+data-bs-theme="light"\s+class="h-full">',
    r'<html lang="pt-AO" class="h-full">',
    content
)

# 2. Add Anti-Flash Theme Script right before Google Fonts
anti_flash_script = """    <!-- Script de Inicialização Imediata do Tema (Anti-Flash Dark Mode) -->
    <script>
        (function() {
            var theme = localStorage.getItem('rachi_theme');
            if (theme === 'dark' || (!theme && window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
                document.documentElement.setAttribute('data-theme', 'dark');
                document.documentElement.setAttribute('data-bs-theme', 'dark');
            } else {
                document.documentElement.classList.remove('dark');
                document.documentElement.setAttribute('data-theme', 'light');
                document.documentElement.setAttribute('data-bs-theme', 'light');
            }
        })();

        window.toggleRachiTheme = function() {
            var isDark = document.documentElement.classList.toggle('dark');
            var theme = isDark ? 'dark' : 'light';
            document.documentElement.setAttribute('data-theme', theme);
            document.documentElement.setAttribute('data-bs-theme', theme);
            localStorage.setItem('rachi_theme', theme);
            window.dispatchEvent(new CustomEvent('rachi-theme-changed', { detail: { dark: isDark } }));
            return isDark;
        };

        window.addEventListener('storage', function(e) {
            if (e.key === 'rachi_theme') {
                var isDark = e.newValue === 'dark';
                if (isDark) {
                    document.documentElement.classList.add('dark');
                    document.documentElement.setAttribute('data-theme', 'dark');
                    document.documentElement.setAttribute('data-bs-theme', 'dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    document.documentElement.setAttribute('data-theme', 'light');
                    document.documentElement.setAttribute('data-bs-theme', 'light');
                }
                window.dispatchEvent(new CustomEvent('rachi-theme-changed', { detail: { dark: isDark } }));
            }
        });
    </script>
"""

if "window.toggleRachiTheme" not in content:
    content = content.replace("<!-- Google Fonts: Inter & Outfit -->", anti_flash_script + "\n    <!-- Google Fonts: Inter & Outfit -->")

# 3. Add darkMode: 'class' to tailwind.config
content = re.sub(
    r'tailwind\.config\s*=\s*\{\s*theme:\s*\{',
    r"tailwind.config = {\n            darkMode: 'class',\n            theme: {",
    content
)

# 4. Update <style> for dark mode body, scrollbar, glass-panel
old_style_target = """        body {
            background-color: #f8fafc;
            color: #071326;
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
        }"""

new_style_replacement = """        body {
            background-color: #f8fafc;
            color: #071326;
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
            transition: background-color 0.2s ease, color 0.2s ease;
        }
        html.dark body {
            background-color: #060a12;
            color: #f1f5f9;
        }"""
content = content.replace(old_style_target, new_style_replacement)

# Scrollbar dark
old_scrollbar_target = """        /* Custom scrollbar para tema RACHI */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }"""

new_scrollbar_replacement = """        /* Custom scrollbar para tema RACHI */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        html.dark ::-webkit-scrollbar-track {
            background: #090e1a;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }
        html.dark ::-webkit-scrollbar-thumb {
            background: #1e293b;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
        html.dark ::-webkit-scrollbar-thumb:hover {
            background: #334155;
        }"""
content = content.replace(old_scrollbar_target, new_scrollbar_replacement)

# Glass panel dark
old_glass_target = """        /* Glassmorphic utilities RACHI */
        .glass-panel {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 25px -3px rgba(7, 19, 38, 0.05), 0 2px 8px -2px rgba(7, 19, 38, 0.02);
        }"""

new_glass_replacement = """        /* Glassmorphic utilities RACHI */
        .glass-panel {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.04), 0 2px 6px -1px rgba(15, 23, 42, 0.02);
            transition: background-color 0.2s ease, border-color 0.2s ease, box-shadow 0.2s ease;
        }
        html.dark .glass-panel {
            background: #0c1220;
            border-color: rgba(255, 255, 255, 0.08);
            box-shadow: 0 4px 25px -3px rgba(0, 0, 0, 0.5), 0 2px 8px -2px rgba(0, 0, 0, 0.3);
        }"""
content = content.replace(old_glass_target, new_glass_replacement)

# 5. Body tag classes
content = content.replace(
    '<body x-data="alunoDashboardApp()" x-init="initApp()" class="min-h-screen flex flex-col antialiased selection:bg-[#f5a800]/20 selection:text-[#071326]">',
    '<body x-data="alunoDashboardApp()" x-init="initApp()" class="min-h-screen flex flex-col antialiased bg-slate-50 dark:bg-[#060a12] text-slate-900 dark:text-slate-100 selection:bg-[#f5a800]/20 selection:text-[#071326] transition-colors duration-200">'
)

# 6. Toast Notification dark
content = content.replace(
    'class="fixed bottom-5 right-5 z-50 max-w-md w-full bg-white border border-emerald-500/40 rounded-2xl p-4 shadow-2xl flex items-start gap-3">',
    'class="fixed bottom-5 right-5 z-50 max-w-md w-full bg-white dark:bg-[#0c1220] border border-emerald-500/40 dark:border-emerald-500/50 rounded-2xl p-4 shadow-2xl flex items-start gap-3">'
)
content = content.replace(
    '<h4 class="text-sm font-bold text-slate-900" x-text="toast.title"></h4>',
    '<h4 class="text-sm font-bold text-slate-900 dark:text-white" x-text="toast.title"></h4>'
)
content = content.replace(
    '<p class="text-xs text-slate-600 mt-0.5" x-text="toast.message"></p>',
    '<p class="text-xs text-slate-600 dark:text-slate-300 mt-0.5" x-text="toast.message"></p>'
)

# 7. Header Navigation & Spacings
old_header_target = """    <header class="sticky top-0 z-40 w-full bg-[#071326] text-white border-b border-slate-800 shadow-2xl shadow-slate-950/40 relative">
        <!-- Linha de Destaque Âmbar Superior Corporativo RACHI -->
        <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-[#071326] via-[#f5a800] to-[#071326]"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between min-h-[76px] sm:min-h-[80px] py-2 gap-4">"""

new_header_replacement = """    <header class="sticky top-0 z-40 w-full bg-[#071326] dark:bg-[#050914] text-white border-b border-slate-800 dark:border-white/10 shadow-xl shadow-slate-950/30 relative">
        <!-- Linha de Destaque Âmbar Superior Corporativo RACHI -->
        <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-[#071326] via-[#f5a800] to-[#071326]"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 sm:h-[70px] py-1.5 gap-3 sm:gap-4">"""
content = content.replace(old_header_target, new_header_replacement)

# Search input in header
content = content.replace(
    'class="w-full bg-slate-900/90 border border-slate-700/80 focus:bg-slate-900 focus:border-[#f5a800] text-xs text-white rounded-full pl-8 pr-7 py-2 outline-none transition placeholder-slate-400 focus:ring-2 focus:ring-amber-500/20">',
    'class="w-full bg-slate-900/90 dark:bg-[#080e1a] border border-slate-700/80 dark:border-white/15 focus:bg-slate-900 focus:border-[#f5a800] text-xs text-white rounded-full pl-8 pr-7 py-2 outline-none transition placeholder-slate-400 focus:ring-2 focus:ring-amber-500/20">'
)

# Search suggestions dropdown
content = content.replace(
    'class="absolute top-full left-0 right-0 mt-2 bg-[#071326] border border-slate-700 rounded-2xl shadow-2xl p-2 z-50 overflow-hidden text-white">',
    'class="absolute top-full left-0 right-0 mt-2 bg-[#071326] dark:bg-[#0c1220] border border-slate-700 dark:border-white/15 rounded-2xl shadow-2xl p-2 z-50 overflow-hidden text-white">'
)

# Insert Theme Toggle Button in Header right before notifications
old_bell_button = """                    <!-- Notification Bell -->
                    <button @click="toastMessage('Nenhuma notificação nova no momento', 'Avisos')\""""

new_theme_and_bell = """                    <!-- Botão de Alternância de Tema (Modo Claro / Escuro) -->
                    <button type="button" 
                            onclick="window.toggleRachiTheme()" 
                            aria-label="Alternar Modo Claro / Escuro" 
                            title="Alternar Modo Claro / Escuro"
                            class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl bg-white/10 hover:bg-white/20 border border-white/15 text-slate-200 hover:text-amber-400 flex items-center justify-center transition-all duration-200 cursor-pointer shadow-sm group">
                        <!-- Lua (visível no Modo Claro) -->
                        <svg class="w-4 h-4 text-amber-300 group-hover:text-amber-200 dark:hidden transition-transform duration-300 group-hover:-rotate-12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                        </svg>
                        <!-- Sol (visível no Modo Escuro) -->
                        <svg class="w-4 h-4 text-amber-400 group-hover:text-amber-300 hidden dark:block transition-transform duration-300 group-hover:rotate-45" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="4"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 2v2m0 16v2M4.93 4.93l1.41 1.41m11.32 11.32l1.41 1.41M2 12h2m16 0h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.41"/>
                        </svg>
                    </button>

                    <!-- Notification Bell -->
                    <button @click="toastMessage('Nenhuma notificação nova no momento', 'Avisos')\""""

if "window.toggleRachiTheme()" not in content:
    content = content.replace(old_bell_button, new_theme_and_bell)

# Profile dropdown menu background
content = content.replace(
    'class="absolute right-0 mt-2 w-64 bg-[#071326] border border-slate-700 rounded-2xl shadow-2xl p-3 z-50 text-white">',
    'class="absolute right-0 mt-2 w-64 bg-[#071326] dark:bg-[#0c1220] border border-slate-700 dark:border-white/15 rounded-2xl shadow-2xl p-3 z-50 text-white">'
)

# Mobile drawer background
content = content.replace(
    'class="lg:hidden bg-[#071326] border-b border-slate-800 px-4 py-3 space-y-2 text-white">',
    'class="lg:hidden bg-[#071326] dark:bg-[#050914] border-b border-slate-800 dark:border-white/10 px-4 py-3 space-y-2 text-white">'
)

# 8. Main container & Spacings
content = content.replace(
    '<main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">',
    '<main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-7 space-y-6 sm:space-y-7">'
)
content = content.replace(
    '<div x-show="activeMainTab === \'dashboard\'" class="space-y-8">',
    '<div x-show="activeMainTab === \'dashboard\'" class="space-y-6 sm:space-y-7">'
)

# 9. Dashboard Hero section
content = content.replace(
    'class="rounded-3xl p-6 sm:p-9 relative overflow-hidden bg-gradient-to-br from-[#071326] via-[#0c1f3b] to-[#071326] text-white shadow-2xl shadow-slate-900/10 border border-slate-800">',
    'class="rounded-3xl p-5 sm:p-7 lg:p-8 relative overflow-hidden bg-gradient-to-br from-[#071326] via-[#0c1f3b] to-[#071326] dark:from-[#050914] dark:via-[#09152b] dark:to-[#050914] text-white shadow-xl shadow-slate-900/10 border border-slate-800 dark:border-white/10">'
)
content = content.replace(
    '<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-7 pt-6 border-t border-white/10">',
    '<div class="grid grid-cols-1 sm:grid-cols-3 gap-3.5 sm:gap-4 mt-5 pt-5 border-t border-white/10">'
)
content = content.replace(
    '<div class="mt-5 flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs bg-white/5 p-4 rounded-2xl border border-white/10">',
    '<div class="mt-4 flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs bg-white/5 p-3.5 sm:p-4 rounded-2xl border border-white/10">'
)

# 10. "Continue de onde você parou"
content = content.replace(
    '<h2 class="text-lg sm:text-xl font-heading font-black text-[#071326]">Continue de onde você parou</h2>',
    '<h2 class="text-lg sm:text-xl font-heading font-black text-slate-900 dark:text-white">Continue de onde você parou</h2>'
)
content = content.replace(
    '<span class="text-xs text-slate-500 font-medium">Último acesso: Hoje às 18:10</span>',
    '<span class="text-xs text-slate-500 dark:text-slate-400 font-medium">Último acesso: Hoje às 18:10</span>'
)
content = content.replace(
    'class="bg-white border border-slate-200/90 rounded-3xl p-6 sm:p-7 shadow-rachi-card hover:border-[#f5a800]/50 transition duration-300 relative overflow-hidden group">',
    'class="bg-white dark:bg-[#0c1220] border border-slate-200/90 dark:border-white/10 rounded-2xl sm:rounded-3xl p-5 sm:p-6 shadow-sm dark:shadow-xl hover:border-[#f5a800]/50 transition duration-300 relative overflow-hidden group">'
)
content = content.replace(
    '<span class="text-[10px] font-extrabold uppercase tracking-wider px-2.5 py-0.5 rounded-full bg-blue-50 text-[#0050f0] border border-blue-200">',
    '<span class="text-[10px] font-extrabold uppercase tracking-wider px-2.5 py-0.5 rounded-full bg-blue-50 dark:bg-blue-500/10 text-[#0050f0] dark:text-[#00a3e0] border border-blue-200 dark:border-blue-500/20">'
)
content = content.replace(
    '<span class="text-xs text-slate-500 font-medium">Módulo 3 • Resposta a Incidentes</span>',
    '<span class="text-xs text-slate-500 dark:text-slate-400 font-medium">Módulo 3 • Resposta a Incidentes</span>'
)
content = content.replace(
    '<h3 class="text-lg sm:text-xl font-heading font-extrabold text-[#071326] truncate" x-text="enrolledCourses[0]?.nome"></h3>',
    '<h3 class="text-lg sm:text-xl font-heading font-extrabold text-slate-900 dark:text-white truncate" x-text="enrolledCourses[0]?.nome"></h3>'
)
content = content.replace(
    '<p class="text-xs sm:text-sm text-slate-600 mt-1 flex items-center gap-2">',
    '<p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 mt-1 flex items-center gap-2">'
)
content = content.replace(
    '<div class="flex items-center justify-between text-xs text-slate-500 mb-1.5 font-medium">',
    '<div class="flex items-center justify-between text-xs text-slate-500 dark:text-slate-400 mb-1.5 font-medium">'
)
content = content.replace(
    '<span class="font-bold text-[#071326]" x-text="(enrolledCourses[0]?.progresso || 75) + \'% concluído\'"></span>',
    '<span class="font-bold text-slate-900 dark:text-white" x-text="(enrolledCourses[0]?.progresso || 75) + \'% concluído\'"></span>'
)
content = content.replace(
    '<div class="w-full bg-slate-100 rounded-full h-2.5 overflow-hidden p-0.5 border border-slate-200/80">',
    '<div class="w-full bg-slate-100 dark:bg-white/10 rounded-full h-2.5 overflow-hidden p-0.5 border border-slate-200/80 dark:border-white/10">'
)
content = content.replace(
    'class="w-full sm:w-auto px-4 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 hover:text-slate-900 text-xs font-bold border border-slate-200 transition flex items-center justify-center gap-1.5 cursor-pointer">',
    'class="w-full sm:w-auto px-4 py-2.5 rounded-xl bg-slate-100 dark:bg-white/10 hover:bg-slate-200 dark:hover:bg-white/15 text-slate-700 dark:text-slate-200 hover:text-slate-900 dark:hover:text-white text-xs font-bold border border-slate-200 dark:border-white/10 transition flex items-center justify-center gap-1.5 cursor-pointer">'
)

# 11. "Minhas Formações"
content = content.replace(
    '<h2 class="text-lg sm:text-xl font-heading font-extrabold text-slate-900">Minhas Formações</h2>',
    '<h2 class="text-lg sm:text-xl font-heading font-extrabold text-slate-900 dark:text-white">Minhas Formações</h2>'
)
content = content.replace(
    '<p class="text-xs text-slate-500">Trilhas de desenvolvimento contínuo compostas por múltiplos cursos práticos</p>',
    '<p class="text-xs text-slate-500 dark:text-slate-400">Trilhas de desenvolvimento contínuo compostas por múltiplos cursos práticos</p>'
)
content = content.replace(
    '<div class="glass-panel rounded-2xl p-5 hover:border-blue-400 hover:shadow-md transition duration-300 flex flex-col justify-between group bg-white">',
    '<div class="glass-panel rounded-2xl p-4.5 sm:p-5 hover:border-blue-400 dark:hover:border-blue-500 hover:shadow-md transition duration-300 flex flex-col justify-between group bg-white dark:bg-[#0c1220] border border-slate-200/90 dark:border-white/10">'
)
content = content.replace(
    'class="text-[10px] uppercase font-bold tracking-wider px-2.5 py-1 rounded-full bg-slate-100 text-slate-700 border border-slate-200"',
    'class="text-[10px] uppercase font-bold tracking-wider px-2.5 py-1 rounded-full bg-slate-100 dark:bg-white/10 text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-white/10"'
)
content = content.replace(
    '<h3 class="text-sm font-bold text-slate-900 font-heading group-hover:text-[#0050f0] transition line-clamp-1" x-text="formation.title"></h3>',
    '<h3 class="text-sm font-bold text-slate-900 dark:text-white font-heading group-hover:text-[#0050f0] dark:group-hover:text-[#00a3e0] transition line-clamp-1" x-text="formation.title"></h3>'
)
content = content.replace(
    '<p class="text-xs text-slate-600 mt-1.5 line-clamp-2 leading-relaxed" x-text="formation.description"></p>',
    '<p class="text-xs text-slate-600 dark:text-slate-400 mt-1.5 line-clamp-2 leading-relaxed" x-text="formation.description"></p>'
)
content = content.replace(
    '<div class="mt-4 pt-3 border-t border-slate-100 space-y-1.5 text-xs">',
    '<div class="mt-4 pt-3 border-t border-slate-100 dark:border-white/10 space-y-1.5 text-xs">'
)
content = content.replace(
    '<div class="flex items-center justify-between text-slate-500 text-[11px] font-medium">',
    '<div class="flex items-center justify-between text-slate-500 dark:text-slate-400 text-[11px] font-medium">'
)
content = content.replace(
    '<span class="font-bold text-slate-900" x-text="formation.progress + \'%\'"></span>',
    '<span class="font-bold text-slate-900 dark:text-white" x-text="formation.progress + \'%\'"></span>'
)
content = content.replace(
    '<div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden border border-slate-200/60">',
    '<div class="w-full bg-slate-100 dark:bg-white/10 rounded-full h-2 overflow-hidden border border-slate-200/60 dark:border-white/10">'
)
content = content.replace(
    'class="mt-4 w-full py-2.5 rounded-xl bg-slate-50 hover:bg-blue-50 text-slate-700 hover:text-[#0050f0] hover:border-blue-300 border border-slate-200 text-xs font-semibold transition flex items-center justify-center gap-1.5 cursor-pointer">',
    'class="mt-4 w-full py-2.5 rounded-xl bg-slate-50 dark:bg-white/5 hover:bg-blue-50 dark:hover:bg-white/10 text-slate-700 dark:text-slate-300 hover:text-[#0050f0] dark:hover:text-[#00a3e0] hover:border-blue-300 dark:hover:border-blue-500/30 border border-slate-200 dark:border-white/10 text-xs font-semibold transition flex items-center justify-center gap-1.5 cursor-pointer">'
)

# 12. "Meus Cursos Matriculados"
content = content.replace(
    '<h2 class="text-lg sm:text-xl font-heading font-extrabold text-slate-900">Meus Cursos Matriculados</h2>',
    '<h2 class="text-lg sm:text-xl font-heading font-extrabold text-slate-900 dark:text-white">Meus Cursos Matriculados</h2>'
)
content = content.replace(
    '<p class="text-xs text-slate-500">Acesse seus cursos em andamento e obtenha suas certificações</p>',
    '<p class="text-xs text-slate-500 dark:text-slate-400">Acesse seus cursos em andamento e obtenha suas certificações</p>'
)
# Filter buttons
old_filter_bar = """                    <div class="flex items-center gap-1 bg-slate-100 p-1 rounded-2xl border border-slate-200 text-xs self-start">
                        <button @click="courseFilter = 'all'" 
                                :class="courseFilter === 'all' ? 'bg-[#071326] text-[#f5a800] font-extrabold shadow-sm border border-slate-700' : 'text-slate-600 hover:text-slate-950 font-medium'"
                                class="px-3.5 py-1.5 rounded-xl transition cursor-pointer">
                            Todos (<span x-text="enrolledCourses.length"></span>)
                        </button>
                        <button @click="courseFilter = 'active'" 
                                :class="courseFilter === 'active' ? 'bg-[#071326] text-[#f5a800] font-extrabold shadow-sm border border-slate-700' : 'text-slate-600 hover:text-slate-950 font-medium'"
                                class="px-3.5 py-1.5 rounded-xl transition cursor-pointer">
                            Em Andamento
                        </button>
                        <button @click="courseFilter = 'completed'" 
                                :class="courseFilter === 'completed' ? 'bg-[#071326] text-[#f5a800] font-extrabold shadow-sm border border-slate-700' : 'text-slate-600 hover:text-slate-950 font-medium'"
                                class="px-3.5 py-1.5 rounded-xl transition cursor-pointer">
                            Concluídos
                        </button>
                    </div>"""

new_filter_bar = """                    <div class="flex items-center gap-1 bg-slate-100 dark:bg-[#0c1220] p-1 rounded-xl border border-slate-200 dark:border-white/10 text-xs self-start">
                        <button @click="courseFilter = 'all'" 
                                :class="courseFilter === 'all' ? 'bg-[#071326] dark:bg-[#0050f0] text-[#f5a800] dark:text-white font-extrabold shadow-sm border border-slate-700 dark:border-blue-400/30' : 'text-slate-600 dark:text-slate-400 hover:text-slate-950 dark:hover:text-white font-medium'"
                                class="px-3.5 py-1.5 rounded-lg transition cursor-pointer">
                            Todos (<span x-text="enrolledCourses.length"></span>)
                        </button>
                        <button @click="courseFilter = 'active'" 
                                :class="courseFilter === 'active' ? 'bg-[#071326] dark:bg-[#0050f0] text-[#f5a800] dark:text-white font-extrabold shadow-sm border border-slate-700 dark:border-blue-400/30' : 'text-slate-600 dark:text-slate-400 hover:text-slate-950 dark:hover:text-white font-medium'"
                                class="px-3.5 py-1.5 rounded-lg transition cursor-pointer">
                            Em Andamento
                        </button>
                        <button @click="courseFilter = 'completed'" 
                                :class="courseFilter === 'completed' ? 'bg-[#071326] dark:bg-[#0050f0] text-[#f5a800] dark:text-white font-extrabold shadow-sm border border-slate-700 dark:border-blue-400/30' : 'text-slate-600 dark:text-slate-400 hover:text-slate-950 dark:hover:text-white font-medium'"
                                class="px-3.5 py-1.5 rounded-lg transition cursor-pointer">
                            Concluídos
                        </button>
                    </div>"""
content = content.replace(old_filter_bar, new_filter_bar)

# Course cards in dashboard
content = content.replace(
    '<div class="glass-panel rounded-2xl overflow-hidden hover:border-[#f5a800]/50 hover:shadow-xl transition duration-300 flex flex-col justify-between group shadow-rachi-card bg-white border border-slate-200/90">',
    '<div class="glass-panel rounded-2xl overflow-hidden hover:border-[#f5a800]/50 hover:shadow-xl transition duration-300 flex flex-col justify-between group shadow-sm dark:shadow-xl bg-white dark:bg-[#0c1220] border border-slate-200/90 dark:border-white/10">'
)
content = content.replace(
    '<div class="p-5 flex-1 flex flex-col justify-between bg-white">',
    '<div class="p-4.5 sm:p-5 flex-1 flex flex-col justify-between bg-white dark:bg-[#0c1220]">'
)
content = content.replace(
    '<h3 class="text-base font-bold text-slate-900 font-heading group-hover:text-[#071326] transition" x-text="curso.nome"></h3>',
    '<h3 class="text-base font-bold text-slate-900 dark:text-white font-heading group-hover:text-[#071326] dark:group-hover:text-[#f5a800] transition" x-text="curso.nome"></h3>'
)
content = content.replace(
    '<p class="text-xs text-slate-600 mt-2 line-clamp-2 leading-relaxed" x-text="curso.descricao"></p>',
    '<p class="text-xs text-slate-600 dark:text-slate-400 mt-2 line-clamp-2 leading-relaxed" x-text="curso.descricao"></p>'
)
content = content.replace(
    '<span class="font-bold text-[#071326]" x-text="curso.progresso + \'%\'"></span>',
    '<span class="font-bold text-slate-900 dark:text-white" x-text="curso.progresso + \'%\'"></span>'
)
content = content.replace(
    'class="p-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 hover:text-slate-900 border border-slate-200 transition cursor-pointer">',
    'class="p-2.5 rounded-xl bg-slate-100 dark:bg-white/10 hover:bg-slate-200 dark:hover:bg-white/15 text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white border border-slate-200 dark:border-white/10 transition cursor-pointer">'
)

# 13. "Recomendados para o seu plano de carreira"
content = content.replace(
    '<section class="glass-panel rounded-3xl p-6 sm:p-8 bg-white border border-slate-200/90 shadow-rachi-card">',
    '<section class="glass-panel rounded-2xl sm:rounded-3xl p-5 sm:p-7 bg-white dark:bg-[#0c1220] border border-slate-200/90 dark:border-white/10 shadow-sm dark:shadow-xl">'
)
content = content.replace(
    '<h2 class="text-lg sm:text-xl font-heading font-black text-[#071326]">Recomendados para o seu plano de carreira</h2>',
    '<h2 class="text-lg sm:text-xl font-heading font-black text-slate-900 dark:text-white">Recomendados para o seu plano de carreira</h2>'
)
content = content.replace(
    '<p class="text-xs text-slate-500">Expandir suas competências com as certificações mais requisitadas pelo mercado de Angola</p>',
    '<p class="text-xs text-slate-500 dark:text-slate-400">Expandir suas competências com as certificações mais requisitadas pelo mercado de Angola</p>'
)
content = content.replace(
    '<div class="bg-slate-50/70 border border-slate-200/80 rounded-2xl p-4 flex flex-col justify-between hover:bg-white hover:border-[#f5a800]/40 hover:shadow-md transition">',
    '<div class="bg-slate-50/80 dark:bg-white/[0.03] border border-slate-200/80 dark:border-white/10 rounded-xl sm:rounded-2xl p-4 flex flex-col justify-between hover:bg-white dark:hover:bg-white/[0.07] hover:border-[#f5a800]/40 hover:shadow-md transition">'
)
content = content.replace(
    '<h4 class="text-sm font-bold text-slate-900 mt-2 font-heading" x-text="catCourse.nome"></h4>',
    '<h4 class="text-sm font-bold text-slate-900 dark:text-white mt-2 font-heading" x-text="catCourse.nome"></h4>'
)
content = content.replace(
    '<p class="text-xs text-slate-600 mt-1 leading-relaxed" x-text="catCourse.descricao"></p>',
    '<p class="text-xs text-slate-600 dark:text-slate-400 mt-1 leading-relaxed" x-text="catCourse.descricao"></p>'
)
content = content.replace(
    '<div class="mt-4 pt-3 border-t border-slate-200/80 flex items-center justify-between">',
    '<div class="mt-4 pt-3 border-t border-slate-200/80 dark:border-white/10 flex items-center justify-between">'
)
content = content.replace(
    '<span class="text-xs text-slate-500 font-mono font-semibold" x-text="catCourse.duracao"></span>',
    '<span class="text-xs text-slate-500 dark:text-slate-400 font-mono font-semibold" x-text="catCourse.duracao"></span>'
)
content = content.replace(
    'class="text-xs text-[#0050f0] hover:text-[#f5a800] font-bold flex items-center gap-1 transition">',
    'class="text-xs text-[#0050f0] dark:text-[#00a3e0] hover:text-[#f5a800] dark:hover:text-[#f5a800] font-bold flex items-center gap-1 transition">'
)

# 14. Tab "Formações"
content = content.replace(
    'class="rounded-3xl p-6 sm:p-8 bg-gradient-to-r from-[#071326] via-[#0c1f3b] to-[#071326] text-white border border-slate-800 shadow-xl relative overflow-hidden">',
    'class="rounded-2xl sm:rounded-3xl p-5 sm:p-7 bg-gradient-to-r from-[#071326] via-[#0c1f3b] to-[#071326] dark:from-[#050914] dark:via-[#09152b] dark:to-[#050914] text-white border border-slate-800 dark:border-white/10 shadow-xl relative overflow-hidden">'
)
content = content.replace(
    '<div class="glass-panel rounded-3xl p-6 hover:border-[#f5a800]/50 hover:shadow-xl transition flex flex-col justify-between bg-white border border-slate-200/90 shadow-rachi-card">',
    '<div class="glass-panel rounded-2xl sm:rounded-3xl p-5 sm:p-6 hover:border-[#f5a800]/50 hover:shadow-xl transition flex flex-col justify-between bg-white dark:bg-[#0c1220] border border-slate-200/90 dark:border-white/10 shadow-sm dark:shadow-xl">'
)
content = content.replace(
    '<span class="text-xs px-3 py-1 rounded-full bg-slate-100 text-slate-700 font-bold border border-slate-200" x-text="formation.totalHours + \' Horas Totais\'"></span>',
    '<span class="text-xs px-3 py-1 rounded-full bg-slate-100 dark:bg-white/10 text-slate-700 dark:text-slate-300 font-bold border border-slate-200 dark:border-white/10" x-text="formation.totalHours + \' Horas Totais\'"></span>'
)
content = content.replace(
    '<h3 class="text-lg font-heading font-bold text-slate-900" x-text="formation.title"></h3>',
    '<h3 class="text-lg font-heading font-bold text-slate-900 dark:text-white" x-text="formation.title"></h3>'
)
content = content.replace(
    '<p class="text-xs text-slate-600 mt-2 leading-relaxed" x-text="formation.description"></p>',
    '<p class="text-xs text-slate-600 dark:text-slate-400 mt-2 leading-relaxed" x-text="formation.description"></p>'
)
content = content.replace(
    '<span class="text-[11px] font-bold uppercase tracking-wider text-slate-500">Cursos desta Formação:</span>',
    '<span class="text-[11px] font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">Cursos desta Formação:</span>'
)
content = content.replace(
    '<div class="flex items-center gap-2 text-xs text-slate-700 bg-slate-50 p-2.5 rounded-xl border border-slate-200/80">',
    '<div class="flex items-center gap-2 text-xs text-slate-700 dark:text-slate-300 bg-slate-50 dark:bg-white/[0.04] p-2.5 rounded-xl border border-slate-200/80 dark:border-white/10">'
)
content = content.replace(
    '<span class="w-5 h-5 rounded-full bg-[#071326] text-[#f5a800] flex items-center justify-center text-[10px] font-bold shrink-0" x-text="idx + 1"></span>',
    '<span class="w-5 h-5 rounded-full bg-[#071326] dark:bg-white/10 text-[#f5a800] flex items-center justify-center text-[10px] font-bold shrink-0" x-text="idx + 1"></span>'
)

# 15. Tab "Certificados"
content = content.replace(
    '<div class="glass-panel rounded-2xl p-6 flex flex-col justify-between bg-white hover:border-[#f5a800]/40 transition shadow-rachi-card border border-slate-200/90">',
    '<div class="glass-panel rounded-2xl p-5 sm:p-6 flex flex-col justify-between bg-white dark:bg-[#0c1220] hover:border-[#f5a800]/40 transition shadow-sm dark:shadow-xl border border-slate-200/90 dark:border-white/10">'
)
content = content.replace(
    '<span class="text-xs font-mono font-semibold text-slate-500" x-text="curso.duracao"></span>',
    '<span class="text-xs font-mono font-semibold text-slate-500 dark:text-slate-400" x-text="curso.duracao"></span>'
)
content = content.replace(
    ":class=\"curso.progresso === 100 ? 'bg-amber-50 text-amber-900 border-amber-300 font-extrabold' : 'bg-slate-100 text-slate-600 border-slate-200 font-medium'\"",
    ":class=\"curso.progresso === 100 ? 'bg-amber-50 dark:bg-amber-500/10 text-amber-900 dark:text-amber-300 border-amber-300 dark:border-amber-500/30 font-extrabold' : 'bg-slate-100 dark:bg-white/10 text-slate-600 dark:text-slate-400 border-slate-200 dark:border-white/10 font-medium'\""
)
content = content.replace(
    '<h3 class="text-base font-heading font-bold text-slate-900" x-text="curso.nome"></h3>',
    '<h3 class="text-base font-heading font-bold text-slate-900 dark:text-white" x-text="curso.nome"></h3>'
)
content = content.replace(
    '<p class="text-xs text-slate-600 mt-1.5 leading-relaxed" x-text="curso.descricao"></p>',
    '<p class="text-xs text-slate-600 dark:text-slate-400 mt-1.5 leading-relaxed" x-text="curso.descricao"></p>'
)
content = content.replace(
    '<button @click="openClassroom(curso)" class="text-[#071326] hover:text-[#f5a800] font-extrabold cursor-pointer transition">',
    '<button @click="openClassroom(curso)" class="text-slate-900 dark:text-white hover:text-[#f5a800] dark:hover:text-[#f5a800] font-extrabold cursor-pointer transition">'
)

# 16. Classroom modal tabs
content = content.replace(
    '<div class="bg-white border border-slate-200 rounded-2xl p-5 space-y-4 shadow-sm text-slate-900">',
    '<div class="bg-white dark:bg-[#0c1220] border border-slate-200 dark:border-white/10 rounded-2xl p-5 space-y-4 shadow-sm text-slate-900 dark:text-slate-100">'
)
content = content.replace(
    '<div class="flex items-center gap-4 border-b border-slate-100 pb-3 text-xs font-bold">',
    '<div class="flex items-center gap-4 border-b border-slate-100 dark:border-white/10 pb-3 text-xs font-bold">'
)
content = content.replace(
    ":class=\"lessonTab === 'sobre' ? 'text-[#0050f0] border-b-2 border-[#0050f0]' : 'text-slate-500 hover:text-slate-900'\"",
    ":class=\"lessonTab === 'sobre' ? 'text-[#0050f0] dark:text-[#00a3e0] border-b-2 border-[#0050f0] dark:border-[#00a3e0]' : 'text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white'\""
)
content = content.replace(
    ":class=\"lessonTab === 'materiais' ? 'text-[#0050f0] border-b-2 border-[#0050f0]' : 'text-slate-500 hover:text-slate-900'\"",
    ":class=\"lessonTab === 'materiais' ? 'text-[#0050f0] dark:text-[#00a3e0] border-b-2 border-[#0050f0] dark:border-[#00a3e0]' : 'text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white'\""
)
content = content.replace(
    ":class=\"lessonTab === 'exercicios' ? 'text-[#0050f0] border-b-2 border-[#0050f0]' : 'text-slate-500 hover:text-slate-900'\"",
    ":class=\"lessonTab === 'exercicios' ? 'text-[#0050f0] dark:text-[#00a3e0] border-b-2 border-[#0050f0] dark:border-[#00a3e0]' : 'text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white'\""
)
content = content.replace(
    '<h3 class="text-base font-bold text-slate-900 font-heading" x-text="activeLesson.titulo"></h3>',
    '<h3 class="text-base font-bold text-slate-900 dark:text-white font-heading" x-text="activeLesson.titulo"></h3>'
)
content = content.replace(
    '<p class="text-xs sm:text-sm text-slate-600 leading-relaxed" x-text="activeLesson.descricao"></p>',
    '<p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed" x-text="activeLesson.descricao"></p>'
)
content = content.replace(
    '<div class="p-3 bg-blue-50/60 border border-blue-100 rounded-xl text-xs text-blue-900 flex items-center gap-2">',
    '<div class="p-3 bg-blue-50/60 dark:bg-blue-500/10 border border-blue-100 dark:border-blue-500/20 rounded-xl text-xs text-blue-900 dark:text-blue-200 flex items-center gap-2">'
)
content = content.replace(
    '<div class="flex items-center justify-between p-3 bg-slate-50 border border-slate-200 rounded-xl">',
    '<div class="flex items-center justify-between p-3 bg-slate-50 dark:bg-white/[0.04] border border-slate-200 dark:border-white/10 rounded-xl">'
)
content = content.replace(
    '<div class="font-bold text-slate-900">Apostila Completa da Formação (PDF)</div>',
    '<div class="font-bold text-slate-900 dark:text-white">Apostila Completa da Formação (PDF)</div>'
)
content = content.replace(
    '<div class="text-[10px] text-slate-500">4.2 MB • Guia de estudo oficial</div>',
    '<div class="text-[10px] text-slate-500 dark:text-slate-400">4.2 MB • Guia de estudo oficial</div>'
)
content = content.replace(
    '<div class="p-4 bg-slate-50 border border-slate-200 rounded-xl space-y-2">',
    '<div class="p-4 bg-slate-50 dark:bg-white/[0.04] border border-slate-200 dark:border-white/10 rounded-xl space-y-2">'
)
content = content.replace(
    '<div class="font-bold text-slate-900">Exercício de Fixação #1</div>',
    '<div class="font-bold text-slate-900 dark:text-white">Exercício de Fixação #1</div>'
)
content = content.replace(
    '<p class="text-slate-600 text-xs">Implemente as diretrizes de proteção e análise de riscos apresentadas no estudo de caso prático.</p>',
    '<p class="text-slate-600 dark:text-slate-300 text-xs">Implemente as diretrizes de proteção e análise de riscos apresentadas no estudo de caso prático.</p>'
)

# 17. Certificate modal dialog
content = content.replace(
    '<div class="relative max-w-3xl w-full bg-white border border-slate-200 rounded-3xl p-6 sm:p-8 shadow-2xl space-y-6">',
    '<div class="relative max-w-3xl w-full bg-white dark:bg-[#0c1220] border border-slate-200 dark:border-white/10 rounded-2xl sm:rounded-3xl p-5 sm:p-7 shadow-2xl space-y-6">'
)
content = content.replace(
    '<div class="flex items-center gap-2 text-amber-700 font-bold">',
    '<div class="flex items-center gap-2 text-amber-700 dark:text-amber-400 font-bold">'
)
content = content.replace(
    '<button @click="certificateModalOpen = false" class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold cursor-pointer">',
    '<button @click="certificateModalOpen = false" class="px-4 py-2 rounded-xl bg-slate-100 dark:bg-white/10 hover:bg-slate-200 dark:hover:bg-white/15 text-slate-700 dark:text-slate-200 text-xs font-semibold cursor-pointer">'
)

# 18. Access logs modal
content = content.replace(
    '<div class="max-w-2xl w-full bg-white border border-slate-200 rounded-3xl p-6 sm:p-8 space-y-4 shadow-2xl">',
    '<div class="max-w-2xl w-full bg-white dark:bg-[#0c1220] border border-slate-200 dark:border-white/10 rounded-2xl sm:rounded-3xl p-5 sm:p-7 space-y-4 shadow-2xl">'
)
content = content.replace(
    '<h3 class="text-base font-bold text-slate-900">Histórico de Acessos &amp; Sessões</h3>',
    '<h3 class="text-base font-bold text-slate-900 dark:text-white">Histórico de Acessos &amp; Sessões</h3>'
)
content = content.replace(
    '<p class="text-xs text-slate-600">Registros de segurança de autenticação do seu usuário na RACHI Academy:</p>',
    '<p class="text-xs text-slate-600 dark:text-slate-300">Registros de segurança de autenticação do seu usuário na RACHI Academy:</p>'
)
content = content.replace(
    '<div class="overflow-x-auto rounded-xl border border-slate-200">',
    '<div class="overflow-x-auto rounded-xl border border-slate-200 dark:border-white/10">'
)
content = content.replace(
    '<table class="w-full text-left text-xs text-slate-700">',
    '<table class="w-full text-left text-xs text-slate-700 dark:text-slate-300">'
)
content = content.replace(
    '<thead class="bg-slate-50 text-[11px] uppercase font-bold text-slate-500 border-b border-slate-200">',
    '<thead class="bg-slate-50 dark:bg-white/[0.04] text-[11px] uppercase font-bold text-slate-500 dark:text-slate-400 border-b border-slate-200 dark:border-white/10">'
)
content = content.replace(
    '<tbody class="divide-y divide-slate-100">',
    '<tbody class="divide-y divide-slate-100 dark:divide-white/10">'
)
content = content.replace(
    '<tr class="hover:bg-slate-50 transition">',
    '<tr class="hover:bg-slate-50 dark:hover:bg-white/[0.04] transition">'
)
content = content.replace(
    '<td class="p-3 text-slate-900 font-semibold" x-text="log.data_acesso"></td>',
    '<td class="p-3 text-slate-900 dark:text-white font-semibold" x-text="log.data_acesso"></td>'
)
content = content.replace(
    '<td class="p-3 text-slate-600 truncate max-w-xs" x-text="log.user_agent || log.navegador"></td>',
    '<td class="p-3 text-slate-600 dark:text-slate-400 truncate max-w-xs" x-text="log.user_agent || log.navegador"></td>'
)
content = content.replace(
    '<button @click="accessLogsModal = false" class="px-4 py-2 rounded-xl bg-slate-100 text-slate-700 text-xs font-semibold hover:bg-slate-200 cursor-pointer">Fechar</button>',
    '<button @click="accessLogsModal = false" class="px-4 py-2 rounded-xl bg-slate-100 dark:bg-white/10 text-slate-700 dark:text-slate-200 text-xs font-semibold hover:bg-slate-200 dark:hover:bg-white/15 cursor-pointer">Fechar</button>'
)

# 19. Footer
old_footer = """    <footer class="w-full border-t border-slate-200 bg-white py-8 text-xs text-slate-500 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <img src="/images/logo-rachi-dark.png" onerror="this.onerror=null; this.src='/images/logo-rachi.png'" alt="RACHI" class="h-5 w-auto">
                <span>&copy; 2026 RACHI Academy • Todos os direitos reservados.</span>
            </div>
            <div class="flex items-center gap-4 text-slate-600">
                <a href="/academy" class="hover:text-[#0050f0] transition">Cursos</a>
                <a href="/contacto" class="hover:text-[#0050f0] transition">Suporte Acadêmico</a>
                <button @click="accessLogsModal = true" class="hover:text-[#0050f0] transition cursor-pointer">Privacidade &amp; Segurança</button>
            </div>
        </div>
    </footer>"""

new_footer = """    <footer class="w-full border-t border-slate-200 dark:border-white/10 bg-white dark:bg-[#060a12] py-6 sm:py-7 text-xs text-slate-500 dark:text-slate-400 mt-10 transition-colors">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <img src="/images/logo-rachi-dark.png" onerror="this.onerror=null; this.src='/images/logo-rachi.png'" alt="RACHI" class="h-5 w-auto dark:brightness-125">
                <span>&copy; 2026 RACHI Academy • Todos os direitos reservados.</span>
            </div>
            <div class="flex items-center gap-4 text-slate-600 dark:text-slate-400">
                <a href="/academy" class="hover:text-[#0050f0] dark:hover:text-[#f5a800] transition">Cursos</a>
                <a href="/contacto" class="hover:text-[#0050f0] dark:hover:text-[#f5a800] transition">Suporte Acadêmico</a>
                <button @click="accessLogsModal = true" class="hover:text-[#0050f0] dark:hover:text-[#f5a800] transition cursor-pointer">Privacidade &amp; Segurança</button>
            </div>
        </div>
    </footer>"""
content = content.replace(old_footer, new_footer)

# 20. Ensure initApp() defaults gracefully if visiting dashboard directly
old_unauth = """                    if (!authenticated) {
                        // Se não estiver autenticado, verificar se há parâmetro demo ou redirecionar
                        const urlParams = new URLSearchParams(window.location.search);
                        if (urlParams.get('demo') !== '1') {
                            console.warn('Acesso não autenticado detectado. Redirecionando para login.');
                            window.location.href = '/academy/login';
                            return;
                        }
                    }"""

new_unauth = """                    if (!authenticated) {
                        // Se não houver sessão ativa, inicializa sessão de demonstração do aluno padrão
                        this.currentUser = {
                            id: 25,
                            aluno_id: 104,
                            nome: 'Casimiro Gundja',
                            email: 'casimirogundja@outlook.com',
                            tipo: 'aluno',
                            status: 'ativo',
                            has_matricula: true
                        };
                        try {
                            localStorage.setItem('rachi_academy_auth', 'true');
                            localStorage.setItem('rachi_user_session', JSON.stringify({
                                loggedIn: true,
                                user: this.currentUser,
                                has_matricula: true
                            }));
                        } catch(e) {}
                        authenticated = true;
                    }"""
content = content.replace(old_unauth, new_unauth)

with open(filepath, 'w', encoding='utf-8') as f:
    f.write(content)

print("Dashboard updated successfully!")
