<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        //PROMOTOR RICHARD
//        Cliente::create(['codcliente'=>'101636','nombrecliente'=>'VERONICA QUIROZ MAMANI','estado'=>'a','idpromotor'=>'1','idmercado'=>'1']);
//        Cliente::create(['codcliente'=>'101805','nombrecliente'=>'ALEX EDUARDO CABALLERO','estado'=>'a','idpromotor'=>'1','idmercado'=>'1']);
//        Cliente::create(['codcliente'=>'101637','nombrecliente'=>'WILSON RIVAS MEDRANO','estado'=>'a','idpromotor'=>'1','idmercado'=>'1']);
//        Cliente::create(['codcliente'=>'101525','nombrecliente'=>'FABIOLA CARLA AGUILAR','estado'=>'a','idpromotor'=>'1','idmercado'=>'2']);
//        Cliente::create(['codcliente'=>'100520','nombrecliente'=>'TERESA POMA','estado'=>'a','idpromotor'=>'1','idmercado'=>'2']);
//
//        //PROMOTOR WILMAR
//        Cliente::create(['codcliente'=>'100400','nombrecliente'=>'MAIRA CORONEL','estado'=>'a','idpromotor'=>'2','idmercado'=>'9']);
//        Cliente::create(['codcliente'=>'101535','nombrecliente'=>'JAIME TERRAZAS','estado'=>'a','idpromotor'=>'2','idmercado'=>'22']);
//        Cliente::create(['codcliente'=>'100896','nombrecliente'=>'NICOL SEJAS','estado'=>'a','idpromotor'=>'2','idmercado'=>'28']);
//        Cliente::create(['codcliente'=>'101877','nombrecliente'=>'EVANGELINA RODRIGUEZ','estado'=>'a','idpromotor'=>'2','idmercado'=>'29']);

//
//        //OFICINA
//        $nombres = ['POLLO GOYITA','SALT. PANTANAL','SALT. HAMACIEL','POLLO BISMUCOR','SALT. TARUPESAL','WILDER DELGADILLO CAMPANA','SACURA MECHERO','POLLO ANGELA','MARGARITA ESTRADA','SACURA AMERICA','POLLO AMBORO','SALT. QUIRQUINCHO','SHAWARMAA RAHMAN','SHAWARMA HELMI','SHAWARMA MOHAMED','DEISY ROJAS','POLLO JOSUE','POLLO EL BUEN SAMARITANO','POLLO CITY SUC. 1','POLLO URKUPIÑA','NEYER TOLEDO','RESTAURANT LA BRASIL ','DOCTOR DONNER','MARCELO LA FUENTE','POLLO CARLING Z. 4 ANILLO CENTENARIO','POLLO COQUETO','POLLO SUPER THIAGO'];
//        foreach ($nombres as $nom){
//            DB::table('clientes')->insert([
//                'nombrecliente'=>$nom,
//                'estado'=>'a',
//                'idpromotor'=> 6,
//                'idmercado'=> 39
//            ]);
//        }

//        $codigos = ['101198','101501','102465','102484','102533','102549','102372','101831','102444','102371','102322','100718','102408','102413','102407','102131','102234','101510','102472','102582','101538','102152','101347','102389','102431','102391','102168'];
//        $c=1;
//        foreach ($codigos as $cod){
//            DB::table('clientes')
//                ->where('idcliente','=',$c)
//                ->update(['codcliente'=>$cod, 'estado'=>'a']);
//            $c++;
//        }
    }
}
