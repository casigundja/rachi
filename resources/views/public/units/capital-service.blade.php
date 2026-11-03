<!DOCTYPE html>
<html lang="pt" class="scroll-smooth">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/toast.css">
    <script src="/toast.js"></script>
    <script src="/auth-session.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $service['title'] }} — RACHI Human Capital</title>
    <meta name="description" content="{{ $service['short_desc'] }}">

    <x-public-footer unit="capital" />

    <script>
        function servicePageApp() {
            return {
                ...window.rachiCapitalForm({
                    servico: @json($service['title']), service_slug: @json($service['slug']),
                    plano: @json($service['plans'][1]['name'] ?? $service['plans'][0]['name'] ?? ''),
                }),
                selectPlan(planName) {
                    this.formData.plano = planName;
                },
                sendWhatsAppDirect() {
                    let msg = '{{ $service['whatsapp_msg'] }}';
                    if (this.formData.nome) {
                        msg += ` Meu nome é ${this.formData.nome}`;
                    }
                    if (this.formData.empresa) {
                        msg += ` da empresa ${this.formData.empresa}.`;
                    }
                    if (this.formData.plano) {
                        msg += ` Tenho interesse específico no plano: ${this.formData.plano}.`;
                    }
                    const url = `https://wa.me/244972888585?text=${encodeURIComponent(msg)}`;
                    window.open(url, '_blank');
                }
            };
        }

        document.addEventListener('DOMContentLoaded', () => {
            if (window.lucide) {
                lucide.createIcons();
            }
        });
    </script>
<script src="/worker-public.js"></script>    @include('components.theme-toggle-fab')
</body>
</html>
