<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
 

class CategoryController extends Controller
{
    function index(Request $request) {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }
    
    function create(Request $request) {
        return view('categories.create');
    }
    
    function store(Request $request) {
        $request->validate([
            'titulo' => 'required',
            'descricao' => 'required'
        ]);

        Category::create($request->all());

        return redirect()->route('category.index');
    }

    function show($id) {
        $categories = Category::find($id);
        return view('categories.show', compact('categories'));
    }
    
    function edit(Request $request) {
        return "editar";
    }
    
    function update(Request $request) {
        return "atualizar";
    }
    
    function destroy(Request $request) {
        return "remover";
    }
}
