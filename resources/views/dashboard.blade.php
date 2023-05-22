
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>
    @role('admin')
        <p>Esta info es para el administrador</p>
    @endrole
    @role('promotor')
    <p>Esta info es para el promotor</p>
    @endrole
    @role('auxiliar')
    <p>Esta info es para el auxiliar</p>
    @endrole
    
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('adminlte_js')
    <script>
        $('#cevaclass').hide();
    </script>
@stop
