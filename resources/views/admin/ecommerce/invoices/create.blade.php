@extends('layouts.app')

@section('content')
    <div class="actions">
        <div class="prin">
            <h2>Generar orden de facturas</h2>
        </div>
        <div class="sec">
            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#exampleModal">
                Agregar producto
            </button>
        </div>
    </div>
    <div class="content">
        <form action="{{ route('admininvoice.save') }}" method="POST">
            @csrf
            <div>
                <p>Canal de venta</p>
                <div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="channel" id="exampleRadios1" value="MercadoLibre" checked>
                        <label class="form-check-label" for="exampleRadios1">
                        Mercado Libre
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="channel" id="exampleRadios2" value="Amazon">
                        <label class="form-check-label" for="exampleRadios2">
                            Amazon
                        </label>
                    </div>
                </div>
            </div>
            <br>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Titulo</th>
                        <th scope="col">Codigo</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Precio</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order as $item)
                        <tr>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->code }}</td>
                            <td>
                                <input type="number" class="form-control" value="{{isset($item->quantity) ? $item->quantity : 1}}" id="quantity_{{$item->id}}">
                            </td>
                            <td>
                                <input type="text" class="form-control" value="{{isset($item->price) ? $item->price : 0}}" id="price_{{$item->id}}">
                            </td>
                            <td>
                                <button type="button" class="btn" onclick="update('{{$item->id}}')"><i class="fas fa-redo-alt"></i></button>

                                <a href="{{ route('admininvoice.delete',$item->id) }}">
                                    <i class="far fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
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
                                    <a href="add/${products[product].id}" class="btn btn-primary">Agregar</a>
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

        function update(id){
            var quantity = document.getElementById("quantity_"+id).value;
            var price = document.getElementById("price_"+id).value;
            window.location = "/admin/ecommerce/invoices/update/"+id+"/"+quantity+"/"+price;
        }
    </script>
@endsection
