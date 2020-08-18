@extends('layouts.app')

@section('content')
    <div class="actions">
        <div class="prin">
            <h2>Marcas</h2>
        </div>
        <div class="sec">
            <a href="{{ route('brands.create') }}" class="btn btn-primary">Agregar marca</a>
        </div>
    </div>
    <div class="content">
        <p>Todos</p>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Marca</th>
                    <th scope="col">Descuento</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($brands as $brand)
                    <tr>
                        <td>{{$brand->name}}</td>
                        <td>{{$brand->discount}}</td>
                        <td>
                            <div class="dropdown dropleft">
                                <button class="btn dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('brands.edit',$brand->id) }}">Editar</a>
                                    <a class="dropdown-item" href="{{ route('categorybrand.index',$brand->id) }}">Categorias</a>
                                    <form action="{{ route('brands.destroy', $brand->id) }}" method="POST">
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
    </div>
@endsection
