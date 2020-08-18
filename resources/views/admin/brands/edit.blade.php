@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-sm-10">
            <a href="{{ route('brands.index') }}">
                <p><i class="fas fa-angle-left"></i> Marcas</p>
            </a>
            <h2>Actualizar marca</h2>
            <hr>
            <form action="{{ route('brands.update',$brand->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="content">
                    <div class="container">
                        <div class="row">
                            <div class="form-group col-12 col-sm-9">
                                <label for="name">Nombre</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Nombre del producto" name="name" value="{{ $brand->name }}">
                                @error('name')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-12 col-sm-3">
                                <label for="discount">Descuento</label>
                                <input type="number" step="any" min="0" class="form-control @error('discount') is-invalid @enderror" id="discount" name="discount" value="{{ $brand->discount }}">
                                @error('discount')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="actions-form">
                    <a href="{{ route('brands.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
