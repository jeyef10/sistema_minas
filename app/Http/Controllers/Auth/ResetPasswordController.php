<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Reset Password Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the resetting of user passwords.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reset(Request $request)
    {
        $this->validate($request, $this->rules());

        // Validar código numérico (ejemplo)
        $code = $request->input('code');
        if ($code !== $request->session()->get('reset_password_code')) {
            return back()->withErrors(['code' => 'El código numérico no es válido.']);
        }

        // Restablecer contraseña
        $user = $this->broker()->reset($request->only('email', 'password', 'password_confirmation'), function ($user, $password) {
            $user->forceFill([
                'password' => ($password),
            ])->save();
        });

        // Eliminar código de la sesión (ejemplo)
        $request->session()->forget('reset_password_code');

        return redirect($this->redirectPath())->with('status', 'Su contraseña ha sido restablecida correctamente.');
    }
}