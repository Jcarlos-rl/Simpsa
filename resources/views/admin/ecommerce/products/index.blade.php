@extends('layouts.app')

@section('content')
    <div class="actions">
        <div class="prin">
            <h2>Productos disponibles en la tienda en linea</h2>
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
                    <th scope="col">Categorias</th>
                    <th scope="col">Etiquetas</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>
                            <a href="{{ route('products.show',$product->id)}}">
                                {{$product->title}}
                            </a>
                        </td>
                        <td>{{$product->brand->name}}</td>
                        <td>
                            @foreach ($categories as $category)
                                <form action="{{ route('category.destroycategory',[$product->id,$category->id]) }}" method="POST">
                                    @csrf
                                    @if ($product->categories->contains($category->id))
                                        <div class="label" id="label">
                                            <div class="label-active">
                                                <input type="hidden" name="category" value="{{$category->id}}">
                                                <button type="submit" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <p>{{ $category->name }}</p>
                                            </div>
                                        </div>
                                    @endif
                                </form>
                            @endforeach
                        </td>
                        <td>
                            <form action="{{ route('label.destroy',$product->id) }}" method="POST">
                                @csrf
                                @foreach ($labels as $label)
                                    @if ($product->labels->contains($label->id))
                                        <div class="label" id="label">
                                            <div class="label-active">
                                                <input type="hidden" name="label" value="{{$label->id}}">
                                                <button type="submit" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <p>{{ $label->name }}</p>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </form>
                        </td>
                        <td>
                            <div class="dropdown dropleft">
                                <button class="btn dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <div class="dropdown-menu">
                                    @if ($product->info != null)
                                        <a class="dropdown-item" href="{{ route('infoproduct.edit',$product->info->id) }}">Editar</a>
                                        <a href="{{ route('category.indexproduct', $product->id) }}" class="dropdown-item">Categorias</a>
                                        <a href="{{ route('label.index', $product->id) }}" class="dropdown-item">Etiquetas</a>
                                    @else
                                        <a class="dropdown-item" href="{{ route('infoproduct.create',$product->id) }}">Asignar información</a>
                                    @endif
                                    <form action="{{ route('adminecommerceproduct.destroy', $product->id) }}" method="POST">
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
            const url = 'products/'+search;
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
                                    <a href="/admin/ecommerce/products/create/${products[product].id}" class="btn btn-primary">Agregar</a>
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
