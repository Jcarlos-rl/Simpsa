@extends('layouts.app')

@section('content')
    <div class="actions">
        <div class="prin">
            <a href="{{ route('adminecommerce.products') }}">
                <p><i class="fas fa-angle-left"></i> Productos</p>
            </a>
            <h2>Producto {{$product->title}}</h2>
        </div>
        <div class="sec">
            <button data-toggle="modal" data-target="#exampleModal" class="btn btn-primary">Agregar categoria</button>
        </div>
    </div>
    <div class="content">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10">
                <h2>Categorias a las que pertenece</h2>
                <br>
                @if(count($product->categories) == 0)
                    <p class="text-center"><i class="fas fa-exclamation-triangle"></i> El producto no pertenece a ninguna categoria </p>
                @else
                    @foreach ($product->categories as $category)
                        <form action="{{ route('category.destroycategory',[$product->id,$category->id]) }}" method="POST">
                            @csrf
                            <div class="container">
                                <div class="row">
                                    <div class="label col-3" id="label">
                                        <div class="label-active">
                                            <button type="submit" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <p>{{ $category->name }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @endforeach
                @endif
                <h2>Categorias disponibles</h2>
                <br>
                @if (count($product->categories) == count($categories))
                    <p class="text-center"><i class="fas fa-exclamation-triangle"></i> El producto ya pertenece a todas las categorías </p>
                @else
                    <form id="savecategory" action="{{ route('category.savecategory',$product->id) }}" method="POST">
                        @csrf
                        <div class="check">
                            @foreach ($categories as $category)
                                @if (!$product->categories->contains($category->id))
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="{{ $category->id }}" name="categories[]" value="{{ $category->id }}">
                                        <label class="form-check-label" for="inlineCheckbox1">{{ $category->name }}</label>
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

    <div class="content">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10">
                <h2>Subcategorias a las que pertenece</h2>
                <br>
                @if(count($product->subcategories) == 0)
                    <p class="text-center"><i class="fas fa-exclamation-triangle"></i> El producto no pertenece a ninguna subcategoria </p>
                @else
                    <form action="{{ route('subcategory.destroysubcategory_product',$product->id) }}" method="POST">
                        @csrf
                        <div class="container">
                            <div class="row">
                            @foreach ($subcategories as $subcategory)
                                @if ($product->subcategories->contains($subcategory->id))
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
                @if (count($product->subcategories) == count($subcategories))
                    <p class="text-center"><i class="fas fa-exclamation-triangle"></i> El producto ya pertenece a todas las subcategorías </p>
                @else
                    <form id="savesubcategory" action="{{ route('subcategory.savesubcategory_product',$product->id) }}" method="POST">
                        @csrf
                        <div class="check">
                            @foreach ($product->categories as $category)
                                <h4>Subcategorias de {{$category->name}}</h4>
                                @foreach ($category->subcategories as $subcategory)
                                    @if (!$product->subcategories->contains($subcategory->id))
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="{{ $subcategory->id }}" name="subcategories[]" value="{{ $subcategory->id }}">
                                            <label class="form-check-label" for="inlineCheckbox1">{{ $subcategory->name }}</label>
                                        </div>
                                    @endif
                                @endforeach
                                <br>
                            @endforeach
                        </div>
                        <div class="modal-footer">
                            <a href="{{ route('adminecommerce.products') }}" class="btn btn-secondary" data-dismiss="modal">Cancelar</a>
                            <button type="submit" form="savesubcategory" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form id="createcategory" action="{{ route('category.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <div class="form-group col-10 col-search">
                            <input type="text" class="form-control @error('price') is-invalid @enderror" id="name" name="name" placeholder="Nueva categoria" value="{{ old('name') }}">
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
