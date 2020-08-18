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
            <button data-toggle="modal" data-target="#exampleModal" class="btn btn-primary">Agregar etiqueta</button>
        </div>
    </div>
    <div class="content">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10">
                <h2>Etiquetas a las que pertenece</h2>
                <br>
                @if(count($product->labels) == 0)
                    <p class="text-center"><i class="fas fa-exclamation-triangle"></i> El producto no pertenece a ninguna etiqueta </p>
                @else
                    <form action="{{ route('label.destroy',$product->id) }}" method="POST">
                        @csrf
                        <div class="container">
                            <div class="row">
                            @foreach ($labels as $label)
                                @if ($product->labels->contains($label->id))
                                    <div class="label col-3" id="label">
                                        <div class="label-active">
                                            <input type="hidden" name="label" value="{{$label->id}}">
                                            <button type="submit" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <p>{{ $label->name }}</p>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            </div>
                            <br>
                        </div>
                    </form>
                @endif
                <h2>Etiquetas disponibles</h2>
                <br>
                @if (count($product->labels) == count($labels))
                    <p class="text-center"><i class="fas fa-exclamation-triangle"></i> El producto ya pertenece a todas las etiquetas </p>
                @else
                    <form id="savelabel" action="{{ route('label.save',$product->id) }}" method="POST">
                        @csrf
                        <div class="check">
                            @foreach ($labels as $label)
                                @if (!$product->labels->contains($label->id))
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="{{ $label->id }}" name="labels[]" value="{{ $label->id }}">
                                        <label class="form-check-label" for="inlineCheckbox1">{{ $label->name }}</label>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <div class="modal-footer">
                            <a href="{{ route('adminecommerce.products') }}" class="btn btn-secondary" data-dismiss="modal">Cancelar</a>
                            <button type="submit" form="savelabel" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form id="createlabel" action="{{ route('label.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <div class="form-group col-10 col-search">
                            <input type="text" class="form-control @error('price') is-invalid @enderror" id="name" name="name" placeholder="Nueva etiqueta" value="{{ old('name') }}">
                            @error('name')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                        <input type="submit" form="createlabel" class="btn btn-primary" value="Guardar">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
