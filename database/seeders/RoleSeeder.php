<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1 = Role::create(['name'=>'admin']);
        $role2 = Role::create(['name'=>'promotor']);
        $role3 = Role::create(['name'=>'auxiliar']);

        Permission::create(['name'=>'BloquearMasivo'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'Promotores'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'Clientes'])->syncRoles([$role1,$role2]);
        //php artisan db:seed --class=RoleSeeder
    }
}
