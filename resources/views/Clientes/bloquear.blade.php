@extends('adminlte::page')

@section('title', 'Bloquear clientes')

@section('content_header')
    <div class="row justify-content-start">
        <div class="">
            <h1>Bloquear clientes</h1>
        </div>
    </div>
@stop

@section('content')
    @if(session('status'))
        <div class="alert alert-success" role="alert">
            <p class="mb-0">{{session('status')}}</p>
        </div>
    @endif
    <main>
        <form action="{{route('bloquear.store')}}" method="post">
            @csrf
            <div class="container row">
                    <div class="col-md-6">
                        <label for="codigoclientes">Código de clientes</label>
                        <textarea type="text" name="codigoclientes" id="codigoclientes" class="form-control" placeholder="Ingresar codigos" value="{{old('codigoclientes')}}" required></textarea>

                    </div>
                <div class="form-group col-md-2">
                    <label for="">&nbsp;</label>
                    <button type="submit" id="bloquear" class="btn btn-primary col-md-12"> <i class="fa fa-ban"></i>&nbsp; Bloquear</button>
                </div>

            </div>
        </form>
    </main>
@stop

@section('css')

@stop

@section('js')
    <script>
        //$('#cevaclass').hide();
    </script>
@stop

@section('footer')
    <div class="float-right d-none d-sm-block">
        <b>Version</b> 1.1
    </div>
    <strong>Copyright © 2023 <a href="">cevasoft</a>.</strong> All rights reserved.
@stop
