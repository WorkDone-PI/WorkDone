<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
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
            'email' => 'required|string|email|max:255|unique:users',
            'dataNasc' => 'nullable|date',
            'password' => 'required|string|min:8|confirmed'
        ]);

        /*$data = $request->all();
        $user = User::create($data);
        $id = $user -> id;
        return view('project', compact('id'));*/
        // Criação de um novo usuário
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'dataNasc' => $request->dataNasc,
            'password' => Hash::make($request->password),
            'descricao' => null,
            'arroba' => null,
            'profile_image' => null,
            'background_image' => null,
        ]);

        // Redireciona para a página inicial com uma mensagem de sucesso
        return redirect()->route('login')->with('success', 'Registro realizado com sucesso. Por favor, faça o login.');
    }

    public function index()
    {

        $user = Auth::user();
        $userId = Auth::id();
        $projetos = Product::where('Id_User', $userId)->get();

        return view('profile', compact('user', 'projetos'));

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
            'descricao' => 'nullable|string|max:255',
            'arroba' => 'nullable|string|max:255',
            'dataNasc' => 'nullable|date',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('profile_image')) {
            // Remove a imagem antiga se existir
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }

            // Salva a nova imagem no diretório 'profile_images' dentro do storage/public
            $imagePath = $request->file('profile_image')->store('profile_images', 'public');

            // Atualiza o caminho da imagem no banco de dados
            $user->profile_image = $imagePath;
        }
        if ($request->hasFile('background_image')) {
            // Remove a imagem antiga se existir
            if ($user->background_image) {
                Storage::disk('public')->delete($user->background_image);
            }

            // Salva a nova imagem no diretório 'profile_images' dentro do storage/public
            $imagePath = $request->file('background_image')->store('background_images', 'public');

            // Atualiza o caminho da imagem no banco de dados
            $user->background_image = $imagePath;
        }


        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'descricao' => $request->descricao,
            'arroba' => $request->arroba,
            'profile_image' => $user->profile_image,
            'background_image' => $user->background_image
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