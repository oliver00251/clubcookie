<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\ProdutoController;
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

// rota para exibir PDF de apresentação
Route::get('/apresentacao', function () {
    return view('afiliado'); // Blade que vai conter o iframe
});
Route::post('/leads', [LeadController::class, 'store'])->name('leads.store');



Route::get('/', [HomeController::class, 'index'])->name('home');

// Listar produtos
Route::get('/produtos', [ProdutoController::class, 'index'])->name('produtos.index');

// Formulário de criação (não obrigatório com modal, mas pode existir)
Route::get('/produtos/create', [ProdutoController::class, 'create'])->name('produtos.create');

// Salvar novo produto (POST)
Route::post('/produtos', [ProdutoController::class, 'store'])->name('produtos.store');

// Formulário de edição (não obrigatório com modal, mas pode existir)
Route::get('/produtos/{produto}/edit', [ProdutoController::class, 'edit'])->name('produtos.edit');

// Atualizar produto existente (PUT/PATCH)
Route::put('/produtos/{produto}', [ProdutoController::class, 'update'])->name('produtos.update');

// Excluir produto (DELETE)
Route::delete('/produtos/{produto}', [ProdutoController::class, 'destroy'])->name('produtos.destroy');


// Tela de login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

// Processar login
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
