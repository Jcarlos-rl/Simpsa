@extends('layouts.app')

@section('content')
    <div class="actions">
        <div class="prin">
            <a href="{{ route('category.index') }}">
                <p><i class="fas fa-angle-left"></i> Subcategorias</p>
            </a>
            <h2>Categoria {{$category->name}}</h2>
        </div>
        <div class="sec">
            <button data-toggle="modal" data-target="#exampleModal" class="btn btn-primary">Agregar subcategoria</button>
        </div>
    </div>
    <div class="content">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10">
                <h2>Subcategorias</h2>
                <br>
                @if(count($category->subcategories) == 0)
                    <p class="text-center"><i class="fas fa-exclamation-triangle"></i> La categoria aún no tiene subcategorias </p>
                @else
                    <form action="{{ route('subcategory.destroysubcategory',$category->id) }}" method="POST">
                        @csrf
                        <div class="container">
                            <div class="row">
                            @foreach ($subcategories as $subcategory)
                                @if ($category->subcategories->contains($subcategory->id))
                                    <div class="label col-3" id="label">
                                        <div class="label-active">
                                            <input type="hidden" name="subcategory" value="{{$subcategory->id}}">
                                            <button type="submit" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <p>{{ $subcategory->name }}</p>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            </div>
                            <br>
                        </div>
                    </form>
                @endif
                <h2>Subcategorias disponibles</h2>
                <br>
                @if (count($category->subcategories) == count($subcategories))
                    <p class="text-center"><i class="fas fa-exclamation-triangle"></i> La categoria ya contiene todas las subcategorias </p>
                @else
                    <form id="savecategory" action="{{ route('subcategory.savesubcategory',$category->id) }}" method="POST">
                        @csrf
                        <div class="check">
                            @foreach ($subcategories as $subcategory)
                                @if (!$category->subcategories->contains($subcategory->id))
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="{{ $subcategory->id }}" name="subcategories[]" value="{{ $subcategory->id }}">
                                        <label class="form-check-label" for="inlineCheckbox1">{{ $subcategory->name }}</label>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <div class="modal-footer">
                            <a href="{{ route('adminecommerce.products') }}" class="btn btn-secondary" data-dismiss="modal">Cancelar</a>
                            <button type="submit" form="savecategory" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
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
