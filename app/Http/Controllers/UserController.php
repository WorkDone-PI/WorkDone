<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserController extends Controller
{
    public function showFormRegister(Request $request)
    {
        return view('register');
    }


    public function register(Request $request)
    {
        // Validação dos dados do formulário de registro
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 're  quired|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        /*$data = $request->all();
        $user = User::create($data);
        $id = $user -> id;
        return view('project', compact('id'));*/
        // Criação de um novo usuário
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Redireciona para a página inicial com uma mensagem de sucesso
        return redirect()->route('login')->with('success', 'Registro realizado com sucesso. Por favor, faça o login.');
    }

    public function index()
    {

        $user = Auth::user();

        return view('profile', compact('user'));

    }

    public function edit()
    {
        $user = auth()->user(); // Obtem o usuário autenticado

        return view('edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();


        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,

        ]);


        $user->update([
            'name' => $request->name,
            'email' => $request->email,

        ]);

        return redirect()->route('profile')->with('success', 'Perfil atualizado com sucesso.');
    }


    public function profile(Request $request)
    {
        return view('profile');
    }

    /*public function home(Request $request){
        $users = User::all();
        return view('home', compact('users'));
    }*/
}