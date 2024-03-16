<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $usuario = User::create([
        //     'name' => 'Super Administrador',
        //     'email' => 'admin@gmail.com',
        //     'username' => 'SuperAdmin',
        //     'password' => ('123456'),
        // ]); 

        //$rol = Role::create(['name'=>'Administrador']);

        //$permisos = Permission::pluck('id', 'id')->all();

        //$rol->syncPermissions($permisos);

        // $usuario->assignRole('Administrador');



        /* Descomentar para cuando se vaya a crear todo desde cero */

        $usuario = User::create([
            'name' => 'Super Administrador',
            'email' => 'admin@gmail.com',
            'username' => 'admin',
            'password' => bcrypt('123456'),
        ]);

        $rol = Role::create(['name'=>'Administrador']);

        $permisos = Permission::pluck('id', 'id')->all();

        $rol->syncPermissions($permisos);

        $usuario->assignRole([$rol->id]);
    }
}
