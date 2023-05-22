@extends('adminlte::page')

@section('title', 'Promotores')

@section('content_header')
    <div class="float-right d-sm-block">
            <a href="{{url('promotores/create')}}" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp; Agregar</a>
    </div>
    <h1>Gestionar Promotores</h1>
@stop

@section('content')
    <div class="card table-responsive">
        <table class="table table-hover">
            <thead class="table-light">
            <tr>
                <th class="d-none d-md-table-cell">Id</th>
                <th class="d-none d-md-table-cell">Codigo</th>
                <th class="d-none d-md-table-cell">Nombre</th>
                <th>Celular</th>
                <th>Correo</th>
                <th class="d-none d-md-table-cell">Direccion</th>
                <th>Opciones</th>
            </tr>
            </thead>
            <tbody class="table-group-divider">
            @foreach($promotores as $pro)
                <tr>
                    <td class="d-none d-md-table-cell">{{ $pro->idpromotor }}</td>
                    <td class="d-none d-md-table-cell">{{$pro->codpromotor}}</td>
                    <td class="d-none d-md-table-cell">{{$pro->nombrepromotor}}</td>
                    <td>{{$pro->celular}}</td>
                    <td>{{$pro->correo}}</td>
                    <td class="d-none d-md-table-cell">{{$pro->direccion}}</td>
                    <td>
                        <a href=""><i class="fa fa-edit" aria-hidden="true"></i></a>
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
    <div class="float-right d-none d-sm-block">
        <b>Version</b> 1.1
    </div>
    <strong>Copyright © 2023 <a href="">cevasoft</a>.</strong> All rights reserved.
@stop
