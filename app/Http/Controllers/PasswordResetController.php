<?php

// app/Http/Controllers/PasswordResetController.php
// app/Http/Controllers/PasswordResetController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    public function sendEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Elimina cualquier token existente para este correo electrónico
        DB::table('password_resets')->where('email', $request->email)->delete();

        // Genera un nuevo token y lo inserta en la base de datos
        $token = Str::random(6);
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
        ]);

        // Envía el correo electrónico con el token
        Mail::raw("Su Código de Restablecimiento es: $token. Copie este Código y Haga CLICK en el siguiente Enlace para Restablecer su Contraseña: " . route('password.reset', ['token' => $token, 'email' => $request->email]), function ($message) use ($request) {
            $message->to($request->email)
                ->subject('Restablecer su Contraseña');
        });        

        // return back()->with('message', '¡Le hemos enviado por correo electrónico el enlace para restablecer su contraseña!');
        $email =  $request->email;
        return view('auth.reset-password-confirm', compact('email', 'token'))->with('message', '¡Le hemos enviado por correo electrónico el enlace para restablecer su contraseña!');
    }

    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required|size:6',
            'password' => 'required|min:4|confirmed',
        ]);

        $email = DB::table('password_resets')
            ->where('token', $request->token)
            ->value('email');

        if (!$email || $email != $request->email) {
            return back()->withErrors(['email' => 'Este token no es válido.']);
        }

        DB::table('users')
            ->where('email', $email)
            ->update(['password' => bcrypt($request->password)]);

        DB::table('password_resets')->where('email', $email)->delete();

        return redirect('/')->with('message', '¡Tu contraseña ha sido restablecida Exitosamente!');
    }
}