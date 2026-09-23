<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8" />
    <meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0" name="viewport">
    <title>Carrinho de Compras - RACHI</title>

    <link rel="stylesheet" href="{{ asset('frontend/css/core.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/skin.css') }}" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
</head>
<body class="shop cart" x-data>
    @include('layouts.partials.side-navigation')

    <div class="wrapper">
        <div class="wrapper-inner">
            @include('layouts.partials.header')

            <!-- Title Section -->
            <div class="section-block pt-140 pb-50 bkg-charcoal color-white">
                <div class="container">
                    <div class="row items">
                        <div class="column width-12">
                            <h1 class="font-32 mb-10">Carrinho de Compras</h1>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cart Section -->
            <section class="section-block cart-overview">
                <div class="container">
                    <div class="row">
                        <div class="column width-12">
                            <div class="cart-product-list">
                                <form action="#" method="post">
                                    <table class="table-cart">
                                        <thead>
                                        <tr>
                                            <th class="product-remove"></th>
                                            <th class="product-thumbnail"></th>
                                            <th class="product-name"><span class="table-title">Produto</span></th>
                                            <th class="product-price"><span class="table-title">Preço</span></th>
                                            <th class="product-quantity"><span class="table-title">Qtd</span></th>
                                            <th class="product-subtotal"><span class="table-title">Total</span></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <template x-if="$store.cart.items.length === 0">
                                                <tr>
                                                    <td colspan="6" class="text-center py-5">
                                                        <p class="lead mb-4">O seu carrinho está vazio no momento.</p>
                                                        <a href="{{ route('loja') }}" class="button rounded bkg-theme color-white bkg-hover-navy">Ver Produtos da Loja</a>
                                                    </td>
                                                </tr>
                                            </template>
                                            <template x-for="item in $store.cart.items" :key="item.id">
                                                <tr class="cart-item">
                                                    <td class="product-remove pb-10">
                                                        <a href="#" @click.prevent="$store.cart.remove(item.id)" class="product-remove-icon"><span class="icon-cancel"></span></a>
                                                    </td>
                                                    <td class="product-thumbnail pb-10">
                                                        <a href="#">
                                                            <img :src="item.image || '{{ asset('frontend/images/shop/cart-product-thumb.jpg') }}'" :alt="item.name" style="width: 70px; height: 70px; object-fit: cover;" />
                                                        </a>
                                                    </td>
                                                    <td class="product-name pb-10">
                                                        <a href="#" class="product-title color-charcoal" x-text="item.name"></a>
                                                    </td>
                                                    <td class="product-price pb-10">
                                                        <span class="amount" x-text="item.price.toLocaleString('pt-AO') + ' AOA'"></span>
                                                    </td>
                                                    <td class="product-quantity pb-10">
                                                        <div class="quantity">
                                                            <input type="button" value="-" class="minus" @click="if(item.quantity > 1) { item.quantity--; $store.cart.save(); }">
                                                            <input type="number" step="1" min="1" :value="item.quantity" title="Qty" class="qty" size="4" readonly>
                                                            <input type="button" value="+" class="plus" @click="item.quantity++; $store.cart.save();">
                                                        </div>
                                                    </td>
                                                    <td class="product-subtotal pb-10">
                                                        <span class="amount" x-text="(item.price * item.quantity).toLocaleString('pt-AO') + ' AOA'"></span>
                                                    </td>
                                                </tr>
                                            </template>
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>

                        <div class="column width-8">
                            <div class="cart-actions">
                                <a href="{{ route('loja') }}" class="button rounded border-grey-light color-grey-ultradark bkg-hover-theme color-hover-white left">Continuar Comprando</a>
                            </div>
                        </div>

                        <div class="column width-4">
                            <div class="cart-totals">
                                <h3>Total no Carrinho</h3>
                                <table class="table-cart-total">
                                    <tbody>
                                        <tr class="cart-subtotal">
                                            <th>Subtotal</th>
                                            <td><span class="amount" x-text="$store.cart.total().toLocaleString('pt-AO') + ' AOA'"></span></td>
                                        </tr>
                                        <tr class="shipping">
                                            <th>Envio</th>
                                            <td>Sob Consulta / Grátis</td>
                                        </tr>
                                        <tr class="order-total">
                                            <th>Total</th>
                                            <td><strong><span class="amount" x-text="$store.cart.total().toLocaleString('pt-AO') + ' AOA'"></span></strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="proceed-to-checkout">
                                    <a href="{{ route('checkout') }}" class="button rounded full-width bkg-theme color-white bkg-hover-navy mb-0">Finalizar Encomenda</a>
                                </div>
                            </div>
                        </div>
                    </div>
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
