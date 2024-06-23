<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Notifications\NombreNotificacion;
use App\Models\User;

class NotificationController extends Controller
{
    public function fetch()
    {
        $unreadNotifications = auth()->user()->unreadNotifications;
        $unreadCount = $unreadNotifications->count();

        // Obtén notificaciones para usuarios con roles de "administrador" o "comisionado"
        // $adminNotifications = User::role(['Administrador', 'Comisionado'])
        // ->get()
        // ->flatMap(function ($user) {
        //     return $user->unreadNotifications;
        // });

        // Combina todas las notificaciones
        // $allNotifications = $unreadNotifications->concat($adminNotifications);

        return response()->json([
            'unreadCount' => $unreadCount,
            'notifications' => $unreadNotifications
        ]);
    }

    /* public function sendInspectionNotifications()
    {
        /* $users = User::whereHas('roles', function ($query) {
            $query->whereIn('name', ['comisionado', 'administrador']);
        })->get();

        foreach ($users as $user) {
            $user->notify(new NombreNotificacion());
        } */

            /* // Obtén los usuarios con los roles "comisionado" y "administrador"
            $users = User::role(['comisionado', 'administrador'])->get();

            foreach ($users as $user) {
                $user->notify(new NombreNotificacion());
            }

        // Puedes agregar una respuesta o redirección aquí después de enviar las notificaciones
    } */
}
