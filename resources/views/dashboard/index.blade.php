@extends('templates/dashboard')

@section('titulo')
Painel de Controle
@stop
@section('conteudo')
    {{-- alert: primary, secondary, success, danger, warning, info, light e dark --}}
    @if (Session::has('mensagem'))
        @if (Session::has('alert'))
            <div class="alert alert-{{ Session::get('alert') }} alert-dismissible fade show" role="alert">
                {{ Session::get('mensagem') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @else
            <div class="alert alert-secondary alert-dismissible fade show" role="alert">
                {{ Session::get('mensagem') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    @endif
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h4 class="h4 mb-0 text-gray-800">DADOS DA OBRA</h4>
    </div>
    <div class="d-sm-flex align-items-center mb-2">
        <h4 class="h6 mb-0 text-gray-800"><strong>Proprietário: </strong>{{ $obra->proprietario }}</h4>
    </div>
    <div class="d-sm-flex align-items-center mb-4">
        <h4 class="h6 mb-0 text-gray-800"><strong>Endereço: </strong>{{ $obra->endereco }}</h4>
    </div>
    <div class="d-sm-flex align-items-center mb-2">
        <h5 class="h5 mb-0 text-gray-800">GASTO PREVISTO</h5>
    </div>
    <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
        <div class="col">
            <div class="card mb-4 rounded-3 shadow-sm">
                <div class="card-header py-3">
                    <h4 class="my-0 fw-normal">METROS CONSTRUÇÃO</h4>
                </div>
                <div class="card-body">
                    <h1 class="card-title pricing-card-title">{{ Helper::valToBR($obra->metragem) }}<small class="text-muted fw-light"> m²</small></h1>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card mb-4 rounded-3 shadow-sm">
                <div class="card-header py-3">
                    <h4 class="my-0 fw-normal">VALOR CUB</h4>
                </div>
                <div class="card-body">
                    <h1 class="card-title pricing-card-title">{{ Helper::valToBR($obra->cub) }}<small class="text-muted fw-light"> m²</small></h1>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card mb-4 rounded-3 shadow-sm">
                <div class="card-header py-3">
                    <h4 class="my-0 fw-normal">VALOR TOTAL PREVISTO</h4>
                </div>
                <div class="card-body">
                    <h1 class="card-title pricing-card-title">$ {{ Helper::valToBR($obra->valor_previsto) }}</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="d-sm-flex align-items-center mb-2">
        <h5 class="h5 mb-0 text-gray-800">GASTO REAL</h5>
    </div>
    <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">

        <div class="col">
            <div class="card mb-4 rounded-3 shadow-sm border-primary">
                <div class="card-header py-3 text-white bg-primary border-primary">
                    <h4 class="my-0 fw-normal">VALOR M²</h4>
                </div>
                <div class="card-body">
                    <h1 class="card-title pricing-card-title">$ {{ Helper::valToBR($gasto_por_metro) }}</h1>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card mb-4 rounded-3 shadow-sm border-primary">
                <div class="card-header py-3 text-white bg-primary border-primary">
                    <h4 class="my-0 fw-normal">VALOR TOTAL GASTO</h4>
                </div>
                <div class="card-body">
                    <h1 class="card-title pricing-card-title">$ {{ Helper::valToBR($gasto_total_obra) }}</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Andamento da obra</h6>
            </div>
            <div class="card-body">
                <h4 class="small font-weight-bold">Data de início: {{ Helper::formatDateBr($obra->inicio) }} <span style="float: right">Previsão de término: {{ Helper::formatDateBr($obra->fim) }}</span></h4>
                <h4 class="small font-weight-bold">Quantidade de dias trabalhados: {{ $dias_trabalhados }} <span style="float: right">Quantidade de dias para término: {{ $dias - $dias_trabalhados }}</span></h4>
                <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar" style="width: {{ $percent_trabalhado }}%" aria-valuenow="{{ $dias_trabalhados }}" aria-valuemin="1" aria-valuemax="{{ $dias }}">{{$dias_trabalhados}} / {{$dias}} dias</div>
                </div>
                <br />
                <h4 class="small font-weight-bold">Dias em atraso @if (!is_null($obra->termino) && !empty($obra->termino)) <span style="float: right">Término: {{ Helper::formatDateBr($obra->termino) }}</span> @endif</h4>
                <div class="progress">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $percent_atraso }}%" aria-valuenow="{{ $dias_atraso }}" aria-valuemin="1" aria-valuemax="{{ $dias }}">{{$dias_atraso}} dias</div>
                </div>
            </div>
        </div>
    </div>
@stop
