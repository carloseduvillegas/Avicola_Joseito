<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Promotor;
use App\Models\Mercado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $promotor=Auth::id();

        $clientes =  DB::table('clientes as c')
            ->select('c.idcliente','c.nombrecliente','c.codcliente')
            ->join('mercados as m','m.idmercado','=','c.idmercado')
            ->where('c.idpromotor','=',$promotor)
            ->select('c.idcliente','c.codcliente','c.nombrecliente','m.nombremercado as mercado','c.celular','c.estado')
            ->orderBy('c.estado','desc')
            ->get();

        return view('Clientes.index',['clientes'=>$clientes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $promotores = Promotor::orderBy('nombrepromotor', 'asc')->get();
        $mercados = Mercado::orderBy('nombremercado', 'asc')->get();
        return view('clientes.create',['promotores'=>$promotores,'mercados'=>$mercados]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'promotor'=>'required',
            'mercado'=>'required',
            'codcliente'=>'required',
            'nombrecliente'=>'required',
        ]);

        try {
            DB::beginTransaction();

            $cliente = New Cliente();
            $cliente->nombrecliente=$request->input('nombrecliente');
            $cliente->codcliente=$request->input('codcliente');
            $cliente->celular=$request->input('celular');
            $cliente->puesto=$request->input('puesto');
            $cliente->idpromotor=$request->input('promotor');
            $cliente->idmercado=$request->input('mercado');
            $cliente->observaciones=$request->input('observaciones');
            $cliente->estado = 'a';
            $cliente->save();
            
            DB::commit();
            session()->flash('status','Registro guardado exitosamente!!');
        }catch (\Exception $e){
            dd($e);
        }

        return Redirect::to('client');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        //
    }

    public function todosLosClientes()
    {
        $clientes = Cliente::orderBy('estado','desc')->get();
        return view('clientes.index', compact('clientes'));
    }
}
