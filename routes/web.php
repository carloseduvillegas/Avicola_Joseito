<?php

use App\Http\Controllers\BloquearController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
Use App\Http\Controllers\PedidosController;
Use App\Http\Controllers\PromotoresController;
Use App\Http\Controllers\ClientesController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard',[PedidosController::class,'ventas'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {

Route::get('/mispedidos',[PedidosController::class,'index']);
//Route::get('/pedidos',[PedidosController::class,'index2']);
Route::get('/mispedidos/create',[PedidosController::class,'create']);
//Route::get('/pedidos/create',[PedidosController::class,'create2']);
Route::post('/mispedidos', [PedidosController::class,'store'])->name('pedidos.store');

Route::resource('/promotores',PromotoresController::class);

Route::get('/bloqueados',[BloquearController::class,'index']);
Route::patch('/bloqueados/{bloq}', [BloquearController::class,'update'])->name('bloquear.update');

Route::get('/bloquear',[BloquearController::class,'indexBloquear']);
Route::post('/bloquear', [BloquearController::class,'store'])->name('bloquear.store');

//Route::get('/ventas',[PedidosController::class,'ventas']);
Route::resource('/clientes',ClientesController::class);
Route::get('/client',[ClientesController::class,'todosLosClientes']);

Route::get('/pedidos/{pedido}/edit',[PedidosController::class,'edit'])->name('pedidos.edit');
Route::get('/pedidos/{detalle}/detalle',[PedidosController::class,'detalle'])->name('pedidos.detalle');
Route::put('/pedidos/{detalle}',[PedidosController::class,'update'])->name('pedidos.update');
});

require __DIR__.'/auth.php';
