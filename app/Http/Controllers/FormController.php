<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class FormController extends Controller
{
    public function showForm(Request $request)
    {
        // Recupera o valor de 'step' da sessão ou define como 1 se não estiver presente
        $step = $request->session()->get('step', 1);
    
        // Renderiza o formulário, passando a variável 'step'
        return view('postagem', compact('step'));
    }
    
    public function submitForm(Request $request)
    {
        // Recupera a etapa atual
        $step = $request->session()->get('step', 1);

        // Se estiver na primeira etapa, salva os dados e avança
        if ($step == 1) {
            // Validação dos dados da primeira etapa
            $request->validate([
                'Titulo' => 'required|string|max:255',
                'Valor' => 'required|numeric',
            ]);

            // Processa e armazena os dados da primeira etapa
            $request->session()->put('Titulo', $request->input('Titulo'));
            $request->session()->put('Valor', $request->input('Valor'));

            // Avança para a segunda etapa
            $request->session()->put('step', 2);

            return redirect()->route('form.show');
        }

        // Se estiver na segunda etapa, finaliza o processo
        if ($step == 2) {
            // Validação dos dados da segunda etapa
            $request->validate([
                'Descricao' => 'required|string',
                'Id_categoria' => 'required|integer',
            ]);

            // Criação do produto no banco de dados
            Product::create([
                'Titulo' => $request->session()->get('Titulo'),
                'Descricao' => $request->input('Descricao'),
                'Valor' => $request->session()->get('Valor'),
                'Id_User' => auth()->id(), // Assume que você está usando autenticação
                'Id_Categoria' => $request->input('Id_categoria'),
            ]);

            // Limpa a sessão após finalizar
            $request->session()->forget(['step', 'Titulo', 'Valor']);

            return redirect()->route('form.show')->with('success', 'Projeto cadastrado com sucesso!');
        }
        
        // Se a etapa não é 1 ou 2, redireciona de volta para o início
        return redirect()->route('form.show')->withErrors('Etapa inválida.');
    }
}
