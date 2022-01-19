<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{

    public function __invoke()
    {

    }

    public function login(Request $request)
    {

        $usuario = Usuario::where('email', '=', $request->email)->first();

        if(@$usuario->id != null) {

            if(Hash::check($request->senha, $usuario->senha)){
                $request->session()->put('usuario', $usuario);
                return redirect('/dashboard');
            }

        }

        return back()
            ->withInput(['email'=>$request->email])
            ->withErrors(['erro'=>'Verique os dados de login e tente novamente']);

    }

    public function logout(Request $request)
    {

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');

    }

}
