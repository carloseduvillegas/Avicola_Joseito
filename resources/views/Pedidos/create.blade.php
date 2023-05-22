@extends('adminlte::page')

@section('title', 'Registrar Pedido')

@section('content_header')
    <div class="row">
        <div class="col-md-3"><h1>Registrar pedido</h1></div>
    </div>
@stop

@section('content')
    <main>
        <div class="container py-4">
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
            <form action="{{route('pedidos.store')}}" method="post">
                @csrf

                <!-- Fila Cliente y codigo cliente -->
                <div class="form-group row">
                    <div class="col-md-6">
                            <label for="cliente">Cliente</label>
                            <select name="cliente" id="cliente" class="form-control" onchange="cambioOpciones();" required>
                            <option value="">Seleccionar Cliente</option>
                            @foreach($clientes as $cliente)
                                <option value="{{$cliente->idcliente}}">{{$cliente->nombrecliente}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <fieldset disabled>
                            <label for="showId" class="form-label">Código Cliente</label>
                            <input id="showId" type="text" class="form-control">
                        </fieldset>
                    </div>
                </div>

                <!-- Fila producto, cantidad y boton agregar -->
                <div class="form-group row">
                    <div class="form-group col-md-3">
                        <label for="idproducto"> Producto</label>
                        <select id="idproducto" name="idproducto" class="form-control " data-live-search="true" >
                            <option value="">Seleccione Producto</option>
                            @foreach($productos as $prod)
                                <option value="{{$prod->idproducto}}">{{$prod->nombreproducto}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="cantidad"> Cantidad</label>
                        <input type="number" name="cantidad" id="cantidad" class="form-control" placeholder="Cantidad" value="{{old('cantidad')}}" >
                    </div>

                    <div class="form-group col-md-3">
                        <label for="descripcion"> Descripcion</label>
                        <input type="text" name="descripcion" id="descripcion" class="form-control" placeholder="descripcion" value="{{old('cantidad')}}" >
                    </div>

                    <div class="form-group col-md-3">
                        <label for="">&nbsp;</label>
                        <button type="button" id="agregar" class="btn btn-primary col-md-12"> <i class="fa fa-plus"></i>&nbsp; Agregar</button>
                    </div>
                </div>

                <!-- Fila Tabla detalles -->
                <div class="container">
                    <div class="table-responsive">
                        <table id="detalles" class="table table-bordered table-striped table-light">
                            <thead>
                            <tr>
                                <th scope="col">Producto</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">descripcion</th>
                                <th scope="col">Opciones</th>
                            </tr>
                            </thead>
                            <tbody class="table-group-divider">

                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Fila observacion -->
                <div class="form-group">
                    <label for="observacion"> Observación</label>
                    <input type="text"  name="observacion" id="observacion" class="form-control" placeholder="Observacón" value="" >
                </div>

                <!-- Fila Botones Guardar y cancelar -->
                <div class="w3-row text-center" id="guardar">
                        <button type="submit" id="register" class="btn btn-success col-md-3">Guardar</button>
                        <label class="col-md-1">&nbsp;</label>
                        <a href="{{url('mispedidos')}}" class="btn btn-danger col-md-3">Cancelar</a>
                </div>
            </form>
        </div>
    </main>
@stop

@section('css')

@stop

@section('js')
    <script> console.log('Hi!'); </script>
    <script>
        function cambioOpciones() {
            //const combo = document.getElementById('cliente'),
                [id] = document.getElementById('cliente').value.split('_');
            document.getElementById('showId').value = id;
        }
    </script>
    <script>
        $(document).ready(function (){
            $('#agregar').click(function (){
                agregar();
            });
        })

        var cont=0;
        subtotal=[];
        total=0;
        //$('#guardar').hide();
        const btncompra = document.getElementById('register');
        btncompra.disabled = true;

        function agregar() {
            idproducto=$("#idproducto").val();
            producto=$("#idproducto option:selected").text();
            cantidad=$("#cantidad").val();
            descripcion = $("#descripcion").val();
            console.log(cantidad);
            if(idproducto && cantidad){
                subtotal[cont]=(cantidad);
                total = total + subtotal[cont];
                var fila = '<tr class="selected" id="fila'+ cont+'"><td><input type="hidden" name="idproducto[]" value="'+idproducto+'"><input class="form-control-plaintext" type="text" name="" value="'+producto+'"></td><td><input class="form-control-plaintext" type="number" name="cantidad[]" value="'+cantidad+'"></td><td><input class="form-control-plaintext" type="text" name="descripcion[]" value="'+descripcion+'"></td><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td></tr>';
                cont++;
                limpiar();
                evaluar();
                $('#detalles').append(fila);
            }else{
                alert("Error al ingresar");
            }
        }

        function limpiar(){
            $('#idproducto').val("");
            $('#cantidad').val("");
            $('#descripcion').val("");
        }

        function evaluar(){
            if(total>0){
                const btncompra = document.getElementById('register');
                btncompra.disabled = false;
                //$("#guardar").show();
            }else{
                const btncompra = document.getElementById('register');
                btncompra.disabled = true;
                //$("#guardar").hide();
            }
        }

        function eliminar(index){
            total=total-subtotal[index];
            $("#fila" + index).remove();
            evaluar();
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $("#idproducto").select2();
        $("#cliente").select2();
    </script>
@stop

@section('footer')
        <div class="float-right d-sm-block">
            <b>Version</b> 1.1
        </div>
        <strong>Copyright © 2023 <a href="">cevasoft</a>.</strong> All rights reserved.
@stop
