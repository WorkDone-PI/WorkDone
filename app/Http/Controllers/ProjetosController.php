<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produtos;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProjetosController extends Controller
{

    public function home()
    {
        return view('home');
    }

    public function show()
    {
        return view('postagem');

    }

    public function shownext()
    {
        return view('postagem2');

    }

    public function produto(Request $request)
    {
        /*$userId = Auth::id();

        $project = new Produtos;
        $project->Titulo = $request->input('Titulo');
        $project->Descricao = $request->input('Descricao');
        $project->Valor = $request->input('Valor');
        $project->fk_Id_User = $userId;
        $project->save();
*/

        $userId = Auth::id();
        $request->validate([
            'Titulo' => 'required|string|max:255',
            'Descricao' => 'required|string|max:255',
            'Valor' => 'required|numeric|between:0,99999.99',
        ]);

        /*Produtos::create($request->all());       
        $data = $request->all();
        $fk_Id_User = $data['fk_Id_User'];*/

        $teste = Produtos::create([
            'Titulo' => $request->Titulo,
            'Descricao' => $request->Descricao,
            'Valor' => $request->Valor,
            'fk_Id_User' => $userId,
        ]);


        return view('project', compact('teste'));
        //return redirect()->route('home')->with('Projeto criado!');

        //return view ('home', compact('titulo', 'descricao', 'valor', 'fk_Id_User'));
    }

    public function prjs()
    {
        $userId = Auth::id();
        $prjs = Produtos::where('fk_Id_User', $userId)->get();

        return view('prjs', compact('prjs'));
    }

    public function projetos()
    {

        $projetos = Produtos::all();
        //dd($projetos);
        return view('home', compact('projetos'));
    }

    public function search($Id)
    {

        //$users = User::where('id', $Id)->first();
        //$prj = Produtos::where('fk_Id_User', $Id)->first();

        $user = auth()->user();
        $prj = Produtos::where('id', $Id)
            ->where('fk_Id_User', $user->id)
            ->firstOrFail();

        return view(
            'editP',
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
        $prj = Produtos::findOrFail($Id);
        $user = auth()->user();

        // Preencha os campos com os valores do formulário
        $prj->fill([
            'Titulo' => $request->input('Titulo'),
            'Descricao' => $request->input('Descricao'),
            'Valor' => $request->input('Valor'),
            'fk_Id_User'=> $user->id,
        ]);

        //dd($prj->Titulo, $prj->Descricao, $prj->Valor);
        
        // Depois do save
        /*if ($prj->save()) {
            die('Projeto atualizado com sucesso!');
        } else {
            die('Erro ao atualizar o projeto.');
        }*/

        // Salve as alterações no banco de dados
        if ($prj->save()) {
            return redirect()->route('prjs')->with('success', 'Projeto atualizado com sucesso!');
        } else {
            return redirect()->back()->withErrors(['Erro ao atualizar o projeto. Por favor, tente novamente.']);
        }
    }

    public function delete($Id)
    {
        $prj = Produtos::findOrFail($Id);
        $prj->delete();

        return redirect()->route('prjs')->with('Projeto deletado com sucesso!');
    }

}
