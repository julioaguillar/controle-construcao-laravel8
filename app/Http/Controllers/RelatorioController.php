<?php

namespace App\Http\Controllers;

use App\Models\Obra;
use App\Models\ServicoTomado;

use Barryvdh\DomPDF\Facade as PDF;

class RelatorioController extends Controller
{

    public function servicosTomado()
    {

        //$pdf = PDF::loadView('pdf.invoice', $data);
        //return $pdf->download('invoice.pdf');

        $obra = Obra::get()->first();

        $servicosTomado = ServicoTomado::orderBy('data', 'desc')->get();
        $qtde_servicos_tomado = $servicosTomado->count();
        $total_servicos_tomado = $servicosTomado->sum('valor');

        $pdf = PDF::loadView('pdf.servicos-tomados', compact('obra', 'servicosTomado', 'qtde_servicos_tomado', 'total_servicos_tomado'))->setPaper('a4', 'landscape');
        return $pdf->stream();

    }

    public function compraProduto() {

    }

}
