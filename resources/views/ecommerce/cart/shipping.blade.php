@extends('ecommerce.layout.layout')

@section('ecommercecontent')
    <div class="direction">
        <p>Inicio / Carrito / <span>Envió</span></p>
        <hr>
    </div>
    <h1 class="text-center">Información de Envio</h1>
    <div class="cart">
        <form action="{{ route('ecommerce.save') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-12 col-sm-8">
                    <div class="envio">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="email">E-mail</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" value="@if($dataShipping != null){{$dataShipping['email']}}@else {{ old('email') }} @endif" name="email">
                                    @error('email')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="name">Nombre</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Nombre" value="@if($dataShipping != null){{$dataShipping['name']}}@else {{ old('name') }} @endif" name="name">
                                    @error('name')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-8 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="direction">Dirección</label>
                                    <input type="text" class="form-control @error('direction') is-invalid @enderror" placeholder="Dirección" value="@if($dataShipping != null){{$dataShipping['direction']}} @else {{ old('direction') }} @endif" name="direction">
                                    @error('direction')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="number">Número</label>
                                    <input type="text" class="form-control @error('number') is-invalid @enderror" placeholder="Número" value="@if($dataShipping != null){{$dataShipping['number']}} @else {{ old('number') }} @endif" name="number">
                                    @error('number')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="city">Ciudad</label>
                                    <input type="text" class="form-control @error('city') is-invalid @enderror" placeholder="Ciudad" value="@if($dataShipping != null){{$dataShipping['city']}}@else {{ old('city') }} @endif" name="city">
                                    @error('city')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="state">Estado</label>
                                    <select class="custom-select form-control @error('state') is-invalid @enderror" name="state">
                                        <option selected>@if($dataShipping != null){{$dataShipping['state']}}@else
                                        {{ old('state') }} @endif</option>
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
                            <div class="col-md-4 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="cp">Código Postal</label>
                                    <input type="text" class="form-control @error('cp') is-invalid @enderror" placeholder="Código postal" value="@if($dataShipping != null){{$dataShipping['cp']}} @else {{ old('cp') }} @endif" name="cp">
                                    @error('cp')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="phone">Teléfono</label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" placeholder="Teléfono" value="@if($dataShipping != null){{$dataShipping['phone']}} @else {{ old('phone') }} @endif" name="phone">
                                    @error('phone')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="total">
                        <p class="title">Total compra</p>
                        <p>Subtotal:     ${{$subtotal}}</p>
                        <p>Envio: ${{$shipping}}</p>
                        <hr>
                        <p>Total: ${{$subtotal+$shipping}}</p>
                        <button class="btn"><i class="far fa-credit-card"></i> Proceder al pago</button>
                    </div>
                </div>
            </div>
        </form>
        <br>
    </div>
@endsection
