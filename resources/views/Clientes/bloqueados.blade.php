@extends('adminlte::page')

@section('title', 'Clientes bloqueados')

@section('content_header')
    <div class="row justify-content-start">
        <div>
            <h1>Clientes bloqueados</h1>
        </div>
    </div>
@stop

@section('content')
    <div class="row card">
        <table class="table table-hover">
            <thead class="table-light">
            <tr>
                <th>Id</th>
                <th>Codigo</th>
                <th>Nombre</th>
                <th class="d-none d-md-table-cell">Mercado</th>
                <th>Estado</th>
                @if (auth()->user()->rol == 'administrador' || auth()->user()->rol == 'auxiliar')
                    <th>Accion</th>
                @endif
            </tr>
            </thead>
            <tbody class="table-group-divider">
            @foreach($bloqueados as $b)
                <tr>
                    <td>{{ $b->idcliente }}</td>
                    <td>{{$b->codcliente}}</td>
                    <td>{{$b->nombrecliente}}</td>
                    <td class="d-none d-md-table-cell">{{$b->mercado}}</td>
                    <td id="resp{{$b->idcliente}}">
                        @if($b->estado =="a")
                            activo
                        @else
                            inactivo
                        @endif
                    </td>
                    @if (auth()->user()->rol == 'administrador' || auth()->user()->rol == 'auxiliar')
                    <td class="text-center">
                        <div class="form-check form-switch">
                            <form method="POST" action="{{ route('bloquear.update', $b->idcliente) }}">
                                @method('PATCH')
                                @csrf
                                <input class="form-check-input" type="checkbox" name="estado" onchange="this.form.submit()" {{ ($b->estado == 'i') ? '' : 'checked' }}>  
                            </form>
                        </div>
                    </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@stop

@section('footer')
    <div class="float-right d-none d-sm-block">
        <b>Version</b> 1.1
    </div>
    <strong>Copyright © 2023 <a href="">cevasoft</a>.</strong> All rights reserved.
@stop
