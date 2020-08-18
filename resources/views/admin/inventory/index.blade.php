@extends('layouts.app')

@section('content')
    <div class="actions">
        <div class="prin">
            <h2>Inventario</h2>
        </div>
        <div class="sec">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Agregar producto
            </button>
        </div>
    </div>
    <div class="content">
        <p>Todos</p>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Producto</th>
                    <th scope="col">Marca</th>
                    <th scope="col">Stock</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    @if (count($product->inventories) != 0)
                        <tr>
                            <td>
                                <a href="">
                                    {{$product->title}}
                                </a>
                            </td>
                            <td>
                                {{$product->brand->name}}
                            </td>
                            <td>
                                @foreach ($product->inventories as $inventory)
                                    {{$inventory->warehouse}}: {{$inventory->quantity}}
                                @endforeach
                            </td>
                            <td>
                                @foreach ($product->inventories as $inventory)
                                    <div class="dropdown dropleft">
                                        <button class="btn dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" data-toggle="modal" data-target="#edit{{$inventory->id}}">Editar</a>
                                            <form action="{{ route('inventory.destroy',$inventory->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <input type="submit" class="dropdown-item" value="Eliminar">
                                            </form>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="edit{{$inventory->id}}" tabindex="-1" role="dialog" aria-labelledby="editLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    Editar producto
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('inventory.update',
                                                    $inventory->id)}}" method="POST">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="form-group col-12 col-sm-4">
                                                                <label for="quantity">Cantidad</label>
                                                                <input type="text" class="form-control @error('quantity') is-invalid @enderror" id="quantity" placeholder="Cantidad" name="quantity" value="{{ $inventory->quantity }}">
                                                                @error('quantity')
                                                                    <span class="invalid-feedback d-block" role="alert">
                                                                        <strong>{{$message}}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-12 col-sm-4">
                                                                <label for="unit">Unidad</label>
                                                                <input type="text" class="form-control @error('unit') is-invalid @enderror" id="unit" placeholder="Unidad" name="unit" value="{{ $inventory->unit }}">
                                                                @error('unit')
                                                                    <span class="invalid-feedback d-block" role="alert">
                                                                        <strong>{{$message}}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-12 col-sm-4">
                                                                <label for="warehouse">Almacen</label>
                                                                <input type="text" class="form-control @error('warehouse') is-invalid @enderror" id="warehouse" placeholder="Almacen" name="warehouse" value="{{ $inventory->warehouse }}">
                                                                @error('warehouse')
                                                                    <span class="invalid-feedback d-block" role="alert">
                                                                        <strong>{{$message}}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-12 col-sm-12">
                                                                <label for="comments">Comentarios</label>
                                                                <input type="text" class="form-control @error('comments') is-invalid @enderror" id="comments" placeholder="Comentarios" name="comments" value="{{ $inventory->comments }}">
                                                                @error('comments')
                                                                    <span class="invalid-feedback d-block" role="alert">
                                                                        <strong>{{$message}}</strong>
                                                                    </span>
                                                                @enderror
                                                                <br>
                                                                <input type="submit" value="Guardar" class="btn btn-primary">
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>

        {{ $products->links() }}
    </div>

    <!-- ----- ----- ----- Modal Search ----- ----- ----- -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="javascript:search();">
                    <div class="modal-header">
                        <div class="form-group col-10 col-search">
                            <input type="text" class="form-control" id="search" name="search" placeholder="Ingresar producto">
                        </div>
                        <input type="submit" class="btn btn-primary" value="Buscar">
                    </div>
                </form>
                <div class="modal-body">
                    <div id="results"></div>
                </div>
            </div>
        </div>
    </div>

    <script type="application/javascript">
        function search() {
            let resultsDiv = document.getElementById("results");
            const req = new XMLHttpRequest();
            const search = document.getElementById('search').value;
            const url = 'inventory/'+search;
            req.responseType = "json";
            req.open("GET", url, true);
            req.onload = function() {
                if(req.response['0'].data.length > 0){
                    var products = req.response['0'].data;
                    var content = `
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Producto</th>
                                    <th scope="col">Codigo</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                    `;
                    for(var product in products){
                        content += `
                            <tr>
                                <td> ${products[product].title}</td>
                                <td> ${products[product].code}</td>
                                <td>
                                    <a href="/admin/products/inventory/create/${products[product].id}" class="btn btn-primary">Agregar</a>
                                </td>
                            </tr>
                        `;
                    }
                    content += `
                            </tbody>
                        </table>
                    `;
                }else{
                    var content = `<p class="text-center"><i class="fas fa-exclamation-triangle"></i> Lo sentimos no se encontraron registros </p>`;
                }
                resultsDiv.innerHTML = content;
            };
            req.send(null);
        }
    </script>
@endsection
