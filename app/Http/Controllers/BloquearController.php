<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class BloquearController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $promotor=Auth::id();
        $bloqueados =  DB::table('clientes as c')
            ->select('c.idcliente','c.nombrecliente','c.codcliente')
            ->join('mercados as m','m.idmercado','=','c.idmercado')
            ->where('c.idpromotor','=',$promotor)
            ->where('c.estado','=','i')
            ->select('c.idcliente','c.codcliente','c.nombrecliente','m.nombremercado as mercado','c.celular','c.estado')
            ->orderBy('c.nombrecliente','asc')
            ->get();
        return view('Clientes.bloqueados',['bloqueados'=>$bloqueados]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $datos = $request->codigoclientes;
        $codigo = explode(",",$datos);
        $numero = count($codigo);
        for ($i=0 ; $i<$numero ; $i++){
            DB::table('clientes')->where('codcliente','=',$codigo[$i])->update(['estado'=>'i']);
        };

        session()->flash('status','Se bloquearon '.$numero. ' clientes.');
        return Redirect::to('bloquear');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cliente = Cliente::findOrFail($id);
        //dd($bloquear);
        $estado = request()->has('estado') ? 'a' : 'i';
        $cliente->update(['estado' => $estado]);
        //return Redirect::to('bloqueados');
        return redirect()->back();
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function indexBloquear(){
        return view('Clientes.bloquear');
    }
}
