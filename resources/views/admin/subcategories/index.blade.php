@extends('layouts.app')

@section('content')
    <div class="actions">
        <div class="prin">
            <h2>Subcategorias</h2>
        </div>
        <div class="sec">
            <button data-toggle="modal" data-target="#exampleModal" class="btn btn-primary">Agregar subcategoria</button>
        </div>
    </div>
    <div class="content">
        <p>Todos</p>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subcategories as $subcategory)
                    <tr>
                        <td>{{$subcategory->name}}</td>
                        <td>
                            <div class="dropdown dropleft">
                                <button class="btn dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <form action="{{ route('subcategory.destroy',$subcategory->id) }}" method="POST">
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

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form id="createcategory" action="{{ route('subcategory.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <div class="form-group col-10 col-search">
                            <input type="text" class="form-control @error('price') is-invalid @enderror" id="name" name="name" placeholder="Nueva subcategoria" value="{{ old('name') }}">
                            @error('name')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                        <input type="submit" form="createcategory" class="btn btn-primary" value="Guardar">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
