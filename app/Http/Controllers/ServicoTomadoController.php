<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\StoreUpdateServicoTomadoRequest;
use App\Models\FormaPagamento;
use App\Models\PrestadorServico;
use App\Models\Servico;
use App\Models\ServicoTomado;
use Illuminate\Support\Facades\Storage;

class ServicoTomadoController extends Controller
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

            // Verifica se foi digitado uma data válida
            if ( Helper::dataValida($search) ) {

                $servicosTomado = ServicoTomado::
                    where('data', '=', Helper::formatDateUs($search))
                    ->orderBy('data', 'desc')
                    ->paginate(Helper::QTDE_ITEM_POR_PAGINA);

            } else {

                $servicosTomado = ServicoTomado::
                    whereHas('servico', function($query) use ($search) { $query->where('descricao', 'LIKE', "%{$search}%"); })
                    ->orWhereHas('prestador_servico', function($query) use ($search) { $query->where('nome', 'LIKE', "%{$search}%"); })
                    ->orWhereHas('forma_pagamento', function($query) use ($search) { $query->where('descricao', 'LIKE', "%{$search}%"); })
                    ->orderBy('data', 'desc')
                    ->paginate(Helper::QTDE_ITEM_POR_PAGINA);

            }

        } else {
            $servicosTomado = ServicoTomado::orderBy('data', 'desc')->paginate(Helper::QTDE_ITEM_POR_PAGINA);
        }

        $qtde_servicos_tomado = $servicosTomado->count();
        $total_servicos_tomado = $servicosTomado->sum('valor');

        return view('servico-tomado.index', compact('servicosTomado', 'qtde_servicos_tomado', 'total_servicos_tomado'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $servicos = Servico::all();
        $prestadores_servico = PrestadorServico::all();
        $formas_pagamento = FormaPagamento::all();

        return view('servico-tomado.create', compact('servicos', 'prestadores_servico', 'formas_pagamento'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateServicoTomadoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateServicoTomadoRequest $request)
    {

        $dados = $request->all();

        if ( !is_null($request->file('pdf')) && $request->file('pdf')->isValid() ) {
            $file = $request->file('pdf')->store('servico-tomado');
            $dados['pdf'] = $file;
            $dados['nome_pdf'] = $request->file('pdf')->getClientOriginalName();
        }

        if (ServicoTomado::create($dados)) {
            return redirect()->route('servico-tomado.index')->with('alert', 'success')->with('mensagem', 'Lançamento realizado com sucesso!');
        }

        return redirect()->route('servico-tomado.index')->with('alert', 'danger')->with('mensagem', 'Erro ao incluir o Lançamento');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ServicoTomado  $servicoTomado
     * @return \Illuminate\Http\Response
     */
    public function show(ServicoTomado $servicoTomado)
    {
        return view('servico-tomado.show', compact('servicoTomado'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ServicoTomado  $servicoTomado
     * @return \Illuminate\Http\Response
     */
    public function edit(ServicoTomado $servicoTomado)
    {

        $servicos = Servico::all();
        $prestadores_servico = PrestadorServico::all();
        $formas_pagamento = FormaPagamento::all();

        return view('servico-tomado.edit', compact('servicoTomado', 'servicos', 'prestadores_servico', 'formas_pagamento'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateServicoTomadoRequest  $request
     * @param  \App\Models\ServicoTomado  $servicoTomado
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateServicoTomadoRequest $request, ServicoTomado $servicoTomado)
    {

        if (!$serv = ServicoTomado::find($servicoTomado->id)) {
            return redirect()->route('servico-tomado.index')->with('alert', 'danger')->with('mensagem', 'Lançamento não localizado. Verifique!');
        }

        $dados = $request->all();

        // Se não tiver nenhum arquivo informado ou se informar um arquivo novo exclui o antigo
        if ( !is_null($request->file('pdf')) || ( is_null($dados['nome_pdf']) || $dados['nome_pdf'] === '' ) ) {

            if ( Storage::exists($servicoTomado->pdf) ) {
                Storage::delete($servicoTomado->pdf);
            }

            $dados['nome_pdf'] = '';
            $dados['pdf'] = '';

        }

        if ( !is_null($request->file('pdf')) && $request->file('pdf')->isValid() ) {
            $file = $request->file('pdf')->store('servico-tomado');
            $dados['pdf'] = $file;
            $dados['nome_pdf'] = $request->file('pdf')->getClientOriginalName();
        }

        $serv->update($dados);
        return redirect()->route('servico-tomado.index')->with('alert', 'success')->with('mensagem', 'Lançamento atualizado com sucesso!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ServicoTomado  $servicoTomado
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServicoTomado $servicoTomado)
    {

        $arquivo = $servicoTomado->pdf;

        $servicoTomado->delete();

        // Se existir um arquivo informado deleta
        if ( Storage::exists($arquivo) ) {
            Storage::delete($arquivo);
        }

        return redirect()->route('servico-tomado.index')->with('alert', 'success')->with('mensagem', 'Lançamento excluido com sucesso!');

    }

}
