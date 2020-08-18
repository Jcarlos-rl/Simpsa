@extends('ecommerce.layout.layout')


@section('ecommercecontent')
    <div class="direction">
        <p>Inicio / <span>Catalogos</span></p>
        <hr>
        <div class="container">
            <div class="row">
                @foreach ($catalogues as $catalogue)
                    <div class="col-6 col-sm-3">
                        <div class="image-catalogue">
                            <img src="/storage/{{$catalogue->img}}" alt="">
                        </div>
                        <div class="info-catalogue">
                            <p>{{$catalogue->title}}</p>
                            <a href="/storage/{{$catalogue->pdf}}" target="_blank">
                                <i class="far fa-file-pdf"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <br>
    </div>
@endsection
