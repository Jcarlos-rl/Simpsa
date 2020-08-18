@extends('ecommerce.layout.layout')


@section('ecommercecontent')
    <div class="direction">
        @if(Request::is("productos/$brand->name/$category->name"))
            <p>Inicio / <a style="color: #212529" href="{{ route('ecommerce.products') }}">Productos</a> / <a style="color: #212529" href="{{ route('ecommerce.brand',$brand->name) }}">{{$brand->name}}</a> / <span>{{$category->name}}</span></p>
        @else
            <p>Inicio / <a style="color: #212529" href="{{ route('ecommerce.products') }}">Productos</a> / <a style="color: #212529" href="{{ route('ecommerce.brand',$brand->name) }}">{{$brand->name}}</a> / <a style="color: #212529" href="{{ route('ecommerce.brand_category',[$brand->name,$category->name]) }}">{{$category->name}}</a> / <span>{{$subcategory->name}}</span></p>
        @endif
        <hr>
        <div class="container">
            <div class="row">
                @if (Request::is("productos/$brand->name/$category->name"))
                    <div class="col-sm-3">
                        <div class="categories">
                            <div class="d-flex justify-content-between" onclick="myFunction()">
                                <p>Categorias </p>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div id="categories">
                                <hr>
                                <ul>
                                    @foreach ($subcategories as $subcategory)
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('ecommerce.brand_category_subcategory',[$brand->name,$category->name,$subcategory->name]) }}">
                                                {{$subcategory->name}}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <hr>
                        <div class="row">
                            @foreach ($products as $product)
                                <div class="col-6 col-sm-4">
                                    <div class="product">
                                        <div class="image">
                                            <img class="img-fluid" src="{{$product->info->image}}" alt="">
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
                @else
                    @foreach ($products as $product)
                        <div class="col-6 col-sm-3">
                            <div class="product">
                                <div class="image">
                                    <img class="img-fluid" src="{{$product->info->image}}" alt="">
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
                    {{ $products->links() }}
                @endif
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
