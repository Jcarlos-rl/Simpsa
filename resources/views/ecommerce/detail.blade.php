@extends('ecommerce.layout.layout')


@section('ecommercecontent')
    <div class="direction">
        <p>Inicio / Detalles / <span> {{$product->code}} </span></p>
        <hr>
    </div>
    <div class="">
        <div class="row">
            <div class="col-12 col-md-6 content">
                <img class="img-fluid" src="{{$product->info->image}}" alt="">
            </div>
            <div class="col-12 col-md-6 mt-4">
                <p class="title-product">{{$product->title}}</p>
                <div class="product-detail">
                    <p><span>Marca:</span> {{$product->brand->name}}</p>
                    <p><span>Codigo:</span> {{$product->code}}</p>
                    <p>
                        <span>Estatus:</span>
                        @if (count($product->inventories)!=0)
                            @foreach ($product->inventories as $inventary)
                                @if ($inventary->warehouse == 'bodega')
                                    Disponible
                                @endif
                            @endforeach
                        @else
                            Entrega en 7 días hábiles
                        @endif
                    </p>
                </div>
                <div class="product-price">
                    <p><span>Precio:</span> ${{$product->info->price}}</p>
                </div>
                <div class="cantidad">
                    <p><span>Cantidad:</span></p>
                    <input type="number" id="{{$product->id}}" min="1" value="1">
                    <button class="btn btn-primary" onclick="add('{{$product->id}}')">Agregar al carrito</button>
                </div>
                <div class="canales">
                    <p>Otros canales de venta:</p>
                    @if (isset($product->info->url_ml))
                        <a href="{{$product->info->url_ml}}" target="_blank">
                            <img class="img-fluid" width="60" src="{{ URL::to('/images/ml.jpg') }}" alt="">
                        </a>
                    @endif
                    @if (isset($product->info->url_ms))
                        <a href="{{$product->info->url_ms}}" target="_blank">
                            <img class="img-fluid" width="60" src="{{ URL::to('/images/ms.png') }}" alt="">
                        </a>
                    @endif
                    @if (isset($product->info->url_am))
                        <a href="{{$product->info->url_am}}" target="_blank">
                            <img class="img-fluid" width="60" src="{{ URL::to('/images/am.png') }}" alt="">
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <div class="sales">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Descripción</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Datos técnicos</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <br>
                {!! $product->info->description !!}
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <br>
                {!! $product->info->information !!}
            </div>
        </div>
    </div>
    <br>
    <p class="title">Productos en oferta</p>
    <hr>
    <div class="row">
        @foreach($products as $item)
            <div class="col-6 col-sm-3">
                <div class="product">
                    <div class="image">
                        <img class="img-fluid" src="{{$item->info->image}}" alt="">
                    </div>
                    <div class="info">
                        <p class="subtitle text-truncate">{{ $item->title}}</p>
                        <p class="price">${{$item->info->price}}</p>
                        <div class="actions">
                            <div>
                                <a href="{{ route('cart.add',[$item->id,1]) }}">
                                    <i class="fas fa-cart-plus"></i>
                                </a>
                            </div>
                            <div>
                                <a href="{{ route('ecommerce.details', $item->id) }}">
                                    <i class="far fa-eye"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <br>
    <script>
        function add(id){
            var quantity = document.getElementById(id).value;
            window.location = "/cart/add/"+id+"/"+quantity;
        }
    </script>
@endsection
