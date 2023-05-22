<?php

namespace Database\Seeders;

use App\Models\Promotor;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*DB::table('users')->insert([
            'email' => 'admin@joseito.com',
            'name' => 'Admin',
            'password' => Hash::make('admin123')
        ]);*/
        User::create(['name'=>'Administrador','email'=>'admin@joseito.com','password'=>Hash::make('admin123')]);
        Promotor::create(['nombrepromotor'=>'Administrador','correo'=>'admin@joseito.com']);

        User::create(['name'=>'Carlos Villegas','email'=>'carlos@joseito.com','password'=>Hash::make('123456789')]);
        Promotor::create(['nombrepromotor'=>'Carlos Villegas','correo'=>'carlos@joseito.com']);

        User::create(['name'=>'Oficina','email'=>'oficina@joseito.com','password'=>Hash::make('123456789')]);
        Promotor::create(['nombrepromotor'=>'Oficina','correo'=>'oficina@joseito.com']);

//        User::create(['name'=>'Rosa Acuna','email'=>'rosa@gmail.com','password'=>Hash::make('123456789')]);
//        User::create(['name'=>'Richard','email'=>'richard@joseito.com','password'=>Hash::make('123456789')]);
//        User::create(['name'=>'Wilmar','email'=>'wilmar@joseito.com','password'=>Hash::make('123456789')]);


//        User::create(['name'=>'Promotor','email'=>'promotor@joseito.com','password'=>Hash::make('promotor123')]);
//        User::create(['name'=>'Auxiliar','email'=>'auxiliar@joseito.com','password'=>Hash::make('auxiliar123')]);
//        User::create(['name'=>'Jefe','email'=>'jefe@joseito.com','password'=>Hash::make('jefe123')]);
//        User::create(['name'=>'Oficina','email'=>'oficina@joseito.com','password'=>Hash::make('oficina123')]);
    }
}
