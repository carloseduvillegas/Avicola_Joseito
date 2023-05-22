<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productosInd = ['SUP. EXTRA','EXT. GRANDE','EXTRA C/MEN','GRANDE','GRANDE C/MENUDO','MEDIANO','MEDIAN C/MEN','CHICOS','EXT. CHICO','POLLO BB','POLLO ROJO','BRASA 1,1 A 1,2','BRASA 1,2 A 1,3','BRASA 1,3 A 1,4','BRASA 1,4 A 1,5','BRASA 1,5 A 1,6','BRASA 1,6 A 1,7','BRASA 1,7 A 1,8','BRASA 1,8 A 1,9','BRASA 1,9 A 2','BRASA 2 A 2,1','BRASA 2,1 A 2,2','BRASA DE 2DA','POLLO BB RATA','DESC BB','DESC ESPECIAL','P. DESC ROJO','POLLO DE 2DA','PRESA DE 2DA','PECHUGAS','LOMITO','FILETE','PIERNA','MUSLO','PIERNITAS','MUSLITOS','PIERNA M- 2DA','ALAS 1RA','ALAS 2DA','CADERA','CORAZON','CHURIQUI','COTO','HIGADO','PATA','HUESO','GRASA'];
        foreach ($productosInd as $producto){
            DB::table('productos')->insert([
                'nombreproducto'=>$producto,
                'tipo'=>1,
                'descripcion'=>'Ninguno'
            ]);
        }
    }
}
