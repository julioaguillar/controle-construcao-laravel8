<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\CompraProdutoItem;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use PhpParser\Node\Stmt\TryCatch;

class ProdutoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $search = request('search', '');

        if ( $search != '' ) {
            $produtos = Produto::orderBy('descricao')
                ->where('codigo', 'LIKE', "%{$search}%")
                ->orWhere('gtin', 'LIKE', "%{$search}%")
                ->orWhere('descricao', 'LIKE', "%{$search}%")
                ->paginate(Helper::QTDE_ITEM_POR_PAGINA);
        } else {
            $produtos = Produto::orderBy('descricao')->paginate(Helper::QTDE_ITEM_POR_PAGINA);
        }

        return view('produto.index', compact('produtos'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('produto.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ( $request->has('cancelar') ) {
            if ( $request->has('url') ) {
                return redirect($request->url)->with('alert', 'danger')->with('mensagem', 'Cadastro cancelado pelo usuário');
            }
            return redirect()->route('produto.index')->with('alert', 'danger')->with('mensagem', 'Cadastro cancelado pelo usuário');
        }

        $request->validate([
            'codigo' => 'nullable|unique:produtos|max:14',
            'gtin' => 'nullable|unique:produtos|max:14',
            'descricao' => 'required|min:1|max:120',
            'unidade_medida' => 'nullable|max:5',
        ]);

        $produto = Produto::create($request->all());
        if ($produto) {
            return redirect()->route('produto.index')->with('alert', 'success')->with('mensagem', 'Produto cadastrado com sucesso!');
        }

        return redirect()->route('produto.index')->with('alert', 'danger')->with('mensagem', 'Erro ao incluir o Produto');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function show(Produto $produto)
    {
        return view('produto.show', compact('produto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function edit(Produto $produto)
    {
        return view('produto.edit', compact('produto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produto $produto)
    {

        if ( $request->has('cancelar') ) {
            if ( $request->has('url') ) {
                return redirect($request->url)->with('alert', 'danger')->with('mensagem', 'Cadastro cancelado pelo usuário');
            }
            return redirect()->route('produto.index')->with('alert', 'danger')->with('mensagem', 'Cadastro cancelado pelo usuário');
        }

        $dados = $request->validate([
            'codigo' => ['nullable', 'max:14', Rule::unique('produtos')->ignore($produto->id)],
            'gtin' => ['nullable', 'max:14', Rule::unique('produtos')->ignore($produto->id)],
            'descricao' => 'required|min:1|max:120',
            'unidade_medida' => 'nullable|max:5',
        ]);

        if (!$fornec = Produto::find($produto->id)) {
            return redirect()->route('produto.index')->with('alert', 'danger')->with('mensagem', 'Produto não localizado. Verifique!');
        }

        $fornec->update($request->all());
        return redirect()->route('produto.index')->with('alert', 'success')->with('mensagem', 'Produto atualizado com sucesso!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produto $produto)
    {

        if ($produto->compraProdutoItens->count() > 0) {
            return redirect()->route('produto.index')->with('alert', 'warning')->with('mensagem', "Produto $produto->descricao não pode ser excluído! Existe relacionamento com o lançamento de compra de produto/mercadoria");
        }

        if ($produto->delete()) {
            return redirect()->route('produto.index')->with('alert', 'success')->with('mensagem', 'Produto/Mercadoria excluido com sucesso!');
        }

        return redirect()->route('produto.index')->with('alert', 'danger')->with('mensagem', 'Erro ao excluir o produto/mercadoria!');

    }

}
