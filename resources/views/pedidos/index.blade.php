@extends('layouts.app')
@section('content')
        <div class="col-12 col-sm-11 col-md-10 text-center accordion" id="accordionExample">
           <h1 class=" display-1">Pedidos</h1>
            
            @forelse ($pedidos as $pedido)
                
                <div class="accordion-item">
                    <h3 class="accordion-header row gx-0" id="headingOne">
                        <button class="accordion-button collapsed col-1 w-75 border-end" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$pedido->id}}" aria-expanded="true" aria-controls="collapseOne">
                                <ul class="list-unstyled fs-3">
                                    <li>
                                        ID: {{ $pedido->id }}
                                    </li>
                                    <li> 
                                        Estado: {{ $pedido->estado }}
                                    </li>
                                    <li>
                                        Pedido en: {{ $pedido->created_at }}
                                    </li>
                                    <li>
                                        Usuario: {{ $pedido->user_id }}
                                    </li>
                                </ul>
                            </button>
                        <div class="col-3 px-2" style="box-shadow: inset 0 -1px 0 rgb(0 0 0 / 13%);">
                            <form action="{{ route('pedidos.update', ['id' => $pedido->id ]) }}" method="POST">
                                @csrf
                                <label class="form-label" for="est">Estado:</label>
                                <select class="form-select" name="estado" id="est">
                                    <option value="recibido">Recibido</option>
                                    <option value="en proceso">En proceso</option>
                                    <option value="preparado">Preparado</option>
                                    <option value="retrasado">Retrasado</option>
                                </select>
                                <input class="btn btn-primary mt-2" type="submit" value="Actualizar">
                            </form>
                        </div>
                    </h3>
                    <div id="collapse{{$pedido->id}}" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">

                        
                            @php
                                $total = 0;
                            @endphp
                            @forelse($pedido->productos as $producto)
                        
                                    @php
                                        $total += $producto->precio * $producto->pivot->cantidad;

                                    @endphp
                                    
                                    <ul class="list-unstyled fs-4"> 
                                        <li>
                                            ID: {{ $producto->id }}
                                        </li>
                                        <li>
                                            Producto: {{ $producto->nombre }}
                                        </li>
                                        <li>
                                            Precio unitario: {{ $producto->precio }}&euro;
                                        </li>
                                        <li>
                                            Cantidad: {{ $producto->pivot->cantidad }}
                                        </li>
                                    </ul>
                                    
                                
                                    
                            @empty
                                <p class="fs-5">Este producto ha dejado de estar disponible</p>
                                <hr>
                            @endforelse
                            <b class="fs-3">Total del pedido: {{ $total }}&euro;</b>

                        </div>
                    </div>
                </div>
                @empty
                    <h3>No tienes pedidos</h3>
            @endforelse
                
        </div>

    @endsection