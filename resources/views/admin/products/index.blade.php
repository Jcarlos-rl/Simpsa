@extends('layouts.app')

@section('content')
    <div class="actions">
        <div class="prin">
            <h2>Productos</h2>
        </div>
        <div class="sec">
            <a href="{{ route('products.create') }}" class="btn btn-primary">Agregar producto</a>
        </div>
    </div>
    <div class="content">
        <p>Todos</p>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Producto</th>
                    <th scope="col">Precio Distribuidor</th>
                    <th scope="col">Precio Publico</th>
                    <th scope="col">Marca</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>
                            <a href="{{ route('products.show',$product->id)}}">
                                {{$product->title}}
                            </a>
                        </td>
                        <td>{{$product->priceDis}}</td>
                        <td>{{$product->pricePub}}</td>
                        <td>{{$product->brand->name}}</td>
                        <td>
                            <div class="dropdown dropleft">
                                <button class="btn dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('products.edit',$product->id) }}">Editar</a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" class="dropdown-item" value="Eliminar">
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $products->links() }}
    </div>
@endsection
