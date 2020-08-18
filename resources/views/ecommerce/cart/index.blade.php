@extends('ecommerce.layout.layout')
@section('ecommercecontent')
        <div class="direction">
            <p>Inicio / <span>Carrito</span></p>
            <hr>
        </div>
        <h1 class="text-center">Mi Carrito</h1>
        <div class="cart">
            @if(count($cart)==null)
                <div class="message">
                    <p><i class="fas fa-exclamation-triangle"></i> Lo sentimos, tú carrito esta vacio</p>
                </div>
                <div class="buttons">
                    <a href="{{ route('ecommerce.index') }}" class="btn"><i class="fas fa-arrow-left"></i> Regresar a la tienda</a>
                </div>
                <br>
            @else
            <div class="row">
                <div class="col-12 col-sm-8">
                    <div class="description">
                        <div class="table-responsive">
                            <table class="table table-cart">
                                <thead class="thead-cart">
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col">
                                            <p>
                                                Producto
                                            </p>
                                        </th>
                                        <th scope="col">
                                            <p>
                                                Precio
                                            </p>
                                        </th>
                                        <th scope="col">
                                            <p>
                                                Cantidad
                                            </p>
                                        </th>
                                        <th scope="col">
                                            <p>
                                                Subtotal
                                            </p>
                                        </th>
                                        <th></th>
                                    </tr>
                                </thead class="tbody-cart">
                                <tbody>
                                    @foreach($cart as $item)
                                    <tr>
                                        <td>
                                            <img width="50" src="storage/{{$item->image}}" alt="">
                                        </td>
                                        <td>
                                            <p>
                                                {{$item->title}}
                                            </p>
                                        </td>
                                        <td>
                                            <p>
                                                ${{$item->price}}
                                            </p>
                                        </td>
                                        <td>
                                            <div style="display: flex">
                                                <input type="number" id="{{$item->id}}" min="1" value="{{$item->quantity}}">
                                                <button class="btn" onclick="update('{{$item->id}}')"><i class="fas fa-redo-alt"></i></button>
                                            </div>
                                        </td>
                                        <td>
                                            <p>
                                                ${{$item->price*$item->quantity}}
                                            </p>
                                        </td>
                                        <td>
                                            <a href="{{ route('cart.delete',$item->id) }}">
                                                <i class="far fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="cupon">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Ingresar cupon" aria-label="Recipient's username" aria-describedby="button-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" id="button-addon2">Aplicar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="buttons">
                        <a href="{{ route('ecommerce.index') }}" class="btn"><i class="fas fa-arrow-left"></i> Continuar comprando</a>
                        <a href="{{ route('cart.trash') }}" class="btn"><i class="far fa-trash-alt"></i> Vaciar carrito</a>
                    </div>
                    <br>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="total">
                        <p class="title">Total carrito</p>
                        <p>Total:     ${{$subtotal}}</p>
                        <a href="{{ route('ecommerce.shipping') }}" class="btn"><i class="fas fa-dolly"></i> Proceder al envió</a>
                    </div>
                </div>
            </div>
            @endif
        </div>
    <script>
        function update(id){
            var quantity = document.getElementById(id).value;
            window.location = "/cart/add/"+id+"/"+quantity;
        }
    </script>
@endsection
