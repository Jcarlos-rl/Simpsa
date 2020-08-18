@extends('ecommerce.layout.layout')

@section('ecommercecontent')
    <div class="images">
        <div class="row">
            <div class="col-12 col-sm-7">
                <div class="image">
                    <figure>
                        <img class="img-fluid prin" src="{{ URL::to('/images/1.png') }}" alt="">
                        <figcaption class="prin">
                            <h2>Conoce todas nuestras <span>herramientas</span></h2>
                            <p>Los productos de nuestra tienda son perfectos. Combinación de <span>fiabilidad y durabilidad</span></p>
                            <a href="" class="btn">Ver más</a>
                        </figcaption>
                    </figure>
                </div>
            </div>
            <div class="col-12 col-sm-5">
                <div class="image">
                    <figure>
                        <img class="img-fluid prin" src="{{ URL::to('/images/2.png') }}" alt="">
                        <figcaption>
                            <h2>Herramientas <span>manuales</span></h2>
                            <p>Al suscribirte obtendrás <span>descuentos</span> especiales en esta categoría</p>
                            <a href="" class="btn">Ver más</a>
                        </figcaption>
                    </figure>
                </div>
                <div class="image">
                    <figure>
                        <img class="img-fluid prin" src="{{ URL::to('/images/3.png') }}" alt="">
                        <figcaption>
                            <h2>Herramienta totalmente <span>nueva</span></h2>
                            <p>Con una gran <span>garantía</span> ante defetos de fabricación</p>
                            <a href="" class="btn">Ver más</a>
                        </figcaption>
                    </figure>
                </div>
            </div>
        </div>
    </div>
    <p class="title">Productos destacados</p>
    <hr>
    <div class="row">
        @foreach($destacados as $item)
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

    <div class="images">
        <div class="row">
            <div class="col-12 col-sm-6">
                <div class="image">
                    <figure>
                        <img class="img-fluid sec" src="{{ URL::to('/images/5.png') }}" alt="">
                        <figcaption>
                            <h2>Conoce nuestros productos con grandes <span>descuentos</span></h2>
                            <a href="" class="btn">Ver más</a>
                        </figcaption>
                    </figure>
                </div>
            </div>
            <div class="col-12 col-sm-6">
                <div class="image">
                    <figure>
                        <img class="img-fluid sec" src="{{ URL::to('/images/4.png') }}" alt="">
                        <figcaption>
                            <h2>Conoce nuestros productos de <span>importación</span></h2>
                            <a href="" class="btn">Ver más</a>
                        </figcaption>
                    </figure>
                </div>
            </div>
        </div>
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

    <p class="title">Productos en oferta</p>
    <hr>
    <div class="row">
        @foreach($ofertas as $item)
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

    <div class="newsletter">
        <div class="row">
            <div class="col-12 col-sm-5">
                <form action="{{ route('ecommerce.newsletter','onlineshop') }}" method="POST">
                    @csrf
                    <p class="title">Suscribete a nuestro Newsletter</p>
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="ejemplo@email.com" aria-label="Recipient's username" aria-describedby="button-addon2">
                        @error('email')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Suscribirse</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-12 col-sm-4">
                <p class="title">Beneficios que puedes obtener</p>
                <p>> Descuentos exclusivos</p>
                <p>> Lanzamientos nuevos</p>
            </div>
            <div class="col-12 col-sm-3">
                <p class="title">Siguenos</p>
                <div class="socialMedia">
                    <div>
                        <i class="fab fa-facebook-f"></i>
                    </div>
                    <div>
                        <i class="fab fa-instagram"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
