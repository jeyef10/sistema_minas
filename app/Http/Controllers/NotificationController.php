<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function fetch()
    {
        $unreadNotifications = auth()->user()->unreadNotifications;
        $unreadCount = $unreadNotifications->count();

        return response()->json([
            'unreadCount' => $unreadCount,
            'notifications' => $unreadNotifications
        ]);
    }
}
