<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Productos_pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Http\Controllers\MailController;
class PedidoController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $productos=$request->input('productos');
        $pedido=new Pedido();
        $pedido->user_id=auth()->user()->id;
        $pedido->estado="En Proceso";
        $pedido->save();
        for($i=0;$i<count($productos);$i++){
            //INSERCION EN LA BASE DE DATOS
            $productos_pedido=new Productos_pedido();
            $productos_pedido->producto_id=$productos[$i]["id_producto"];
            $productos_pedido->pedido_id=Pedido::orderBy('id', 'desc')->first()["id"];
            $productos_pedido->cantidad=$productos[$i]["cantidad"];
            $productos_pedido->save();
        }
    
        return "Insercion correcta";    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = Auth::user();

        if ($user->admin) {
            // index
            return view('pedidos.index',['pedidos' => Pedido::all()]);
        }
        else {
            $pedidos = Pedido::where('user_id',$user->id)->get();

            //$pedidos = $user->pedidos;
            //$a = Pedido::find(2)->usuario;
            //dd($pedidos);
            return view('pedidos.show',['pedidos' => $pedidos]);
        }  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function edit(Pedido $pedido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $pedido=Pedido::find($id);
        if(request('estado')!=$pedido->estado){
            $pedido->estado=request('estado');
            
            if(request('estado')=="preparado"){
                $cliente=User::find($pedido->user_id);
                (new MailController)->sendEmail($cliente->email);
            }
            $pedido->save();
        }
        return redirect(route('pedidos.show'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pedido $pedido)
    {
        //
    }
}
