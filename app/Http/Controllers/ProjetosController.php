<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProjetosController extends Controller
{

    /*    public function home()
        {
            $projetos = Product::with('user', 'categories')->orderBy('created_at', 'desc')->get();

            $user = Auth::user();

            return view('home', compact('projetos', 'user'));
        }*/

    public function home(Request $request)
    {
        $query = Product::with('user', 'categories');

        // Verifica se há uma busca sendo feita
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;

            // Realiza a busca nas colunas Titulo e Descricao do produto
            $query->where(function ($q) use ($searchTerm) {
                $q->where('Titulo', 'like', "%$searchTerm%")
                    ->orWhere('Descricao', 'like', "%$searchTerm%")
                    ->orWhereHas('user', function ($query) use ($searchTerm){
                        $query->where('name', 'like', "%$searchTerm%");
                    })
                    ->orWhereHas('categories', function ($query) use ($searchTerm) {
                        $query->where('Titulo', 'like', "%$searchTerm%");
                    });
            });
        }

        // Ordena os projetos pela data de criação (mais recente primeiro)
        $projetos = $query->orderBy('created_at', 'desc')->paginate(2);

        // Obtém o usuário autenticado
        $user = Auth::user();

        // Retorna a view com os projetos e o usuário
        return view('home', compact('projetos', 'user'));
    }


    public function show()
    {
        $categories = Category::all();
        return view('postagem', compact('categories'));
    }



    public function produto(Request $request)
    {
        $userId = Auth::id();

        $request->validate([
            'Titulo' => 'required|string|max:255',
            'Descricao' => 'required|string|max:255',
            'Valor' => 'required|numeric|between:0,99999.99',
            'Id_Categoria' => 'required|exists:categories,id',
            'project_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'removed' => 'nullable|boolean'
        ]);

        // Criação do produto
        $produto = new Product([
            'Titulo' => $request->Titulo,
            'Descricao' => $request->Descricao,
            'Valor' => $request->Valor,
            'Id_User' => $userId,
            'removed' => $request->removed ?? false
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

        $produto->categories()->attach($request->Id_Categoria);

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
        $categories = Category::all();

        return view(
            'editpost',
            compact('prj', 'user', 'categories')
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
            'Id_Categoria' => 'required|exists:categories,id',
            'project_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $prj = Product::findOrFail($Id);
        if ($request->hasFile('project_image')) {
            if ($prj->project_image) {
                Storage::disk('public')->delete($prj->project_image);
            }
            // Salva a nova imagem
            $imagePath = $request->file('project_image')->store('project_image', 'public');
            $prj->project_image = $imagePath;
        }
        $user = auth()->user();

        $prj->fill([
            'Titulo' => $request->input('Titulo'),
            'Descricao' => $request->input('Descricao'),
            'Valor' => $request->input('Valor'),
            'Id_User' => $user->id,
        ]);

        if ($prj->save()) {
            // Verifica se a categoria atual é diferente da categoria selecionada
            $selectedCategoryId = $request->Id_Categoria;
            $currentCategoryId = $prj->categories->first()->id ?? null; // Pega a primeira categoria associada (se existir)

            if ($currentCategoryId != $selectedCategoryId) {
                // Se a categoria for diferente, substitui a categoria associada
                $prj->categories()->sync([$selectedCategoryId]);  // Sincroniza a nova categoria (substitui a antiga)
            }
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
