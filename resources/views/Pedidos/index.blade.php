@extends('adminlte::page')

@section('title', 'Mis pedidos')

@section('content_header')
    @if(session('status'))
        <div class="alert alert-success" role="alert">
            <p class="mb-0">{{session('status')}}</p>
        </div>
    @endif

    <div class="float-right d-sm-block">
            <a href="{{url('mispedidos/create')}}" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp; Agregar</a>
    </div>
    <h1>Mis pedidos</h1>
@stop

@section('content')
    <main>
    <div class="row">
        @foreach($pedidos as $pe)
        <div class="col-sm-4">
            <div class="card" >
                <div class="card-body row">
                    <div class="col-md-7">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h5 class="card-title">#{{ $pe->idpedido }}</h5>
                                <p class="card-text"><small class="text-body-secondary col-4">{{ date('H:i',strtotime($pe->hora)) }}</small></p>
                            </div>
                            <label class="card-text">{{$pe->nombrecliente}}</label>
                            <p class="card-text">{{$pe->nombremercado}}</p>
                            <p class="card-text">Obs.: {{$pe->observacion}}</p>
                            <div class="d-flex justify-content-between">
                                <p class="card-text"><small class="text-body-secondary col-4">{{ date('d/m/Y',strtotime($pe->hora)) }}</small></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 border">
                        <ul class="list-group list-group-flush">
                                @foreach($detalles as $det)
                                    @if($det->idpedido == $pe->idpedido)
                                        <li class="list-group-item bg-gray-light small">{{$det->nombreproducto}} &nbsp; 
                                        <b> {{$det->cantidad}} </b>
                                        &nbsp;
                                        @if (auth()->user()->rol == 'administrador' || auth()->user()->rol == 'auxiliar')
                                            <a href="{{ route('pedidos.detalle',$det->iddetalle)}}">
                                                <i class="fa fa-edit" aria-hidden="true"></i>
                                            </a>
                                        @endif
                                        </li>
                                    @endif
                                @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    </main>
@stop

@section('css')

@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop

@section('footer')
        <div class="float-right d-sm-block">
            <b>Version</b> 1.1
        </div>
        <strong>Copyright © 2023 <a href="">cevasoft</a>.</strong> All rights reserved.
@stop
