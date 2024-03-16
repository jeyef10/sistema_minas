<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class logoutController extends Controller
{
    //
    public function logout(){
        session::flush();

        auth::logout();

        return redirect()->to('/login');
    }
}
