<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <script src="https://js.stripe.com/v3/"></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    @yield('styles')

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    <!-- ----- ----- ----- Fontawesome ----- ----- ----- -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

    @yield("recaptcha")
</head>
<body>
    @if (session()->get('success'))
        <div class="alert alert-success alart-ecommerce" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{ session()->get('success')}}
        </div>
    @endif
    @if (session()->get('error'))
        <div class="alert alert-danger alart-ecommerce" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{ session()->get('error')}}
        </div>
    @endif
    <div class="icons">
        <div class="container">
            <div class="col-4 col-sm-4">
                <a href="#"><i class="far fa-envelope"></i></a>
                <p>ventas@industrialessimpsa.com</p>
            </div>
            <div class="col-4 col-sm-4">
                <a href="#"><i class="fas fa-phone"></i></a>
                <p>2229105418</p>
            </div>
            <div class="col-4 col-sm-4">
                <a href=""><i class="fab fa-whatsapp"></i></a>
                <p>2229105418</p>
            </div>
        </div>
    </div>
    <div class="logo">
        <div class="container">
            <div class="col-7 col-sm-6">
                <a href="{{ route('ecommerce.index') }}">
                    <img src="{{ URL::to('/images/logo.png') }}" alt="Industriales Simpsa"/>
                </a>
                <h1>SIMPSA</h1>
            </div>
            <div class="col-5 col-sm-6">
                <a href="{{ route('ecommerce.cart') }}">
                    <i class="fas fa-shopping-cart"></i>
                </a>
                <span>@if ( ($cart))
                    {{count($cart)}}
                @else
                    0
                @endif</span>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('ecommerce.index') }}">Inicio </a>
                </li>
                <li class="nav-item {{ Request::is('productos') ? 'active' : '' }}
                {{ Request::is('productos/*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('ecommerce.products') }}">Productos</a>
                </li>
                <li class="nav-item {{ Request::is('catalogos') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('ecommerce.catalogue') }}">Catalogos</a>
                </li>
                <li class="nav-item {{ Request::is('contacto') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('ecommerce.contact') }}">Contacto</a>
                </li>
                </ul>
                {{-- <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"/>
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form> --}}
            </div>
        </div>
    </nav>
    <div class="container">
        @yield('ecommercecontent')
    </div>
    <footer>
        <div class="container">
            <!-- <div class="row oneContainer">
                <div class="col-12">
                    <div>
                        <a href="#"><i class="far fa-envelope"></i></a>
                        <p>ventas@industrialessimpsa.com</p>
                    </div>
                    <div>
                        <a href="#"><i class="fas fa-phone"></i></a>
                        <p>2229105418</p>
                    </div>
                </div>
            </div> -->
            <div class="row twoContainer">
                <div class="col-12">
                    <div>
                        <p>
                            Copyright © 2020 Industriales Simpsa
                        </p>
                    </div>
                    <div>
                        <img src="{{ URL::to('/images/ecommerce/visa.webp') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove();
            });
        }, 4000);
    </script>
</body>
</html>
