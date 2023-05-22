<?php

namespace App\Http\Controllers;


use App\Models\Detalle;
use App\Models\Pedido;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class PedidosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index2(){
    //     $pedidos = DB::table('pedidos as p')
    //         ->join('clientes as c','p.idcliente','=','c.idcliente')
    //         ->join('mercados as m','m.idmercado','=','c.idmercado')
    //         ->join('promotores as pro','p.idpromotor','=','pro.idpromotor')
    //         ->select('p.idpedido','p.created_at as hora','c.codcliente','c.nombrecliente','m.nombremercado','pro.nombrepromotor')
    //         ->orderBy('p.idpedido','desc')
    //         ->get();
    //     $detalles = DB::table('detallepedidos as d')
    //         ->join('productos as pr','pr.idproducto','=','d.idproducto')
    //         ->join('pedidos as pe','pe.idpedido','=','d.idpedido')
    //         ->select('d.idpedido','pr.nombreproducto','d.cantidad')
    //         ->get();

    //     return view('Pedidos.index2',['pedidos'=>$pedidos,'detalles'=>$detalles]);
    // }

    public function index()
    {
        $promotor = Auth::user()->idpromotor;
        
        if(Auth::user()->rol == 'promotor'){
        $pedidos = DB::table('pedidos as p')
            ->join('clientes as c','p.idcliente','=','c.idcliente')
            ->join('mercados as m','m.idmercado','=','c.idmercado')
            ->select('p.idpedido','p.idcliente','p.idpromotor','p.created_at as hora','c.nombrecliente','m.nombremercado','p.observacion')
            ->where('p.idpromotor','=',$promotor)
            ->orderBy('p.idpedido','desc')
            ->get();
        $detalles = DB::table('detallepedidos as d')
            ->join('productos as pr','pr.idproducto','=','d.idproducto')
            ->join('pedidos as pe','pe.idpedido','=','d.idpedido')
            ->select('d.iddetalle','d.idpedido','pr.nombreproducto','d.cantidad')
            ->get();
        }
        if(Auth::user()->rol == 'auxiliar' || Auth::user()->rol == 'administrador'){
            $pedidos = DB::table('pedidos as p')
            ->join('clientes as c','p.idcliente','=','c.idcliente')
            ->join('mercados as m','m.idmercado','=','c.idmercado')
            ->select('p.idpedido','p.idcliente','p.idpromotor','p.created_at as hora','c.nombrecliente','m.nombremercado','p.observacion')
            ->orderBy('p.idpedido','desc')
            ->get();
        $detalles = DB::table('detallepedidos as d')
            ->join('productos as pr','pr.idproducto','=','d.idproducto')
            ->join('pedidos as pe','pe.idpedido','=','d.idpedido')
            ->select('d.iddetalle','d.idpedido','pr.nombreproducto','d.cantidad')
            ->get();
        }

        return view('Pedidos.index',['pedidos'=>$pedidos,'detalles'=>$detalles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $promotor = Auth::user()->idpromotor;
        if(Auth::user()->rol == 'promotor'){
            $clientes =  DB::table('clientes as c')
                ->select('c.idcliente','c.nombrecliente','c.codcliente')
                ->where('c.idpromotor','=',$promotor)
                ->where('c.estado','=','a')
                ->orderBy('c.nombrecliente','asc')
                ->get();
        }
        if(Auth::user()->rol == 'auxiliar' || Auth::user()->rol == 'administrador'){
            $clientes =  DB::table('clientes as c')
                ->select('c.idcliente','c.nombrecliente','c.codcliente')
                ->where('c.estado','=','a')
                ->orderBy('c.nombrecliente','asc')
                ->get();
        }
        $productos = DB::table('productos as p')
            ->select('p.idproducto','p.nombreproducto')
            ->orderBy('p.nombreproducto','asc')
            ->get();
        return view('Pedidos.create',['clientes'=>$clientes,'productos'=>$productos]);
    }

    public function create2()
    {
        $clientes =  DB::table('clientes as c')
            ->select('c.idcliente','c.nombrecliente','c.codcliente')
            ->where('c.estado','=','a')
            ->orderBy('c.nombrecliente','asc')
            ->get();
        $productos = DB::table('productos as p')
            ->select('p.idproducto','p.nombreproducto')
            ->orderBy('p.nombreproducto','asc')
            ->get();
        return view('Pedidos.create',['clientes'=>$clientes,'productos'=>$productos]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cliente'=>'required',
        ]);

        try {
            DB::beginTransaction();
            $promotor = Auth::user()->idpromotor;

            $pedido = New Pedido();
            $pedido->idcliente=(int)$request->input('cliente');
            $pedido->idpromotor=$promotor;
            $pedido->observacion=$request->input('observacion');
            $pedido->save();

            $idproducto=$request->get('idproducto');
            $cantidad=$request->get('cantidad');
            $descripcion=$request->get('descripcion');
            $size = count((array)$idproducto);

            $cont = 0;
            while($cont<$size){
                $detalle=new Detalle();
                $detalle->idpedido=$pedido->idpedido;
                $detalle->idproducto=$idproducto[$cont];
                $detalle->cantidad=$cantidad[$cont];
                $detalle->descripcion=$descripcion[$cont];
                $detalle->save();
                $cont=$cont+1;
            }
            DB::commit();
            session()->flash('status','Registro guardado exitosamente!!');
        }catch (\Exception $e){
            //dd($e);
        }

        return Redirect::to('mispedidos');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pedido $pedido)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pedido $pedido)
    {   
        $cliente = DB::table('pedidos as p')
        ->join('clientes as c','c.idcliente','=','p.idcliente')
        ->select('c.nombrecliente','p.observacion')
        ->where('p.idpedido','=',$pedido->idpedido)
        ->first();
        $detalles = DB::table('pedidos as p')
        ->join('detallepedidos as det','det.idpedido','=','p.idpedido')
        ->join('productos as pro','pro.idproducto','=','det.idproducto')
        ->select('det.iddetalle','det.idproducto','pro.nombreproducto','det.cantidad','det.descripcion')
        ->where('det.idpedido','=',$pedido->idpedido)
        ->get();
        return view('Pedidos.edit',compact('pedido','cliente','detalles'));
    }

    public function detalle(Detalle $detalle)
    {   
        $detalle = DB::table('detallepedidos as det')
        ->join('productos as pro','pro.idproducto','=','det.idproducto')
        ->select('det.iddetalle','det.idproducto','pro.nombreproducto','det.cantidad','det.descripcion')
        ->where('det.iddetalle','=',$detalle->iddetalle)
        ->first();
        return view('Pedidos.detalle',compact('detalle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Detalle $detalle)
    {
        //dd($request);
        /*$validator = Validator::make($request->all(), [
            'cantidad' => 'required|numeric|min:' . ($request->input('cantidad_actual') + 1),
            // Otras reglas de validación para los demás atributos...
        ]);*/
        $validator = Validator::make($request->all(), [
            'cantidad' => [
                'required',
                'numeric',
                function ($attribute, $value, $fail) use ($request) {
                    if ($value <= $request->input('cantidad_actual')) {
                        $fail('La cantidad que desea introducir es menor al valor actual.');
                    }
                },
            ],
            // Otras reglas de validación para los demás atributos...
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $detallepedido = Detalle::findOrFail($detalle->iddetalle);

        $data = $request->only('cantidad','descripcion');

        $detallepedido->update($data);
        return Redirect::to('mispedidos');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pedido $pedido)
    {
        //
    }

    public function ventas()
    {
        $promotor = Auth::user()->idpromotor;

        $productos = DB::table('detallepedidos as d')
            ->join('productos as pr','pr.idproducto','=','d.idproducto')
            ->join('pedidos as pe','pe.idpedido','=','d.idpedido')
            ->select('pr.nombreproducto as producto', DB::raw('sum(d.cantidad) as cant'))
            ->where('pe.idpromotor','=',$promotor)
            ->groupBy('pr.nombreproducto')
            ->orderBy('pr.nombreproducto')
            ->get();

        $total = DB::table('detallepedidos as d')
            ->join('productos as pr','pr.idproducto','=','d.idproducto')
            ->join('pedidos as pe','pe.idpedido','=','d.idpedido')
            ->select(DB::raw('sum(d.cantidad) as cant'))
            ->where('pe.idpromotor','=',$promotor)
            ->first();

        $producto = $productos->pluck('producto');
        $cantidad = $productos->pluck('cant');

        return view('Pedidos.ventas',['productos'=>$productos,'total'=>$total,'producto'=>$producto,'cantidad'=>$cantidad]);
    }
}
