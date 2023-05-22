@extends('adminlte::page')

@section('title', 'Registrar Pedido')

@section('content_header')
    <div class="row">
        <div class="col-md-3"><h1>Editar detalle</h1></div>
    </div>
@stop

@section('content')
        <div class="container">
        @if($errors->has('cantidad'))
            <div class="alert alert-danger">{{ $errors->first('cantidad') }}</div>
        @endif
            <form action="{{route('pedidos.update',$detalle->iddetalle)}}" method="post">
                @csrf
                @method('PUT')
                <!-- Fila producto, cantidad y boton agregar -->
                <div class="form-group row">
                    
                    <div class="form-group col-md-4">
                        <fieldset disabled>
                            <label for="producto"> Producto</label>
                            <input id="" type="text" class="form-control" value="{{$detalle->nombreproducto}}">
                        </fieldset>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="cantidad"> Cantidad</label>
                        <input type="hidden" name="cantidad_actual" value="{{ $detalle->cantidad }}">
                        <input type="number" name="cantidad" id="cantidad" class="form-control" p value="{{$detalle->cantidad}}" >
                    </div>

                    <div class="form-group col-md-4">
                        <label for="descripcion"> Descripcion</label>
                        <input type="text" name="descripcion" id="descripcion" class="form-control"  value="{{$detalle->descripcion}}" >
                    </div>
                    
                </div>

                <!-- Fila Botones Guardar y cancelar -->
                <div class="w3-row text-center" id="guardar">
                        <button type="submit" id="register" class="btn btn-success col-md-3">Guardar</button>
                        <label class="col-md-1">&nbsp;</label>
                        <a href="{{url('mispedidos')}}" class="btn btn-danger col-md-3">Cancelar</a>
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