<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class JoseFernandoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Descomentar SOLO Y SOLO SI EL ROL ESTA CREADO, PERO EL USUARIO NO! Esto creara al Usuario y le asignara el rol si este ultimo ya existe.

        // $usuario = User::create([
            // 'name' => 'Jose Fernando Garcia',
            // 'email' => 'josefernandoge@gmail.com',
            // 'username' => 'jeyef',
            // 'password' => ('josefernando10'),
        // ]); 

                                                //Lo que esta aqui dentro de este comentario no descomentar = ...

        //$rol = Role::create(['name'=>'Administrador']);

        //$permisos = Permission::pluck('id', 'id')->all();

        //$rol->syncPermissions($permisos);

                                                // ... = esto que esta encerrado aqui!!!

        // $usuario->assignRole('Administrador');



        /* Descomentar para cuando se vaya a crear todo desde cero */

        $usuario = User::create([
            'name' => 'Jose Fernando Garcia',
            'email' => 'josefernandoge@gmail.com',
            'username' => 'jeyef',
            'password' => ('josefernando10'),
        ]);

        $rol = Role::create(['name'=>'Administrador']);

        $permisos = Permission::pluck('id', 'id')->all();

        $rol->syncPermissions($permisos);

        $usuario->assignRole([$rol->id]);
    }
}