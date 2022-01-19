<?php

namespace App\Http\Controllers;

use App\Models\CompraProduto;
use App\Models\Obra;
use App\Models\ServicoTomado;
use DateTime;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function index()
    {

        $dias = 0.0;
        $dias_trabalhados = 0.0;
        $dias_atraso = 0.0;
        $percent_trabalhado = 0.0;
        $percent_atraso = 0.0;
        $gasto_por_metro = 0.0;

        $obra = Obra::get()->first();

        if ( !is_null($obra->inicio) ) {

            $data_inicio = new DateTime($obra->inicio);

            if ( !is_null($obra->termino) )
                $data_atual = new DateTime($obra->termino);
            else
                $data_atual = new DateTime(date('Y-m-d'));

            $intervalo = $data_inicio->diff($data_atual);
            $dias_trabalhados = $intervalo->days;
            $dias_trabalhados++; // Ajusta para considerar o dia inclusive

            if ( !is_null($obra->fim) ) {

                $data_fim = new DateTime($obra->fim);

                $intervalo_dias = $data_inicio->diff($data_fim);
                $dias = $intervalo_dias->days;

                if ( $dias_trabalhados > $dias ) {
                    $dias_atraso = $dias_trabalhados - $dias;
                    $dias_trabalhados = $dias;
                }

            }

        }

        if ( $dias > 0.0 ) {
            $percent_trabalhado = ( $dias_trabalhados * 100 ) / $dias;
            $percent_atraso = ( $dias_atraso * 100 ) / $dias;
        }

        $total_servico = DB::select('SELECT SUM(COALESCE(valor, 0.00)) AS total FROM servicos_tomado');
        $total_produto = DB::select('SELECT SUM(COALESCE(total, 0.00)) AS total FROM compras_produto_item');

        $gasto_total_obra = $total_produto[0]->total + $total_servico[0]->total;

        if ( $obra->metragem > 0.0 )
            $gasto_por_metro = ( (float)$gasto_total_obra / $obra->metragem );

        return view('dashboard.index', compact('obra', 'gasto_por_metro', 'gasto_total_obra', 'dias', 'dias_trabalhados', 'dias_atraso', 'percent_trabalhado', 'percent_atraso'));

    }

}
