<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; //Necesario


class RegisterController extends Controller
{
    //

    public function show(){
        if(Auth::check()){
            return redirect('/home');
        }
        return view('auth.register');
    }

    public function register(RegisterRequest $request){
        
        $user = User::create($request->validated());
        
        auth()->login($user);
        return redirect('/home')->with('success', "Su Cuenta Ha Sido Creada Exitosamente.");
    }
}