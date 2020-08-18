@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-sm-10">
            <a href="{{ route('products.index') }}">
                <p><i class="fas fa-angle-left"></i> Productos</p>
            </a>
            <h2>Actualizar producto</h2>
            <hr>
            <form action="{{ route('products.update',$product->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="content">
                    <div class="container">
                        <div class="row">
                            <div class="form-group col-12 col-sm-8">
                                <label for="title">Nombre</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Nombre del producto" name="title" value="{{ $product->title }}">
                                @error('title')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-12 col-sm-4">
                                <label for="code">Codigo</label>
                                <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" placeholder="Codigo del producto" name="code" value="{{ $product->code }}">
                                @error('code')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-12 col-sm-6">
                                <label for="priceDis">Precio Distribuidor</label>
                                <input type="number" step="any" min="0" class="form-control @error('priceDis') is-invalid @enderror" id="priceDis" name="priceDis" value="{{ $product->priceDis }}">
                                @error('priceDis')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-12 col-sm-6">
                                <label for="pricePub">Precio Publico</label>
                                <input type="number" step="any" min="0" class="form-control @error('pricePub') is-invalid @enderror" id="pricePub" name="pricePub" value="{{ $product->pricePub }}">
                                @error('pricePub')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-12 col-sm-6">
                                <label for="brand_id">Marca</label>
                                <select class="form-control @error('brand_id') is-invalid @enderror" name="brand_id">
                                    @foreach($brands as $brand)
                                        <option value="{{$brand->id}}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>{{$brand->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="actions-form">
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
