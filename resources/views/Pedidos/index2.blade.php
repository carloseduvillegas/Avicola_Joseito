@extends('adminlte::page')

@section('title', 'Mis pedidos')

@section('content_header')
    @if(session('status'))
        <div class="alert alert-success" role="alert">
            <p class="mb-0">{{session('status')}}</p>
        </div>
    @endif

    <div class="float-right d-sm-block">
            <a href="{{url('pedidos/create')}}" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp; Agregar</a>
    </div>
    <h1>Gestionar Pedidos</h1>
@stop

@section('content')
<div class="card table-responsive">
        <table class="table table-hover">
            <thead class="table-light">
            <tr>
                <th >#</th>
                <th >Hora</th>
                <th >Cliente</th>
                <th class="d-none d-md-table-cell">Mercado</th>
                <th class="d-none d-md-table-cell" >Promotor</th>
                <th>Opciones</th>
            </tr>
            </thead>
            <tbody class="table-group-divider">
            @foreach($pedidos as $pe)
                <tr>
                    <td >{{ $pe->idpedido }}</td>
                    <td >{{ date('H:i',strtotime($pe->hora)) }}</td>
                    <td >{{$pe->codcliente}} - {{$pe->nombrecliente}}</td>
                    <td class="d-none d-md-table-cell">{{$pe->nombremercado}}</td>
                    <td class="d-none d-md-table-cell">{{$pe->nombrepromotor}}</td>
                    <td>
                        <a href=""><i class="fa fa-eye" aria-hidden="true"></i></a>
                        &nbsp;
                        <a href="{{ route('pedidos.edit',$pe->idpedido)}}"><i class="fa fa-edit" aria-hidden="true"></i></a>
                        &nbsp;
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
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
