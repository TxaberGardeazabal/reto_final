@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 p-0">
        <div id="busqueda">
            <input id="buscador" type="text" placeholder="Buscar Elementos..." onkeyup="eventosBusqueda()" onchange="eventosBusqueda()">
            <button id="buscar" type="button" onclick="buscar()">Buscar</button>
        </div>
        <ul id="lProductos">
        @foreach($productos as $producto)

            <li class="producto m-2 text-center py-2" id="p{{$producto['id']}}">
                <form method="post" action="{{ route('destroy',  $producto['id']) }}">
                    @csrf
                    @method('DELETE')
                    <a class="text-dark text-decoration-none" href="{{ route('show',$producto->id) }}">
                        <img class="imagen mt-3" src="{{ asset('img/' . $producto['imagen']) }}">
                        <h2 class="nombre px-2 mt-3">{{$producto['nombre']}}</h2><p class="px-2 precio">{{$producto['precio']}}€</p>
                    </a>
                    @auth
                        @if(auth()->user()->admin!=0)
                            <button type="submit" class="btn btn-outline-danger beliminar">Eliminar</button>
                        @else
                            <button id="{{$producto['id']}}" onclick="compra(this.id)" type="button" class="btn btn-outline-dark ">Añadir al Carrito</button>
                        @endif
                    @else
                        <button id="{{$producto['id']}}" onclick="compra(this.id)" type="button" class="btn btn-outline-dark ">Añadir al Carrito</button>

                    @endauth
                </form>
            </li>
        @endforeach
        </ul>
          <!--Toast de inserción al carrito-->
          <div id="mensaje" class="toast position-fixed top-0 end-0 p-3" set->
            <div class="toast-header" >
                <h1>Producto añadido</h1>
                <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
            </div>
            
        </div>
    </div>
</div>
@endsection


