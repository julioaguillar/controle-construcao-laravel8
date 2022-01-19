<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
        <title>Aonconstru</title>
    </head>
    <body>
        <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
            <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="{{ route('dashboard.index') }}">Aonconstru</a>
            {{--<input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search"> --}}
            <ul class="navbar-nav px-3">
                <li class="nav-item text-nowrap">
                    <a class="nav-link" data-bs-toggle="modal" data-bs-target="#sairModal" href="#">Sair <i data-feather="log-out"></i></a>
                </li>
            </ul>
        </nav>
        <div class="container-fluid">
            <div class="row">
                <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                    <div class="sidebar-sticky">
                        <ul class="nav flex-column mb-2">
                            <li class="nav-item">
                                <a class="nav-link {{ Request::path() == 'dashboard' ? 'active' : '' }}" href="{{ route('dashboard.index') }}">
                                    <span data-feather="airplay"></span>
                                    Painel de Controle
                                </a>
                            </li>
                        </ul>
                        <ul class="nav flex-column">
                            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                                <span>CADASTROS</span>
                            </h6>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::path() == 'obra' ? 'active' : '' }}" href="{{ route('obra.index') }}">
                                    <span data-feather="home"></span>
                                    Obra
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::path() == 'produto' ? 'active' : '' }}" href="{{ route('produto.index') }}">
                                    <span data-feather="shopping-cart"></span>
                                    Produtos/Mercadorias
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::path() == 'servico' ? 'active' : '' }}" href="{{ route('servico.index') }}">
                                    <span data-feather="shopping-bag"></span>
                                    Serviços
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::path() == 'fornecedor' ? 'active' : '' }}" href="{{ route('fornecedor.index') }}">
                                    <span data-feather="truck"></span>
                                    Fornecedores
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::path() == 'prestador-servico' ? 'active' : '' }}" href="{{ route('prestador-servico.index') }}">
                                    <span data-feather="users"></span>
                                    Prestadores de Serviço
                                </a>
                            </li>
                        </ul>
                        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                            <span>LANÇAMENTOS</span>
                        </h6>
                        <ul class="nav flex-column mb-2">
                            <li class="nav-item">
                                <a class="nav-link" {{ Request::path() == 'compra-produto' ? 'active' : '' }} href="{{ route('compra-produto.index') }}">
                                    <span data-feather="dollar-sign"></span>
                                    Compra de Produto/Mercadoria
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" {{ Request::path() == 'servico-tomado' ? 'active' : '' }} href="{{ route('servico-tomado.index') }}">
                                    <span data-feather="dollar-sign"></span>
                                    Serviço Tomado
                                </a>
                            </li>
                        </ul>
                        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                            <span>RELATÓRIOS</span>
                        </h6>
                        <ul class="nav flex-column mb-2">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('relatorio.compra-produto') }}">
                                    <span data-feather="printer"></span>
                                    Compras de Produtos/Mercadorias
                                </a>
                            </li>
                        </ul>
                        <ul class="nav flex-column mb-2">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('relatorio.servico-tomado') }}" target="_blank">
                                    <span data-feather="printer"></span>
                                    Serviços Tomado
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2">@yield('titulo')</h1>
                    </div>
                    @yield('conteudo')
                </main>
            </div>
        </div>
        <!-- Modal Sair -->
        <div class="modal fade" id="sairModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="sairModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="sairModalLabel">Aonconstru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Sair do sistema?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <a href="{{ route('usuario.logout') }}" class="btn btn-primary">Confirmar</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- ****************************** -->
        <script> feather.replace() </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js" integrity="sha512-nnzkI2u2Dy6HMnzMIkh7CPd1KX445z38XIu4jG1jGw7x5tSL3VBjE44dY4ihMU1ijAQV930SPM12cCFrB18sVw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="{{ asset('js/app.js') }}"></script>
        @yield('script')
    </body>
</html>
