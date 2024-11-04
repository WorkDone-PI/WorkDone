<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProjetosController extends Controller
{

    public function home()
    {
        $projetos = Product::with('user', 'categories')->get();

        $user = Auth::user();
     
        return view('home', compact('projetos', 'user')); 
    }

    public function show()
    {
        return view('postagem');

    }



    public function produto(Request $request)
{
    $userId = Auth::id();

    $request->validate([
        'Titulo' => 'required|string|max:255',
        'Descricao' => 'required|string|max:255',
        'Valor' => 'required|numeric|between:0,99999.99',
        'project_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Criação do produto
    $produto = new Product([
        'Titulo' => $request->Titulo,
        'Descricao' => $request->Descricao,
        'Valor' => $request->Valor,
        'Id_User' => $userId,
    ]);

    // Verifica se há uma imagem
    if ($request->hasFile('project_image')) {
        // Se já existir uma imagem, delete-a
        if ($produto->project_image) {
            Storage::disk('public')->delete($produto->project_image);
        }

        // Salva a nova imagem
        $imagePath = $request->file('project_image')->store('project_image', 'public');
        $produto->project_image = $imagePath;
    }

    // Salva o produto no banco de dados
    $produto->save();

    return redirect()->route('home')->with('success', 'Projeto criado com sucesso!');
}

    public function prjs()
    {
        $userId = Auth::id();
        $user = Auth::user(); // Obter o usuário autenticado
        $prjs = Product::where('Id_User', $userId)->get();
        return view('profile', compact('prjs', 'user'));
    }


    public function projetos()
    {

        $projetos = Product::all();
        //dd($projetos);
        return view('home', compact('projetos'));
    }

    public function search($Id)
    {

        //$users = User::where('id', $Id)->first();
        //$prj = Produtos::where('fk_Id_User', $Id)->first();

        $user = auth()->user();
        $prj = Product::where('id', $Id)
            ->where('Id_User', $user->id)
            ->firstOrFail();

        return view(
            'editpost',
            compact('prj', 'user')
        );


    }

    /* dd($request->all());
    $user = auth()->user();
    
    $prj = Produtos::where('id', $Id)
    ->where('fk_Id_User', $user->id)
    ->firstOrFail();
    
    
    $request->validate([
        'Titulo' => 'required|string|max:255',
        'Descricao' => 'required|string|max:255',
        'Valor' => 'required|numeric|between:0,99999.99',
        ]);
        
        
 
         $prj->update([
             'Titulo' => $request->input('Titulo'),
             'Descricao' => $request->input('Descricao'),
             'Valor' => $request->input('Valor')
         ]);*/
    public function updateP(Request $request, $Id)
    {
        $request->validate([
            'Titulo' => 'required|string|max:255',
            'Descricao' => 'required|string|max:255',
            'Valor' => 'required|numeric|between:0,99999.99',
        ]);
    
        $prj = Product::findOrFail($Id);
        $user = auth()->user();
    
        $prj->fill([
            'Titulo' => $request->input('Titulo'),
            'Descricao' => $request->input('Descricao'),
            'Valor' => $request->input('Valor'),
            'Id_User' => $user->id,
        ]);
    
        if ($prj->save()) {
            return redirect()->route('profile')->with('success', 'Projeto atualizado com sucesso!'); // Mudei para redirecionar para a rota profile
        } else {
            return redirect()->back()->withErrors(['Erro ao atualizar o projeto.']);
        }
    }
    public function delete($Id)
    {
        $prj = Product::findOrFail($Id);
        $prj->delete();

        return redirect()->route('prjs')->with('Projeto deletado com sucesso!');
    }

}
