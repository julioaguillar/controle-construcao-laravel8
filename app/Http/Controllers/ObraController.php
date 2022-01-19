<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateObraRequest;
use App\Models\Obra;

class ObraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $obra = Obra::get()->first();
        return view('obra.index', compact('obra'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateObraRequest  $request
     * @param  \App\Models\Obra  $obra
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateObraRequest $request, $id)
    {

        if( !$obra = Obra::find($id) ) {
            return redirect()
                ->route('dashboard.index')
                ->with('alert', 'danger')
                ->with('mensagem', 'Não foi possível salvar os dados da Obra!');
        }

        $dados = $request->all();

        if ( $request->has('termino') ) {
            $dados['termino'] = date('Y-m-d');
        }

        $obra->update($dados);

        return redirect()
            ->route('dashboard.index')
            ->with('alert', 'success')
            ->with('mensagem', 'Obra salva com sucesso!');

    }

}
