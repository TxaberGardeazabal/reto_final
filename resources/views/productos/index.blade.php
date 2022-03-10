@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 p-0">
        <ul id="lProductos">
        @foreach($productos as $producto)

            <li class="producto m-2 text-center py-2" id="p{{$producto['id']}}">

                <form method="post" action="{{ route('destroy',  $producto['id']) }}">
                    @csrf
                    @method('DELETE')
                    <a class="text-dark text-decoration-none" href="{{ route('show',$producto->id) }}">
                        <img class="imagen mt-2" src="{{ asset('img/' . $producto['imagen']) }}">
                        <h2 class="px-2">{{$producto['nombre']}}</h2><p class="px-2 precio">{{$producto['precio']}}€</p>
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
    </div>
</div>
@endsection


