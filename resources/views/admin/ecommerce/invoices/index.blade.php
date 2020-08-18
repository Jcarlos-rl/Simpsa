@extends('layouts.app')

@section('content')
    <div class="actions">
        <div class="prin">
            <h2>Facturas</h2>
        </div>
        <div class="sec">
            <a class="btn btn-primary" href="{{ route('admininvoice.create') }}">
                Crear orden de factura
            </a>
        </div>
    </div>
    <div class="content">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Facturas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Ordenes</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">...</div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <br>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Canal</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Subtotal</th>
                            <th scope="col">Envio</th>
                            <th scope="col">Total</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>
                                    {{$order->channel}}
                                </td>
                                <td>
                                    {{$order->slug}}
                                </td>
                                <td>
                                    {{$order->subtotal}}
                                </td>
                                <td>
                                    {{$order->shipping}}
                                </td>
                                <td>
                                    {{$order->total}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
