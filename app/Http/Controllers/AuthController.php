<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;


class AuthController extends Controller
{
    public function login()
    {
        if(Auth::user())
		{
			return redirect()->intended('/');
		}
		
		return view('auth.login');
    }


    public function entrar(Request $request)
	{
		$request->validate([
			'email' 	=> 'required|email',
			'password'  => 'required',
		]);

		$credentials = ['email' => $request->email, 'password' => $request->password];

		
		if(Auth::attempt($credentials))
        {
			$user = User::where('email', $request->email)->first();

			if ( $user->can('LOGIN') ){
				//se tiver a role inicia sistema
				return redirect()->intended('/');
			}

			//se chegar até aqui é pq varreu o array de roles e não encontrou nenhuma associada ao usuário, então "desloga" e envia mensagem de erro
			Auth::logout();
			return redirect()->back()->with('error','Voce não tem acesso ao sistema');
			// dd($credentials);
        }else{
			return redirect()->back()->with('error','Acesso Negado, Email ou senha invalida');
        }
	}

    public function logout(Request $request) {
        Auth::logout();
        return redirect('/login');
    }

}
