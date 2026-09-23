<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8" />
    <meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0" name="viewport">
    <title>Finalizar Pedido - RACHI</title>

    <link rel="stylesheet" href="{{ asset('frontend/css/core.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/skin.css') }}" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
</head>
<body class="shop checkout" x-data="{ method: 'multicaixa' }">
    @include('layouts.partials.side-navigation')

    <div class="wrapper">
        <div class="wrapper-inner">
            @include('layouts.partials.header')

            <div class="section-block pt-140 pb-50 bkg-charcoal color-white">
                <div class="container">
                    <div class="row">
                        <div class="column width-12">
                            <h1 class="font-32 mb-10">Checkout / Pagamento</h1>
                        </div>
                    </div>
                </div>
            </div>

            <section class="section-block pt-60 pb-60 bkg-grey-ultralight">
                <div class="container">
                    <form action="{{ route('checkout.process') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="column width-7">
                                <div class="bg-white p-6 rounded-lg shadow-sm mb-4">
                                    <h4 class="text-xl font-bold text-gray-900 mb-4">1. Dados de Envio e Faturação</h4>
                                    <div class="space-y-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Nome Completo / Empresa *</label>
                                            <input type="text" name="customer_name" required class="w-full px-4 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500">
                                        </div>
                                        <div class="grid grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">NIF / BI *</label>
                                                <input type="text" name="document" required class="w-full px-4 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500">
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Telefone / WhatsApp *</label>
                                                <input type="text" name="phone" required class="w-full px-4 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500">
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Endereço de Entrega *</label>
                                            <input type="text" name="street" placeholder="Rua, Bairro, Município" required class="w-full px-4 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Província *</label>
                                            <select name="city" class="w-full px-4 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500">
                                                <option value="Luanda">Luanda</option>
                                                <option value="Benguela">Benguela</option>
                                                <option value="Huíla">Huíla</option>
                                                <option value="Huambo">Huambo</option>
                                                <option value="Cabinda">Cabinda</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-white p-6 rounded-lg shadow-sm">
                                    <h4 class="text-xl font-bold text-gray-900 mb-4">2. Método de Pagamento</h4>
                                    <div class="space-y-3">
                                        <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-slate-50" :class="method === 'multicaixa' ? 'border-blue-600 bg-blue-50/20' : ''">
                                            <input type="radio" name="payment_method" value="multicaixa" x-model="method" class="text-blue-600 focus:ring-blue-500">
                                            <span class="ml-3 font-medium text-gray-900">Multicaixa Express / Referência</span>
                                        </label>
                                        <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-slate-50" :class="method === 'transfer' ? 'border-blue-600 bg-blue-50/20' : ''">
                                            <input type="radio" name="payment_method" value="manual" x-model="method" class="text-blue-600 focus:ring-blue-500">
                                            <span class="ml-3 font-medium text-gray-900">Transferência Bancária (Comprovativo)</span>
                                        </label>
                                        <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-slate-50" :class="method === 'cash' ? 'border-blue-600 bg-blue-50/20' : ''">
                                            <input type="radio" name="payment_method" value="manual" x-model="method" class="text-blue-600 focus:ring-blue-500">
                                            <span class="ml-3 font-medium text-gray-900">Pagamento no Levantamento</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="column width-5">
                                <div class="bg-white p-6 rounded-lg shadow-sm border border-slate-100">
                                    <h4 class="text-lg font-bold text-gray-900 mb-4 border-b pb-2">Resumo da Encomenda</h4>
                                    <div class="space-y-3 mb-6">
                                        <template x-for="item in $store.cart.items" :key="item.id">
                                            <div class="flex justify-between items-center text-sm">
                                                <span class="text-gray-700" x-text="item.name + ' × ' + item.quantity"></span>
                                                <span class="font-medium text-gray-900" x-text="(item.price * item.quantity).toLocaleString('pt-AO') + ' AOA'"></span>
                                            </div>
                                        </template>
                                        <div class="border-t pt-3 flex justify-between font-bold text-base text-gray-900">
                                            <span>Total</span>
                                            <span class="text-blue-600" x-text="$store.cart.total().toLocaleString('pt-AO') + ' AOA'"></span>
                                        </div>
                                    </div>

                                    <button type="submit" class="w-full py-3 bg-amber-500 hover:bg-amber-600 text-white font-bold rounded-md shadow transition duration-200">
                                        Confirmar e Pagar Pedido
                                    </button>
                                    <p class="text-xs text-gray-500 text-center mt-3">Ao finalizar, você concorda com nossos termos e condições de compra.</p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
        @include('layouts.partials.footer')
    </div>

    <!-- Core JS Files -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="{{ asset('frontend/js/timber.master.min.js') }}"></script>
    @vite(['resources/js/app.js'])
</body>
</html>
