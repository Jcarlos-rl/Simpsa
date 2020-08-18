<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    @yield('styles')

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    <!-- ----- ----- ----- Fontawesome ----- ----- ----- -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md fixed-top navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="content-main">
            @guest
            @else
                <div class="sidemenu">
                    <div class="options">
                        <a href="{{ route('adminecommerce.index') }}">
                            <div class="option">
                                <i class="fas fa-home"></i>
                                <p>Ecommerce</p>
                            </div>
                            <div
                                class="suboptions
                                {{ Request::is('admin/ecommerce' ) ? 'visible' : '' }}
                                {{ Request::is('admin/ecommerce/*' ) ? 'visible' : '' }}
                            ">
                                <a href="{{ route('adminecommerce.index') }}">
                                    <div class="option
                                        {{ Request::is('admin/ecommerce' ) ? 'selected' : '' }}
                                    ">
                                        <p>Inicio</p>
                                    </div>
                                </a>
                                <a href="{{ route('adminecommerce.products') }}">
                                    <div class="option
                                        {{ Request::is('admin/ecommerce/products' ) ? 'selected' : '' }}
                                        {{ Request::is('admin/ecommerce/products/*' ) ? 'selected' : '' }}
                                    ">
                                        <p>Productos</p>
                                    </div>
                                </a>
                                <a href="{{ route('adminecommercecatalogues.index') }}">
                                    <div class="option
                                        {{ Request::is('admin/ecommerce/catalogues' ) ? 'selected' : '' }}
                                        {{ Request::is('admin/ecommerce/catalogues/*' ) ? 'selected' : '' }}
                                    ">
                                        <p>Catalogos</p>
                                    </div>
                                </a>
                                <a href="{{ route('admininvoice.index') }}">
                                    <div class="option
                                        {{ Request::is('admin/ecommerce/invoices' ) ? 'selected' : '' }}
                                        {{ Request::is('admin/ecommerce/invoices/*' ) ? 'selected' : '' }}
                                    ">
                                        <p>Facturas</p>
                                    </div>
                                </a>
                            </div>
                        </a>
                        <a href="{{ route('products.index') }}">
                            <div class="option">
                                <i class="fas fa-box"></i>
                                <p>Productos</p>
                            </div>
                            <div class="suboptions
                                {{ Request::is('admin/products' ) ? 'visible' : '' }}
                                {{ Request::is('admin/products/*' ) ? 'visible' : '' }}
                            ">
                                <a href="{{ route('products.index') }}">
                                    <div class="option
                                        {{ Request::is('admin/products' ) ? 'selected' : '' }}
                                        {{ Request::is('admin/products/create' ) ? 'selected' : '' }}
                                    ">
                                        <p>Todos los productos</p>
                                    </div>
                                </a>
                                <a href="{{ route('brands.index') }}">
                                    <div class="option
                                        {{ Request::is('admin/products/brands' ) ? 'selected' : '' }}
                                        {{ Request::is('admin/products/brands/*' ) ? 'selected' : '' }}
                                    ">
                                        <p>Marcas</p>
                                    </div>
                                </a>
                                <a href="{{ route('category.index') }}">
                                    <div class="option
                                        {{ Request::is('admin/products/categories' ) ? 'selected' : '' }}
                                        {{ Request::is('admin/products/categories/*' ) ? 'selected' : '' }}
                                    ">
                                        <p>Categorias</p>
                                    </div>
                                </a>
                                <a href="{{ route('subcategory.index') }}">
                                    <div class="option
                                        {{ Request::is('admin/products/subcategories' ) ? 'selected' : '' }}
                                        {{ Request::is('admin/products/subcategories/*' ) ? 'selected' : '' }}
                                    ">
                                        <p>Subcategorias</p>
                                    </div>
                                </a>
                                <a href="{{ route('inventory.index') }}">
                                    <div class="option
                                        {{ Request::is('admin/products/inventory' ) ? 'selected' : '' }}
                                    ">
                                        <p>Inventario</p>
                                    </div>
                                </a>
                                <a href="">
                                    <div class="option
                                        {{ Request::is('admin/products/purchase_orders' ) ? 'selected' : '' }}
                                    ">
                                        <p>Ordenes de compra</p>
                                    </div>
                                </a>
                            </div>
                        </a>
                        <a href="">
                            <div class="option">
                                <i class="fas fa-money-bill-wave"></i>
                                <p>Ventas</p>
                            </div>
                        </a>
                    </div>
                </div>
            @endguest
            <div class="content-body">
                @if (session()->get('success'))
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        {{ session()->get('success')}}
                    </div>
                @endif
                @if (session()->get('error'))
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        {{ session()->get('error')}}
                    </div>
                @endif
                @yield('content')
            </div>
        </main>
    </div>
    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove();
            });
        }, 2000);
    </script>
    @yield('scripts')
</body>
</html>
