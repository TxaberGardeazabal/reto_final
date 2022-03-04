<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
    <title>Document</title>
</head>
<body class="container">
    <div class="row">
        <div class="col accordion" id="accordionExample">
           
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
                        <ul>
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
                        
                        <ul>
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
                <p>no tienes pedidos</p>
            @endforelse
                
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}" type="text/js"></script>
</body>
</html>