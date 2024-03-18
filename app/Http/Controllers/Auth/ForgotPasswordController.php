<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Forgot Password Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the sending of reset password email requests.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Display the form to request a password reset.
     *
     * @return \Illuminate\View\View
     */
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        // Generar código numérico
        $code = rand(100000, 999999);

        // Guardar código en la base de datos (por ejemplo, en una tabla temporal)
        // ...

        // Enviar correo electrónico con el código
        $this->broker()->sendResetLink($request->only('email'), function (Message $message) use ($code) {
            $message->subject('Restablecimiento de contraseña');
            $message->line('Su código de restablecimiento de contraseña es: ' . $code);
        });

        return back()->with('status', 'Se ha enviado un correo electrónico con el código de restablecimiento de contraseña.');
    }
}