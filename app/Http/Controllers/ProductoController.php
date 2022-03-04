<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos=Producto::all();
        return view("productos.index")->with('productos',$productos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('productos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $producto=new Producto();
        $producto->nombre=$request->nombre;
        $producto->precio=$request->precio;
        //if($request->hasFile("imagen")){
            
            $nombreimg=Str::slug($request->nombre).".".$request->imagen->extension();

            $request->imagen->move(public_path('img'), $nombreimg);
            //$guardar= $imagen->store('nombreimg');
            //Storage::disk('local')->put($nombreimg, $request->imagen);
            //copy($imagen->getRealPath(),$ruta.$nombreimg);
            $producto->imagen=$nombreimg;
        //}
        $producto->descripcion=$request->descripcion;
        $producto->save();
        return redirect(route('index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
       //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        //
    }

        /**
         * Get the value of productos
         */ 
        public function getProductos()
        {
                return $this->productos;
        }

    public function searchById($id){
        $producto = Producto::where('id',$id)->first();
        return $producto;
    }
}
