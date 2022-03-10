@extends('layouts.app')
@section('content')

        <div class="col accordion col-12 col-sm-11 col-md-10 text-center" id="accordionExample">
            <h1 class=" display-1">Tus pedidos</h1>
            <hr class="my-2">
        @php
            $contador = 0;
        @endphp
            
            @forelse ($pedidos as $pedido)
            @php
                $contador ++;
            @endphp
            
            <div class="accordion-item">
                <h3 class="accordion-header" id="headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$pedido->id}}" aria-expanded="true" aria-controls="collapseOne">
                        <ul class="list-unstyled fs-3">
                            <li>
                                Pedido {{ $contador }}
                            </li>
                            <li>
                                Estado: {{ $pedido->estado }}
                            </li>
                            <li>
                                Pedido en: {{ $pedido->created_at }}
                            </li>
                        </ul>
                        </button>
                </h3>
                <div id="collapse{{$pedido->id}}" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">

                       
                        @php
                            $total = 0;
                            $contador2 = 0;
                        @endphp
                        @foreach($pedido->productos as $producto)

                        @php
                            $total += $producto->precio * $producto->pivot->cantidad;
                            $contador2 ++;
                        @endphp
                        
                        <ul class="list-unstyled fs-4">
                            <li>
                                Producto: {{ $contador2 }}
                            </li>
                            <li>
                                Nombre: {{ $producto->nombre }}
                            </li>
                            <li>
                                Precio unitario: {{ $producto->precio }}&euro;
                            </li>
                            <li>
                                Cantidad: {{ $producto->pivot->cantidad }}
                            </li>
                        </ul>
                        <hr>

                        @endforeach
                        <b class="fs-3">Total del pedido: {{ $total }}&euro;</b>

                    </div>
                </div>
            </div>
            @empty
            <h3 >No tienes pedidos</h3>
            @endforelse
                
        </div>
        
@endsection