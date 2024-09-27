<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{


    public function showLoginForm(Request $request)
    {
        return view('login');
    }

    public function login(Request $request) {
        // Validação dos dados do formulário de login
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    // Tenta autenticar o usuário com as credenciais fornecidas
    if (Auth::attempt($credentials)) {
        
        // Se a autenticação for bem-sucedida, regenera a sessão...
        $request->session()->regenerate();

        // ...e redireciona para a rota da tela inicial
        return redirect()->intended('home');
    }

    // Se a autenticação falhar, redireciona de volta com uma mensagem de erro
    return back()->withErrors([
        'email' => 'As credenciais fornecidas não correspondem aos nossos registros.',
    ]);
    }

    
    public function logout(Request $request) {
        Auth::logout();
        return redirect('/login');
    }

}