<section id="solicitar-cotacao" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="rachiCapitalForm()">
    <div class="max-w-3xl mx-auto bg-white dark:bg-[#071326] rounded-3xl border border-slate-200 dark:border-slate-700 p-6 sm:p-8">
        <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Solicitar Consultoria Human Capital</h2>
        <p class="text-sm text-slate-600 dark:text-slate-300 mt-2 mb-6">Conte-nos o que a sua empresa precisa. A nossa equipa entrará em contacto.</p>
        <form x-show="!formSubmitted" @submit.prevent="submitForm()" class="space-y-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <label class="text-sm text-slate-700 dark:text-slate-300">Nome Completo *<input required maxlength="255" x-model="formData.nome" type="text" autocomplete="name" class="w-full mt-1 p-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-[#071326] text-slate-900 dark:text-white"></label>
                <label class="text-sm text-slate-700 dark:text-slate-300">Empresa / Organização<input maxlength="255" x-model="formData.empresa" type="text" autocomplete="organization" class="w-full mt-1 p-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-[#071326] text-slate-900 dark:text-white"></label>
                <label class="text-sm text-slate-700 dark:text-slate-300">Contacto Telefónico / WhatsApp *<input required maxlength="40" x-model="formData.telefone" type="tel" autocomplete="tel" class="w-full mt-1 p-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-[#071326] text-slate-900 dark:text-white"></label>
                <label class="text-sm text-slate-700 dark:text-slate-300">E-mail Corporativo<input maxlength="255" x-model="formData.email" type="email" autocomplete="email" class="w-full mt-1 p-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-[#071326] text-slate-900 dark:text-white"></label>
            </div>
            <label class="block text-sm text-slate-700 dark:text-slate-300">Serviço pretendido
                <select x-model="capitalServiceSlug" @change="capitalService = $event.target.selectedOptions[0].textContent.trim()" class="w-full mt-1 p-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-[#071326] text-slate-900 dark:text-white">
                    <option value="">Consultoria Human Capital</option>
                    @foreach($capitalServices as $capitalService)
                        <option value="{{ $capitalService['slug'] }}">{{ $capitalService['title'] }}</option>
                    @endforeach
                </select>
            </label>
            <label class="block text-sm text-slate-700 dark:text-slate-300">Plano / Opção de interesse<input maxlength="255" x-model="formData.plano" type="text" class="w-full mt-1 p-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-[#071326] text-slate-900 dark:text-white"></label>
            <label class="block text-sm text-slate-700 dark:text-slate-300">Detalhes da Solicitação<textarea maxlength="3000" x-model="formData.detalhes" rows="4" class="w-full mt-1 p-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-[#071326] text-slate-900 dark:text-white"></textarea></label>
            <p x-show="formError" x-text="formError" role="alert" class="text-sm text-red-600 dark:text-red-400"></p>
            <button type="submit" :disabled="formSubmitting" class="btn-cta-emerald cursor-pointer disabled:opacity-50" x-text="formSubmitting ? 'A enviar…' : 'Submeter Solicitação'"></button>
        </form>
        <div x-show="formSubmitted" x-cloak class="py-6 text-center text-slate-700 dark:text-slate-300">
            <h3 class="text-xl font-bold text-slate-900 dark:text-white">Solicitação Registada!</h3>
            <p class="mt-2">A nossa equipa entrará em contacto.</p>
            <p class="mt-3">Protocolo: <strong x-text="formProtocol"></strong></p>
            <button type="button" @click="formSubmitted = false; formProtocol = ''" class="btn-cta-emerald mt-4">Novo Pedido</button>
        </div>
    </div>
</section>
