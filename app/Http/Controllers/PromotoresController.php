<?php

namespace App\Http\Controllers;

use App\Models\Promotor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class PromotoresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $promotores = DB::table('promotores as p')
            ->select('idpromotor','codpromotor','nombrepromotor','celular','correo','direccion')
            ->get();
        return view('Promotores.index',['promotores'=>$promotores]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Promotores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombrepromotor'=>'required',
            'correo'=>'required',
        ]);

        try {
            DB::beginTransaction();
            $promotor = New Promotor();
            $promotor->nombrepromotor=$request->input('nombrepromotor');
            $promotor->codpromotor=$request->input('codpromotor');
            $promotor->celular=$request->input('celular');
            $promotor->correo=$request->input('correo');
            $promotor->direccion=$request->input('direccion');
            $promotor->save();

            $Usuario = New User();
            $Usuario->name=$request->input('nombrepromotor');
            $Usuario->email=$request->input('correo');
            //$Usuario->password=Hash::make($request->input('123456789'));
            $Usuario->password=Hash::make('123456789');
            $Usuario->save();
            DB::commit();
        }catch (\Exception $e){
            //dd($e);
        }

        return Redirect::to('promotores');
    }

    /**
     * Display the specified resource.
     */
    public function show(Promotor $promotor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Promotor $promotor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Promotor $promotor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Promotor $promotor)
    {
        //
    }
}
