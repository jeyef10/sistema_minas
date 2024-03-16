<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CoordinadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $usuario = User::create([
        //     'name' => 'Coordinador',
        //     'email' => 'coordinador@gmail.com',
        //     'username' => 'Coordinad',
        //     'password' => ('123456'),
        // ]); 

        //$rol = Role::create(['name'=>'Administrador']);

        //$permisos = Permission::pluck('id', 'id')->all();

        //$rol->syncPermissions($permisos);

        // $usuario->assignRole('Administrador');


        /* Descomentar para cuando se vaya a crear todo desde cero */

        $usuario = User::create([
            'name' => 'Coordinador',
            'email' => 'coordinador@gmail.com',
            'username' => 'coordinad',
            'password' => ('123456'),
        ]);

        $rol = Role::create(['name'=>'Coordinador']);

        $permisos = Permission::pluck('id', 'id')->all();

        $rol->syncPermissions($permisos);

        $usuario->assignRole([$rol->id]);
    }
}


