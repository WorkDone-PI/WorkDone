<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
 

class CategoryController extends Controller
{
    function index(Request $request) {
        //$categories = Category::with('children')->whereNull('parent_id')->get();
        //return $categories;
        $categories = Category::with('parent')->get();
        return view('categories.index', compact('categories'));
    }
    
    function create(Request $request) {
        $categories = Category::all();
        return view('categories.create', compact('categories'));
    }
    
    function store(Request $request) {
        $request->validate([
            'Titulo' => 'required',
            'Descricao' => 'required',
            'parent_id' => 'nullable|exists:categories,id'
        ]);

        Category::create([
            'Titulo' => $request->Titulo,
            'Descricao' =>$request->Descricao,
            'parent_id' => $request->parent_id
        ]);

        return redirect()->route('category.index');
    }

    function show($id) {
        $categories = Category::findOrFail($id);
        return view('categories.show', compact('categories'));
    }
    
    function edit($id) {
        $category = Category::findOrFail($id);
        $categories = Category::where('id', '!=', $id)->get();

        return view('categories.edit', compact('category', 'categories'));
    }
    
    function update(Request $request, $id) {
        $categories = Category::findOrFail($id);

        $request->validate([
            'Titulo' => 'required',
            'Descricao' => 'required',
            'parent_id' => 'nullable|exists:categories,id'
        ]);

        $categories->update([
            'Titulo' => $request->Titulo,
            'Descricao' => $request->Descricao,
            'parent_id' => $request->parent_id
        ]);

        return redirect()->route('category.index');
    }
    
    function destroy($id) {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('category.index');
    }
}
