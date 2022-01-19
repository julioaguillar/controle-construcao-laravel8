<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\CompraProduto;
use App\Models\Fornecedor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FornecedorController extends Controller
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
            $fornecedores = Fornecedor::orderBy('nome')
                ->where('cnpj', 'LIKE', "%{$search}%")
                ->orWhere('cpf', 'LIKE', "%{$search}%")
                ->orWhere('nome', 'LIKE', "%{$search}%")
                ->orWhere('endereco', 'LIKE', "%{$search}%")
                ->orWhere('contato', 'LIKE', "%{$search}%")
                ->paginate(Helper::QTDE_ITEM_POR_PAGINA);

        } else {
            $fornecedores = Fornecedor::orderBy('nome')->paginate(Helper::QTDE_ITEM_POR_PAGINA);
        }

        return view('fornecedor.index', compact('fornecedores'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fornecedor.create');
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
            return redirect()->route('fornecedor.index')->with('alert', 'danger')->with('mensagem', 'Cadastro cancelado pelo usuário');
        }

        $request->validate([
            'cnpj' => 'nullable|cnpj|unique:fornecedores|max:18',
            'cpf' => 'nullable|cpf|unique:fornecedores|max:14',
            'nome' => 'required|min:1|max:100',
            'endereco' => 'nullable|max:150',
            'telefone' => 'nullable|max:14',
            'celular' => 'nullable|max:15',
            'contato' => 'nullable|max:30',
            'email' => 'nullable|email|max:150',
        ]);

        $fornecedor = Fornecedor::create($request->all());
        if ($fornecedor) {
            return redirect()->route('fornecedor.index')->with('alert', 'success')->with('mensagem', 'Fornecedor cadastrado com sucesso!');
        }

        return redirect()->route('fornecedor.index')->with('alert', 'danger')->with('mensagem', 'Erro ao incluir o Fornecedor');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fornecedor  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function show(Fornecedor $fornecedor)
    {
        return view('fornecedor.show', compact('fornecedor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fornecedor  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function edit(Fornecedor $fornecedor)
    {
        return view('fornecedor.edit', compact('fornecedor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fornecedor  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fornecedor $fornecedor)
    {

        if ( $request->has('cancelar') ) {
            if ( $request->has('url') ) {
                return redirect($request->url)->with('alert', 'danger')->with('mensagem', 'Cadastro cancelado pelo usuário');
            }
            return redirect()->route('fornecedor.index')->with('alert', 'danger')->with('mensagem', 'Cadastro cancelado pelo usuário');
        }

        $request->validate([
            'cnpj' => ['nullable', 'cnpj', 'max:18', Rule::unique('fornecedores')->ignore($fornecedor->id)],
            'cpf' => ['nullable', 'cpf', 'max:14', Rule::unique('fornecedores')->ignore($fornecedor->id)],
            'nome' => 'required|min:1|max:100',
            'endereco' => 'nullable|max:150',
            'telefone' => 'nullable|max:14',
            'celular' => 'nullable|max:15',
            'contato' => 'nullable|max:30',
            'email' => 'nullable|email|max:150',
        ]);

        if (!$fornec = Fornecedor::find($fornecedor->id)) {
            return redirect()->route('fornecedor.index')->with('alert', 'danger')->with('mensagem', 'Fornecedor não localizado. Verifique!');
        }

        $fornec->update($request->all());
        return redirect()->route('fornecedor.index')->with('alert', 'success')->with('mensagem', 'Fornecedor atualizado com sucesso!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fornecedor  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fornecedor $fornecedor)
    {

        $nome = $fornecedor->nome;

        if ($fornecedor->comprasProduto->count() > 0) {
            return redirect()->route('produto.index')->with('alert', 'warning')->with('mensagem', "Fornecedor $nome não pode ser excluído! Existe relacionamento com o lançamento de compra de produto/mercadoria");        }

        if ($fornecedor->delete()) {
            return redirect()->route('fornecedor.index')->with('alert', 'success')->with('mensagem', "Fornecedor $nome excluido com sucesso!");
        }

        return redirect()->route('fornecedor.index')->with('alert', 'danger')->with('mensagem', "Erro ao excluir o fornecedor $nome.");

    }

}
