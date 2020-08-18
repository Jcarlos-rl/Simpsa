@extends('layouts.app')

@section('content')
    <div class="actions">
        <div class="prin">
            <h2>Catalogos de la tienda en linea</h2>
        </div>
        <div class="sec">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Agregar Catalogo
            </button>
        </div>
    </div>
    <div class="content">
        <p>Todos</p>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Titulo</th>
                    <th scope="col">Archivo</th>
                    <th scope="col">Imagen</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($catalogues as $catalogue)
                    <tr>
                        <td>
                            {{$catalogue->title}}
                        </td>
                        <td>
                            <a href="/storage/{{$catalogue->pdf}}" target="_blanck">Archivo</a>
                        </td>
                        <td>
                            <a href="/storage/{{$catalogue->img}}" target="_blanck">Archivo</a>
                        </td>
                        <td>
                            <div class="dropdown dropleft">
                                <button class="btn dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="">Editar</a>
                                    <form action="{{ route('adminecommercecatalogues.destroy', $catalogue->id) }}" method="POST">
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
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo catalogo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('adminecommercecatalogues.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group col-12 col-sm-12">
                            <label for="title">Titulo</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}">
                            @error('title')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-12 col-sm-12">
                            <label for="pdf">Archivo PDF</label>
                            <input type="file" class="form-control form-control-image @error('pdf') is-invalid @enderror" id="pdf" name="pdf" value="{{ old('pdf') }}">
                            @error('pdf')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-12 col-sm-12">
                            <label for="img">Imagen</label>
                            <input type="file" class="form-control form-control-image @error('img') is-invalid @enderror" id="img" name="img" value="{{ old('img') }}">
                            @error('img')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
