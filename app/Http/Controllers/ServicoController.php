<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Servico;
use App\Models\ServicoTomado;
use Illuminate\Http\Request;

class ServicoController extends Controller
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
            $servicos = Servico::orderBy('descricao')
                ->where('descricao', 'LIKE', "%{$search}%")
                ->paginate(Helper::QTDE_ITEM_POR_PAGINA);

        } else {
            $servicos = Servico::orderBy('descricao')->paginate(Helper::QTDE_ITEM_POR_PAGINA);
        }

        return view('servico.index', compact('servicos'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('servico.create');
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
            return redirect()->route('servico.index')->with('alert', 'danger')->with('mensagem', 'Cadastro cancelado pelo usuário');
        }

        $request->validate([
            'descricao' => 'required|min:1|max:120',
        ]);

        $servico = Servico::create($request->all());
        if ($servico) {
            return redirect()->route('servico.index')->with('alert', 'success')->with('mensagem', 'Serviço cadastrado com sucesso!');
        }

        return redirect()->route('servico.index')->with('alert', 'danger')->with('mensagem', 'Erro ao incluir o Serviço');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Servico  $servico
     * @return \Illuminate\Http\Response
     */
    public function show(Servico $servico)
    {
        return view('servico.show', compact('servico'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Servico  $servico
     * @return \Illuminate\Http\Response
     */
    public function edit(Servico $servico)
    {
        return view('servico.edit', compact('servico'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Servico  $servico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Servico $servico)
    {

        if ( $request->has('cancelar') ) {
            if ( $request->has('url') ) {
                return redirect($request->url)->with('alert', 'danger')->with('mensagem', 'Cadastro cancelado pelo usuário');
            }
            return redirect()->route('servico.index')->with('alert', 'danger')->with('mensagem', 'Cadastro cancelado pelo usuário');
        }

        $request->validate([
            'descricao' => 'required|min:1|max:120',
        ]);

        if (!$fornec = Servico::find($servico->id)) {
            return redirect()->route('servico.index')->with('alert', 'danger')->with('mensagem', 'Serviço não localizado. Verifique!');
        }

        $fornec->update($request->all());
        return redirect()->route('servico.index')->with('alert', 'success')->with('mensagem', 'Serviço atualizado com sucesso!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Servico  $servico
     * @return \Illuminate\Http\Response
     */
    public function destroy(Servico $servico)
    {

        $descricao = $servico->descricao;

        if ($servico->servicosTomado->count() > 0 ) {
            return redirect()->route('servico.index')->with('alert', 'warning')->with('mensagem', "Serviço $descricao não pode ser excluído! Existe relacionamento com o lançamento de serviço tomado.");
        }

        if ( $servico->delete() ) {
            return redirect()->route('servico.index')->with('alert', 'success')->with('mensagem', "Serviço $descricao excluído com sucesso!");
        }

        return redirect()->route('servico.index')->with('alert', 'danger')->with('mensagem', "Erro ao excluir o serviço $descricao.");

    }

}
