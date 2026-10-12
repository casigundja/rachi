window.rachiCapitalForm = function (options = {}) {
    return {
        formSubmitted: false, formSubmitting: false, formError: '', formProtocol: '',
        formData: {nome:'', empresa:'', telefone:'', email:'', plano:options.plano || '', detalhes:''},
        capitalService: options.servico || 'Consultoria Human Capital', capitalServiceSlug: options.service_slug || '',
        async submitForm() {
            if (this.formSubmitting || this.formSubmitted) return;
            this.formError = '';
            if (!this.formData.nome.trim() || !this.formData.telefone.trim()) {
                this.formError = 'Preencha o nome e o contacto telefónico.';
                return;
            }
            this.formSubmitting = true;
            try {
                const response = await fetch('/api/capital/solicitar-cotacao', {
                    method:'POST', credentials:'same-origin',
                    headers:{'Content-Type':'application/json', 'Accept':'application/json'},
                    body:JSON.stringify({...this.formData, servico:this.capitalService, service_slug:this.capitalServiceSlug}),
                });
                const result = await response.json();
                if (!response.ok || !result.success || !result.protocol) {
                    this.formError = result.errors ? Object.values(result.errors).flat().join(' ') : (result.message || 'Não foi possível registar a solicitação.');
                    return;
                }
                this.formProtocol = result.protocol;
                this.formSubmitted = true;
                const channel = typeof BroadcastChannel !== 'undefined' ? new BroadcastChannel('rachi_request_channel') : null;
                if (channel) { channel.postMessage({unit:'capital', protocol:result.protocol}); channel.close(); }
            } catch (error) {
                this.formError = 'Não foi possível comunicar com o servidor. Tente novamente.';
            } finally {
                this.formSubmitting = false;
            }
        },
    };
};
