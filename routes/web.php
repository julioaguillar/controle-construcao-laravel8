<?php

use App\Http\Controllers\CompraProdutoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\ObraController;
use App\Http\Controllers\PrestadorServicoController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\RelatorioController;
use App\Http\Controllers\ServicoController;
use App\Http\Controllers\ServicoTomadoController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
})->name('login');

Route::post('/login', [UsuarioController::class, 'login'])->name('usuario.login');
Route::get('/logout', [UsuarioController::class, 'logout'])->name('usuario.logout');

Route::middleware(['usuario.logado'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::post('/download/pdf', function (Request $request) {
        $headers = array('Content-Type: application/pdf');
        return response()->download(storage_path('app/') . $request->pdf, $request->nome_pdf, $headers);
        //return Storage::download('servico-tomado/ndUQmRiN2y1Um6N0vSm03c9upXksvzP5LaPn2Kve.pdf', 'Nome Arquivo.pdf', $headers);
    })->name('download-pdf');

    // OBRA
    Route::get('/obra', [ObraController::class, 'index'])->name('obra.index');
    Route::put('/obra/{obra}', [ObraController::class, 'update'])->name('obra.update');
    // ****************************************************************

    Route::resource('fornecedor', FornecedorController::class);
    Route::resource('prestador-servico', PrestadorServicoController::class);
    Route::resource('produto', ProdutoController::class);
    Route::resource('servico', ServicoController::class);
    Route::resource('compra-produto', CompraProdutoController::class)->except(['edit', 'update']);
    Route::resource('servico-tomado', ServicoTomadoController::class);

    // RELATÓRIOS
    Route::get('/relatorio/compra-produto', [RelatorioController::class, 'compraProduto'])->name('relatorio.compra-produto');
    Route::get('/relatorio/servico-tomado', [RelatorioController::class, 'servicosTomado'])->name('relatorio.servico-tomado');
    // ****************************************************************

});
