@extends('adminlte::page')

@section('title', 'Registrar Pedido')

@section('content_header')
    <div class="row">
        <div class="col-md-3"><h1>Editar pedido</h1></div>
    </div>
@stop

@section('content')
        <div class="container">
            @if($errors->any())
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <form action="{{url('pedidos.update',$pedido->idpedido)}}" method="post">
                @csrf
                @method('PUT')
                <!-- Fila Cliente y codigo cliente -->
                <div class="form-group row">
                    <div class="col-md-6">
                        <fieldset disabled>
                            <label for="cliente" class="form-label">Cliente</label>
                            <input id="showId" type="text" class="form-control" value="{{$cliente->nombrecliente}}">
                        </fieldset>
                    </div>
                    <div class="col-md-6">
                        <fieldset disabled>
                            <label for="showId" class="form-label">Código Cliente</label>
                            <input id="showId" type="text" class="form-control" value="{{$pedido->idcliente}}">
                        </fieldset>
                    </div>
                </div>

                <!-- Fila producto, cantidad y boton agregar -->
                <div class="form-group row">
                    @foreach($detalles as $det)
                    <div class="form-group col-md-4">
                        <fieldset disabled>
                            <label for="producto"> Producto</label>
                            <input id="" type="text" class="form-control" value="{{$det->nombreproducto}}">
                        </fieldset>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="cantidad"> Cantidad</label>
                        <input type="number" name="cantidad" id="cantidad" class="form-control" p value="{{$det->cantidad}}" >
                    </div>

                    <div class="form-group col-md-4">
                        <label for="descripcion"> Descripcion</label>
                        <input type="text" name="descripcion" id="descripcion" class="form-control"  value="{{$det->descripcion}}" >
                    </div>
                    @endforeach
                </div>
                
                <!-- Fila observacion -->
                <div class="form-group">
                    <label for="observacion"> Observación</label>
                    <input type="text"  name="observacion" id="observacion" class="form-control" placeholder="Observacón" value="{{$cliente->observacion}}" >
                </div>

                <!-- Fila Botones Guardar y cancelar -->
                <div class="w3-row text-center" id="guardar">
                        <button type="submit" id="register" class="btn btn-success col-md-3">Guardar</button>
                        <label class="col-md-1">&nbsp;</label>
                        <a href="{{url('pedidos')}}" class="btn btn-danger col-md-3">Cancelar</a>
                </div>
            </form>
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
