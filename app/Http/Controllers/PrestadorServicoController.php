<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\PrestadorServico;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PrestadorServicoController extends Controller
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
            $prestadores_servico = PrestadorServico::orderBy('nome')
                ->where('cnpj', 'LIKE', "%{$search}%")
                ->orWhere('cpf', 'LIKE', "%{$search}%")
                ->orWhere('nome', 'LIKE', "%{$search}%")
                ->orWhere('endereco', 'LIKE', "%{$search}%")
                ->orWhere('contato', 'LIKE', "%{$search}%")
                ->paginate(Helper::QTDE_ITEM_POR_PAGINA);

        } else {
            $prestadores_servico = PrestadorServico::orderBy('nome')->paginate(Helper::QTDE_ITEM_POR_PAGINA);
        }

        return view('prestador-servico.index', compact('prestadores_servico'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('prestador-servico.create');
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
            return redirect()->route('prestador-servico.index')->with('alert', 'danger')->with('mensagem', 'Cadastro cancelado pelo usuário');
        }

        $request->validate([
            'cnpj' => 'nullable|cnpj|unique:prestadores_servico|max:18',
            'cpf' => 'nullable|cpf|unique:prestadores_servico|max:14',
            'nome' => 'required|min:1|max:100',
            'endereco' => 'nullable|max:150',
            'telefone' => 'nullable|max:14',
            'celular' => 'nullable|max:15',
            'contato' => 'nullable|max:30',
            'email' => 'nullable|email|max:150',
        ]);

        $prestador_servico = PrestadorServico::create($request->all());
        if ($prestador_servico) {
            return redirect()->route('prestador-servico.index')->with('alert', 'success')->with('mensagem', 'Prestador de seriço cadastrado com sucesso!');
        }

        return redirect()->route('prestador-servico.index')->with('alert', 'danger')->with('mensagem', 'Erro ao incluir o Prestador de serviço');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PrestadorServico  $prestador_servico
     * @return \Illuminate\Http\Response
     */
    public function show(PrestadorServico $prestador_servico)
    {
        return view('prestador-servico.show', compact('prestador_servico'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PrestadorServico  $prestador_servico
     * @return \Illuminate\Http\Response
     */
    public function edit(PrestadorServico $prestador_servico)
    {
        return view('prestador-servico.edit', compact('prestador_servico'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PrestadorServico  $prestador_servico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PrestadorServico $prestador_servico)
    {

        if ( $request->has('cancelar') ) {
            if ( $request->has('url') ) {
                return redirect($request->url)->with('alert', 'danger')->with('mensagem', 'Cadastro cancelado pelo usuário');
            }
            return redirect()->route('prestador-servico.index')->with('alert', 'danger')->with('mensagem', 'Cadastro cancelado pelo usuário');
        }

        $request->validate([
            'cnpj' => ['nullable', 'cnpj', 'max:18', Rule::unique('prestadores_servico')->ignore($prestador_servico->id)],
            'cpf' => ['nullable', 'cpf', 'max:14', Rule::unique('prestadores_servico')->ignore($prestador_servico->id)],
            'nome' => 'required|min:1|max:100',
            'endereco' => 'nullable|max:150',
            'telefone' => 'nullable|max:14',
            'celular' => 'nullable|max:15',
            'contato' => 'nullable|max:30',
            'email' => 'nullable|email|max:150',
        ]);

        if (!$fornec = PrestadorServico::find($prestador_servico->id)) {
            return redirect()->route('prestador-servico.index')->with('alert', 'danger')->with('mensagem', 'Prestador de serviço não localizado. Verifique!');
        }

        $fornec->update($request->all());
        return redirect()->route('prestador-servico.index')->with('alert', 'success')->with('mensagem', 'Prestador de serviço atualizado com sucesso!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PrestadorServico  $prestador_servico
     * @return \Illuminate\Http\Response
     */
    public function destroy(PrestadorServico $prestador_servico)
    {

        $nome = $prestador_servico->nome;

        if ( $prestador_servico->servicosTomado->count() > 0 ) {
            return redirect()->back()->with('alert', 'warning')->with('mensagem', "Não é possível excluir o prestador de serviço $nome. Existe relacionamento com o lançamento de serviço tomado.");
        }

        if ($prestador_servico->delete()) {
            return redirect()->route('prestador-servico.index')->with('alert', 'success')->with('mensagem', "Prestador de serviço $nome excluido com sucesso!");
        }

        return redirect()->route('prestador-servico.index')->with('alert', 'danger')->with('mensagem', "Erro ao excluir o serviço $nome.");

    }

}
