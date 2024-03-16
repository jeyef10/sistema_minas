<?php

namespace App\Http\Controllers;

use App\Models\UserSettings;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth; //Necesario
use Illuminate\Support\Facades\Hash; //Necesario
use Illuminate\Support\Facades\DB; //Necesario

class UserSettingsController extends Controller
{

    public function Perfil(){
        return view('perfil');
    }

    
    public function changePassword(Request $request){    
        
        $user           = Auth::user();
        $userId         = $user->id;
        $userEmail      = $user->email;
        $userPassword   = $user->password;

        if($request->password_actual !=""){
            $NuewPass   = $request->password;
            $confirPass = $request->confirm_password;
            $name       = $request->name;

                //Verifico si la clave actual es igual a la clave del usuario en session
                if (Hash::check($request->password_actual, $userPassword)) {

                    //Valido que tanto la 1 como 2 clave sean iguales
                    if($NuewPass == $confirPass){
                        //Valido que la clave no sea Menor a 6 digitos
                        if(strlen($NuewPass) >= 4){
                            $user->password = ($request->password);
                            $sqlBD = DB::table('users')
                                  ->where('id', $user->id)
                                  ->update(['password' => $user->password], ['username' => $user->username]);
                    
                            return redirect()->back()->with('updateClave','La Clave Fue Cambiada Correctamente.');
                        }else{
                            return redirect()->back()->with('clavemenor','Recuerde, La Clave Debe Ser Mayor a 4 Digitos.');
                        }
        
                }else{
                    return redirect()->back()->with('claveIncorrecta','Por Favor Verifique, Las Claves No Coinciden.');
                }
           
            }else{
                return back()->withErrors(['password_actual'=>'La Clave Actual No Coincide.']);
            }


        }else{
            $username       = $request->username;
            $sqlBDUpdateName = DB::table('users')
                            ->where('id', $user->id)
                            ->update(['username' => $username]);
            return redirect()->back()->with('name','El Nombre Fue Cambiado Correctamente.');;

        }

        

}

}