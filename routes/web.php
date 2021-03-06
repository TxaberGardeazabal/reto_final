<?php
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;
use App\Models\Producto;
use App\Http\Controllers\Productos_pedido;

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
    return redirect(route('index'));
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get("/carrito",[Productos_pedido::class, 'index'])->name("carrito");
Route::get('/carrito/producto/{id}',[Productos_pedido::class, 'visualilzar_productos']);
Route::post('/carrito/compra',[PedidoController::class,'store'])->name('compra');

Route::delete('/producto/{id}', [ProductoController::class,'destroy'])->name('destroy');
Route::get('/producto', [ProductoController::class,'index'])->name('index');
Route::put('/producto/show/{id}', [ProductoController::class, 'update'])->name('update')->middleware('auth');
Route::get('/producto/create', [ProductoController::class, 'create'])->name('create')->middleware('auth');
Route::post('/producto/create', [ProductoController::class, 'store'])->name('store')->middleware('auth');
Route::get('/producto/show/{id}', [ProductoController::class, 'show'])->name('show');
Route::get('/pedidos/show', [PedidoController::class, 'show'])->name('pedidos.show')->middleware('auth');
Route::post('/pedidos/update/{id}', [PedidoController::class, 'update'])->name('pedidos.update')->middleware('auth');


