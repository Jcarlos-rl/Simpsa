@extends('ecommerce.layout.layout')


@section('ecommercecontent')
    <div class="direction">
        @if(isset($brand) && Request::is("productos/$brand->name"))
            <p>Inicio / <a style="color: #212529" href="{{ route('ecommerce.products') }}">Productos</a> / <span>{{$brand->name}}</span></p>
        @else
            <p>Inicio / <span>Productos</span></p>
        @endif
        <hr>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="categories">
                        <div class="d-flex justify-content-between" onclick="myFunction()">
                            <p>Marcas </p>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div id="categories">
                            <hr>
                            <ul>
                                @if (isset($brand) && Request::is("productos/$brand->name"))
                                    @foreach ($categories as $category)
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('ecommerce.brand_category',[$brand->name,$category->name]) }}">
                                                {{$category->name}}
                                            </a>
                                        </li>
                                    @endforeach
                                @else
                                    @foreach ($brands as $brand)
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('ecommerce.brand',$brand->name) }}">
                                                {{$brand->name}}
                                            </a>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                    <br>
                </div>
                <div class="col-sm-9">
                    @if(isset($brand) && Request::is("productos/$brand->name"))
                        <p class="title">{{$brand->name}}</p>
                    @else
                        <p class="title">Todos</p>
                    @endif
                    <hr>
                    <div class="row">
                        @foreach ($products as $product)
                            <div class="col-6 col-sm-4">
                                <div class="product">
                                    <div class="image">
                                        @if (isset($product->info))
                                            <img class="img-fluid" src="{{$product->info->image}}" alt="">
                                        @else
                                            <p>No existe</p>
                                        @endif
                                    </div>
                                    <div class="info">
                                        <p class="subtitle text-truncate">{{ $product->title}}</p>
                                        <p class="price">${{$product->info->price}}</p>
                                        <div class="actions">
                                            <div>
                                                <a href="{{ route('cart.add',[$product->id,1]) }}">
                                                    <i class="fas fa-cart-plus"></i>
                                                </a>
                                            </div>
                                            <div>
                                                <a href="{{ route('ecommerce.details', $product->id) }}">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{ $products->links() }}
                </div>
            </div>
        </div>
        <br>
    </div>
    <script>
        function myFunction() {
            if(x.matches){
                var element = document.getElementById("categories");
                if (element.style.display === "none") {
                    element.style.display = "block";
                } else {
                    element.style.display = "none";
                }
            }
        }
        var x = window.matchMedia("(max-width: 700px)")
        myFunction(x)
        x.addListener(myFunction)
    </script>
@endsection
