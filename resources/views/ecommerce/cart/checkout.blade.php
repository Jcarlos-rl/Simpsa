@extends('ecommerce.layout.layout')

@section('ecommercecontent')
    <div class="direction">
        <p>Inicio / Carrito / Envio / <span>Pago</span></p>
        <hr>
    </div>
    <h1 class="text-center">Seleccione su forma de pago</h1>
    <div class="cart">
        <div class="row">
            <div class="col-12 col-sm-8">
                <div class="accordion" id="accordionExample">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <button class="btn btn-block text-left type-payment" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <p>Tarjeta de crédito/débito</p>
                                    <div>
                                        <img src="{{ URL::to('/images/visa.svg') }}" alt="">
                                        <img src="{{ URL::to('/images/master.svg') }}" alt="">
                                        <img src="{{ URL::to('/images/amex.svg') }}" alt="">
                                    </div>
                                </button>
                            </h2>
                        </div>

                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body text-center">
                                <button id="checkout-button" class="btn btn-primary">Finalizar el pedido</button>
                                <br>
                                <p>Luego de hacer clic en “Finalizar el pedido”, serás redirigido para completar tu compra de forma segura.</p>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h2 class="mb-0">
                                <button class="btn btn-block text-left type-payment collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <p>PayPal</p>
                                    <img src="{{ URL::to('/images/paypal.svg') }}" alt="">
                                </button>
                            </h2>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <div class="card-body text-center">
                                <a href="{{ route('paypal.payment') }}" class="btn btn-primary">Finalizar el pedido</a>
                                <p>Luego de hacer clic en “Finalizar el pedido”, serás redirigido para completar tu compra de forma segura.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
            </div>
            <div class="col-12 col-sm-4">
                <div class="total">
                    <p class="title">Pago</p>
                    <p>Subtotal: ${{$subtotal}}</p>
                    <p>Envio: ${{$shipping}}</p>
                    <hr>
                    <p>Total: ${{$shipping+$subtotal}}</p>
                </div>
            </div>
        </div>
    </div>
    <br>
    <script>
        var stripe = Stripe('pk_test_J2MQgJEtjtbvWQvHihWEpvjJ00uq1Gj1Y3');
        var checkoutButton = document.getElementById('checkout-button');
            checkoutButton.addEventListener('click', function() {
            stripe.redirectToCheckout({
                sessionId: '{{$session}}'
            }).then(function (result) {
                console.log(result);
            });
            });
    </script>
@endsection
