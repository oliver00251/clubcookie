<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Produto;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdutoController extends Controller
{
    // Aplica o middleware auth em todos os métodos
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Listar todos os produtos
    public function index()
    {
        try {
            $produtos = Produto::all();
            $leads = Lead::all();
            return view('produtos.index', compact('produtos','leads'));
        } catch (\Exception $e) {
            dd('Erro ao buscar produtos: ' . $e->getMessage());
        }
    }

    // Salvar produto
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string',
            'preco' => 'nullable|numeric',
            'link' => 'required|string|max:255',
            'emoji' => 'nullable|string|max:10',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:20048', // validação da imagem
        ]);

        // Upload da imagem se existir
        if ($request->hasFile('imagem')) {
            $file = $request->file('imagem');
            $path = $file->store('produtos', 'public'); // salva em storage/app/public/produtos
            $validated['imagem'] = $path;
        }

        Produto::create($validated);

        return redirect()->route('produtos.index')->with('success', 'Produto criado com sucesso!');
    }

    // Atualizar produto
    public function update(Request $request, Produto $produto)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string',
            'preco' => 'nullable|numeric',
            'link' => 'required|string|max:255',
            'emoji' => 'nullable|string|max:10',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:20048',
        ]);

        // Upload da nova imagem
        if ($request->hasFile('imagem')) {
            // Excluir imagem antiga se existir
            if ($produto->imagem && Storage::disk('public')->exists($produto->imagem)) {
                Storage::disk('public')->delete($produto->imagem);
            }
            $file = $request->file('imagem');
            $path = $file->store('produtos', 'public');
            $validated['imagem'] = $path;
        }

        $produto->update($validated);

        return redirect()->route('produtos.index')->with('success', 'Produto atualizado com sucesso!');
    }

    // Excluir produto
    public function destroy(Produto $produto)
    {
        // Excluir imagem do storage se existir
        if ($produto->imagem && Storage::disk('public')->exists($produto->imagem)) {
            Storage::disk('public')->delete($produto->imagem);
        }

        $produto->delete();
        return redirect()->route('produtos.index')->with('success', 'Produto excluído com sucesso!');
    }
}
