@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.css" integrity="sha512-pTg+WiPDTz84G07BAHMkDjq5jbLS/AqY0rU/QdugnfeE0+zu0Kjz++0rrtYNK9gtzEZ33p+S53S2skXAZttrug==" crossorigin="anonymous" />
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-sm-10">
            <a href="{{ route('adminecommerce.products') }}">
                <p><i class="fas fa-angle-left"></i> Productos</p>
            </a>
            <h2>Asignar información al producto {{ $product->code }}</h2>
            <hr>
            <form action="{{ route('infoproduct.store', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="content">
                    <div class="container">
                        <div class="row">
                            <div class="col-4">
                                <p>Precio distribuidor: {{ $product->priceDis }}</p>
                            </div>
                            <div class="col-4">
                                <p>Precio publico: {{ $product->pricePub }}</p>
                            </div>
                            <div class="col-4">
                                <p>Precio sugerido: {{ round($product->pricePub/1.05) }}</p>
                            </div>

                            <div class="form-group col-12 col-sm-2 mt-4">
                                <label for="price">Precio</label>
                                <input type="number" step="any" min="0" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price',round($product->pricePub/1.05)) }}">
                                @error('price')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-12 col-sm-5 mt-4">
                                <label for="image">Imagen URL</label>
                                <input type="text" class="form-control @error('image') is-invalid @enderror" id="image" name="image" value="{{ old('image')}}">
                                @error('image')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-12 col-sm-5 mt-4">
                                <label for="image">Imagen</label>
                                <input type="file" class="form-control form-control-image @error('image') is-invalid @enderror" id="image" name="image" value="{{ old('image') }}">
                                @error('image')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-12 col-sm-12 mt-2">
                                <label for="description">Descripción del producto</label>
                                <input type="hidden" name="description" id="description" value="{{ old('nombre' )}}">
                                <trix-editor class="form-control @error('description') is-invalid @enderror"  input="description"></trix-editor>

                                @error('description')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-12 col-sm-12 mt-2">
                                <label for="information">Información técnica</label>
                                <input type="hidden"  id="information" placeholder="Nombre del producto" name="information" value="{{ old('nombre' )}}">

                                <trix-editor class="form-control @error('information') is-invalid @enderror" input="information"></trix-editor>

                                @error('information')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-12 col-sm-4 mt-4">
                                <label for="url_ml">URL Mercado Libre</label>
                                <input type="text" class="form-control @error('url_ml') is-invalid @enderror" id="url_ml" name="url_ml" value="{{ old('url_ml')}}">
                                @error('url_ml')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-12 col-sm-4 mt-4">
                                <label for="url_am">URL Amazon</label>
                                <input type="text" class="form-control @error('url_am') is-invalid @enderror" id="url_am" name="url_am" value="{{ old('url_am')}}">
                                @error('url_am')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-12 col-sm-4 mt-4">
                                <label for="url_ms">URL Mercado Shop</label>
                                <input type="text" class="form-control @error('url_ms') is-invalid @enderror" id="url_ms" name="url_ms" value="{{ old('url_ms')}}">
                                @error('url_ms')
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
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.js" integrity="sha512-EkeUJgnk4loe2w6/w2sDdVmrFAj+znkMvAZN6sje3ffEDkxTXDiPq99JpWASW+FyriFah5HqxrXKmMiZr/2iQA==" crossorigin="anonymous" defer></script>
@endsection
