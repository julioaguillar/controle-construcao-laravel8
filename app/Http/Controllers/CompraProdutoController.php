<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\CompraProduto;
use App\Models\CompraProdutoItem;
use App\Models\FormaPagamento;
use App\Models\Fornecedor;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CompraProdutoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // Deleta a sessão
        if (request()->session()->exists('compra_produto_itens')) {
            request()->session()->forget('compra_produto_itens');
        }

        $search = request('search', '');

        if ( $search != '' ) {

            // Verifica se foi digitado uma data válida
            if ( Helper::dataValida($search) ) {

                $comprasProduto = CompraProduto::
                    where('data', '=', Helper::formatDateUs($search))
                    ->orderBy('data', 'desc')
                    ->paginate(Helper::QTDE_ITEM_POR_PAGINA);

            } else {

                $comprasProduto = CompraProduto::
                    whereHas('fornecedor', function($query) use ($search) { $query->where('nome', 'LIKE', "%{$search}%"); })
                    ->orWhereHas('forma_pagamento', function($query) use ($search) { $query->where('descricao', 'LIKE', "%{$search}%"); })
                    ->orderBy('data', 'desc')
                    ->paginate(Helper::QTDE_ITEM_POR_PAGINA);

            }

        } else {
            $comprasProduto = CompraProduto::orderBy('data', 'desc')->paginate(Helper::QTDE_ITEM_POR_PAGINA);
        }

        return view('compra-produto.index', compact('comprasProduto'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $compra_produto_itens = request()->session()->get('compra_produto_itens', []);

        $produtos = Produto::all();
        $fornecedores = Fornecedor::all();
        $formas_pagamento = FormaPagamento::all();

        return view('compra-produto.create', compact('produtos', 'fornecedores', 'formas_pagamento', 'compra_produto_itens'));

    }

    public function rulesCompra()
    {
        return [
            'data' => 'required|date',
            'fornecedor_id' => 'nullable|integer',
            'forma_pagamento_id' => 'nullable|integer',
            'pdf' => 'nullable|mimetypes:application/pdf|max:10000',
            'itens_erro' => 'required|array|min:1',
        ];
    }

    public function attributesCompra()
    {
        return [
            'data' => 'data',
            'fornecedor_id' => 'fornecedor',
            'forma_pagamento_id' => 'forma de pagamento',
            'pdf' => 'arquivo (pdf)',
            'itens_erro' => 'produtos'
        ];
    }

    public function messagesCompra()
    {
        return [
            'itens_erro.required' => 'Nenhum produto/mercadoria foi informado.'
        ];
    }

    public function rulesItem()
    {
        return [
            'produto_id' => 'required|integer',
            'valor' => ['required', Helper::REGEX_MONEY_2_DIGITS],
            'quantidade' => ['required', Helper::REGEX_MONEY_2_DIGITS],
            'total' => 'nullable',
        ];
    }

    public function attributesItem()
    {
        return [
            'produto_id' => 'produto',
            'valor' => 'valor',
            'quantidade' => 'quantidade',
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ( $request->has('salvar') ) {

            $dados = $request->only(['data', 'fornecedor_id' , 'forma_pagamento_id', 'pdf', 'nome_pdf']);

            $compra_produto_itens = request()->session()->get('compra_produto_itens', []);
            $dados['itens_erro'] = $compra_produto_itens;

            $validacao = Validator::make($dados, $this->rulesCompra(), $this->messagesCompra(), $this->attributesCompra());

            if ($validacao->fails()) {
                return redirect()
                    ->route('compra-produto.create')
                    ->withErrors($validacao)
                    ->withInput();
            }

            $val = $validacao->validated();

            if ( !is_null($request->file('pdf')) && $request->file('pdf')->isValid() ) {
                $file = $request->file('pdf')->store('compra-produto');
                $val['pdf'] = $file;
                $val['nome_pdf'] = $request->file('pdf')->getClientOriginalName();
            }

            if ($compra_produto = CompraProduto::create($val) ) {

                foreach($compra_produto_itens as $item) {
                    DB::table('compras_produto_item')->insert(
                        [
                            'compras_produto_id' => $compra_produto->id,
                            'produto_id' => $item->produto_id,
                            'valor' => $item->valor,
                            'quantidade' => $item->quantidade,
                            'total' => $item->total,
                            'created_at' => $item->created_at,
                        ]
                    );
                }

                return redirect()->route('compra-produto.index')->with('alert', 'success')->with('mensagem', 'Lançamento realizado com sucesso!');

            }

            return redirect()->route('compra-produto.index')->with('alert', 'danger')->with('mensagem', 'Ocorreu um erro na gravação do lançamento!');

        }

        if ( $request->has('cancelar') ) {

            // Deleta a sessão
            if ($request->session()->exists('compra_produto_itens')) {
                $request->session()->forget('compra_produto_itens');
            }

            return redirect()
                ->route('compra-produto.index')
                ->with('alert', 'warning')->with('mensagem', 'Cancelado pelo usuário!');

        }

        // se no post não vir "salvar" ou "cancelar" é para adiconar um item
        //if ( $request->has('add_item') ) {

            $dados = $request->only(['produto_id', 'valor' , 'quantidade', 'total']);
            $validacao = Validator::make($dados, $this->rulesItem(), [], $this->attributesItem());

            if ($validacao->fails()) {
                return redirect()
                    ->route('compra-produto.create')
                    ->withErrors($validacao)
                    ->withInput();
            }

            $val = $validacao->validated();

            $item = new CompraProdutoItem();
            $item->produto_id = $val['produto_id'];
            $item->valor = $val['valor'];
            $item->quantidade = $val['quantidade'];
            $item->total = $val['total'];

            $request->session()->push('compra_produto_itens', $item);

            return redirect()
                ->route('compra-produto.create')
                ->withInput($request->except(['produto_id', 'valor' , 'quantidade', 'total']));

        //}

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CompraProduto  $compraProduto
     * @return \Illuminate\Http\Response
     */
    public function show(CompraProduto $compraProduto)
    {
        return view('compra-produto.show', compact('compraProduto'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CompraProduto  $compraProduto
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompraProduto $compraProduto)
    {

        $arquivo = $compraProduto->pdf;

        $compraProduto->delete();

        // Se existir um arquivo informado deleta
        if ( Storage::exists($arquivo) ) {
            Storage::delete($arquivo);
        }

        return redirect()->route('compra-produto.index')->with('alert', 'success')->with('mensagem', 'Lançamento excluido com sucesso!');

    }

}
