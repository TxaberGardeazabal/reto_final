@extends('layouts.app')
@section('content')

        <div class="col accordion col-12 col-sm-11 col-md-10 text-center" id="accordionExample">
           
        @php
            $contador = 0;
        @endphp
            
            @forelse ($pedidos as $pedido)
            @php
                $contador ++;
            @endphp
            
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <ul class="list-unstyled fs-3">
                            <li>
                                numero {{ $contador }}
                            </li>
                            <li>
                                estado: {{ $pedido->estado }}
                            </li>
                            <li>
                                pedido en: {{ $pedido->created_at }}
                            </li>
                        </ul>
                        </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">

                       
                        @php
                            $total = 0;
                        @endphp
                        @foreach($pedido->productos as $producto)

                        @php
                            $total += $producto->precio * $producto->pivot->cantidad;
                        @endphp
                        
                        <ul class="list-unstyled">
                            <li>
                                id: {{ $producto->id }}
                            </li>
                            <li>
                                producto: {{ $producto->nombre }}
                            </li>
                            <li>
                                precio unitario: {{ $producto->precio }}&euro;
                            </li>
                            <li>
                                cantidad: {{ $producto->pivot->cantidad }}
                            </li>
                        </ul>
                        <hr>

                        @endforeach
                        <b>total del pedido: {{ $total }}&euro;</b>

                    </div>
                </div>
            </div>
            @empty
            <h2 >no tienes pedidos</h2>
            @endforelse
                
        </div>
        
@endsection