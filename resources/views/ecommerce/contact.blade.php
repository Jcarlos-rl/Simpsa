@extends('ecommerce.layout.layout')

@section('recaptcha')
    {!! htmlScriptTagJsApi(['action' => 'homepage']) !!}
@endsection

@section('ecommercecontent')
    <div class="direction">
        <p>Inicio / <span>Contacto</span></p>
        <hr>
    </div>
    <div class="sales">
        <p class="text-center">Visitas nuestros canales de venta</p>
        <hr>
        <div class="row">
            <div class="col-12 col-sm-4">
                <div class="ml center">
                    <a href="">
                        <img src="{{ URL::to('/images/ml.jpg') }}" alt="">
                        <p>Mercado Libre</p>
                    </a>
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="ms">
                    <a href="">
                        <img src="{{ URL::to('/images/ms.png') }}" alt="">
                        <p>Mercado Shop</p>
                    </a>
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="am">
                    <a href="">
                        <img src="{{ URL::to('/images/am.png') }}" alt="">
                        <p>Amazon</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="contact">
        <div class="form">
            <div class="message">
                <p class="text-center">Envianos un mensaje</p>
                <i class="fas fa-envelope-open-text"></i>
            </div>
            <br>
            <form action="{{ route('ecommerce.contactform') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-sm-6 col-12">
                        <div class="form-group">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Nombre" name="name">
                            @error('name')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6 col-12">
                        <div class="form-group">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="E-mail" name="email">
                            @error('email')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6 col-6">
                        <div class="form-group">
                            <input type="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Teléfono" name="phone">
                            @error('phone')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6 col-6">
                        <div class="form-group">
                            <input type="text" class="form-control @error('affair') is-invalid @enderror" placeholder="Asunto" name="affair">
                            @error('affair')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <textarea class="form-control @error('message') is-invalid @enderror" placeholder="Mensaje" name="message" rows="3"></textarea>
                            @error('message')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                        <button class="btn"><i class="far fa-paper-plane"></i> Enviar</button>
                    </div>
                </div>
            </form>
            <br>
        </div>
    </div>
@endsection
