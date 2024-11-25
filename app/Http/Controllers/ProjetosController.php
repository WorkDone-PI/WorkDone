<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Favorite;
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

        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('Titulo', 'like', "%$searchTerm%")
                    ->orWhere('Descricao', 'like', "%$searchTerm%")
                    ->orWhereHas('user', function ($query) use ($searchTerm) {
                        $query->where('name', 'like', "%$searchTerm%");
                    })
                    ->orWhereHas('categories', function ($query) use ($searchTerm) {
                        $query->where('categories.Titulo', 'like', "%$searchTerm%");
                    });
            });
        }

        if ($request->has('category') && $request->category != '') {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('categories.id', $request->category)
                    ->orWhere('categories.parent_id', $request->category);
            });
        }

        if ($request->has('subcategory') && $request->subcategory != '') {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('categories.id', $request->subcategory)
                    ->orWhere('categories.parent_id', $request->subcategory);
            });
        }

        if ($request->has('price_order') && in_array($request->price_order, ['asc', 'desc'])) {
            $query->orderBy('Valor', $request->price_order);
        }

        if ($request->has('date_order') && in_array($request->date_order, ['asc', 'desc'])) {
            $query->orderBy('created_at', $request->date_order);
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $projetos = $query->paginate(10);

        $user = Auth::user();

        $categories = Category::all();
        $favorites = Favorite::where('user_id', $user->id)->pluck('product_id')->toArray();


        return view('home', compact('projetos', 'user', 'categories', 'favorites'));
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

        // Obtendo os projetos onde 'removed' é 0
        $projetos = Product::where('Id_User', $userId)->where('removed', 0)->get() ?? collect(); // Define como coleção vazia se nulo

        // Passando a variável correta para a view
        return view('profile', compact('projetos', 'user')); // Passando 'projetos' ao invés de 'prjs'
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
        $prj->removed = 1;
        $prj->save();

        return redirect()->route('prjs')->with('Projeto deletado com sucesso!');
    }
    // ProjetosController
    public function showProject($id)
    {
        // Recupera o projeto pelo ID
        $projeto = Product::findOrFail($id);

        // Recupera as categorias associadas ao projeto
        $categories = $projeto->categories;

        // Retorna a view de detalhes do projeto com as informações necessárias
        return view('project.show', compact('projeto', 'categories'));
    }

    public function favorite($productId)
    {
        $user = Auth::user();  // Obtém o usuário autenticado
        $product = Product::findOrFail($productId);  // Encontra o projeto
    
        // Verifica se o projeto já foi favoritado pelo usuário
        $existingFavorite = Favorite::where('user_id', $user->id)
                                    ->where('product_id', $product->id)
                                    ->first();
    
        if ($existingFavorite) {
            // Se já estiver favoritado, desfavorece
            $existingFavorite->delete();
            return back()->with('success', 'Projeto desfavoritado com sucesso!');
        } else {
            // Se não estiver favoritado, adiciona aos favoritos
            Favorite::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
            ]);
            return back()->with('success', 'Projeto favoritado com sucesso!');
        }
    }

}
