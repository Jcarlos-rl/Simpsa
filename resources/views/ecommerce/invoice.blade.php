@extends('ecommerce.layout.layout')


@section('ecommercecontent')
    <div class="direction">
        <p>Inicio / <span>Facturación</span></p>
        <hr>
    </div>
    <br>
    <div class="container billing">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h5 class="text-center">Datos de facturación</h5>
                <hr>
                <form action="{{ route('ecommerce.invoice_save',$order->id) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12 col-12">
                            <div class="form-group">
                                <input type="text" class="form-control @error('rfc') is-invalid @enderror" placeholder="RFC*" value="{{ old('image') }}" name="rfc">
                                @error('rfc')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-12">
                            <div class="form-group">
                                <input type="text" class="form-control @error('razon') is-invalid @enderror" placeholder="Razón social ó nombre*" name="razon">
                                @error('razon')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="form-group">
                                <input type="text" class="form-control @error('cfdi') is-invalid @enderror" placeholder="Uso de CFDI*" name="cfdi">
                                @error('cfdi')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="form-group">
                                <input type="text" class="form-control @error('calle') is-invalid @enderror" placeholder="Calle" name="calle">
                                @error('calle')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="form-group">
                                <input type="text" class="form-control @error('colonia') is-invalid @enderror" placeholder="Colonia" name="colonia">
                                @error('colonia')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="form-group">
                                <input type="text" class="form-control @error('localidad') is-invalid @enderror" placeholder="Municipio/Localidad" name="localidad">
                                @error('localidad')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="form-group">
                                <input type="text" class="form-control @error('cp') is-invalid @enderror" placeholder="Código postal" name="cp">
                                @error('cp')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="form-group">
                                <select class="custom-select" name="state">
                                    <option selected>Estado</option>
                                    <option value="Aguascalientes">Aguascalientes</option>
                                    <option value="Baja California">Baja California</option>
                                    <option value="Baja California Sur">Baja California Sur</option>
                                    <option value="Campeche">Campeche</option>
                                    <option value="Coahuila de Zaragoza">Coahuila de Zaragoza</option>
                                    <option value="Colima">Colima</option>
                                    <option value="Chiapas">Chiapas</option>
                                    <option value="Chihuahua">Chihuahua</option>
                                    <option value="Distrito Federal">Distrito Federal</option>
                                    <option value="Durango">Durango</option>
                                    <option value="Guanajuato">Guanajuato</option>
                                    <option value="Guerrero">Guerrero</option>
                                    <option value="Hidalgo">Hidalgo</option>
                                    <option value="Jalisco">Jalisco</option>
                                    <option value="México">México</option>
                                    <option value="Michoacán de Ocampo">Michoacán de Ocampo</option>
                                    <option value="Morelos">Morelos</option>
                                    <option value="Nayarit">Nayarit</option>
                                    <option value="Nuevo León">Nuevo León</option>
                                    <option value="Oaxaca">Oaxaca</option>
                                    <option value="Puebla">Puebla</option>
                                    <option value="Querétaro">Querétaro</option>
                                    <option value="Quintana Roo">Quintana Roo</option>
                                    <option value="San Luis Potosí">San Luis Potosí</option>
                                    <option value="Sinaloa">Sinaloa</option>
                                    <option value="Sonora">Sonora</option>
                                    <option value="Tabasco">Tabasco</option>
                                    <option value="Tamaulipas">Tamaulipas</option>
                                    <option value="Tlaxcala">Tlaxcala</option>
                                    <option value="Veracruz">Veracruz</option>
                                    <option value="Yucatán">Yucatán</option>
                                    <option value="Zacatecas">Zacatecas</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-12">
                            <div class="form-group">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="E-mail" name="email">
                                @error('email')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <p class="note">IMPORTANTE: verificar y confirmar todos sus datos</p>
                    <button type="submit" class="btn"><i class="far fa-paper-plane"></i> Enviar</button>
                </form>
                <br>
                <br>
            </div>
            <div class="col-12 col-sm-6">
                <h5 class="text-center">Detalle de compra</h5>
                <hr>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">
                                    <p>
                                        Producto
                                    </p>
                                </th>
                                <th scope="col">
                                    <p>
                                        Precio
                                    </p>
                                </th>
                                <th scope="col">
                                    <p>
                                        Cantidad
                                    </p>
                                </th>
                                <th scope="col">
                                    <p>
                                        Subtotal
                                    </p>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->items as $item)
                                <tr>
                                    <td>
                                        <img src="" alt="">
                                    </td>
                                    <td>
                                        <p>
                                            {{$item->product->title}}
                                        </p>
                                    </td>
                                    <td>
                                        <p>
                                            {{$item->price}}
                                        </p>
                                    </td>
                                    <td>
                                        <p>
                                            {{$item->quantity}}
                                        </p>
                                    </td>
                                    <td>
                                        <p>
                                            {{$item->price*$item->quantity}}
                                        </p>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <p class="total"><span>Total:</span> ${{$order->total}}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
