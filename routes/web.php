<?php

use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;
use App\Models\Producto;

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


Route::get('/', [ProductoController::class,'index'])->name('index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get("/carrito",function(){
    return view("carrito");
})->name("carrito");

Route::get('/producto/create', [ProductoController::class, 'create'])->name('create');
Route::post('/producto/create', [ProductoController::class, 'store'])->name('store');
Route::get('/producto/{id}',function($id){
    $producto = Producto::where('id',$id)->first();
    return $producto;
});

Route::post('/carrito/compra',[PedidoController::class,'store'])->name('compra');


