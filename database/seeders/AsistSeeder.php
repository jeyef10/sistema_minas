<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AsistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $usuario = User::create([
        //     'name' => 'Asistente',
        //     'email' => 'asistente@gmail.com',
        //     'username' => 'Asist',
        //     'password' => ('123456'),
        // ]); 

        //$rol = Role::create(['name'=>'Asistente']);

        //$permisos = Permission::pluck('id', 'id')->all();

        //$rol->syncPermissions($permisos);

        // $usuario->assignRole('Asistente');



        /* Descomentar para cuando se vaya a crear todo desde cero */

        $usuario = User::create([
             'name' => 'Asistente',
             'email' => 'asistente@gmail.com',
             'username' => 'asist',
             'password' => ('123456'),
        ]);

        $rol = Role::create(['name'=>'Asistente']);

        $permisos = Permission::pluck('id', 'id')->all();

        $rol->syncPermissions($permisos);

        $usuario->assignRole([$rol->id]);
    }
}
