
@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 p-0">
        <ul id="lProductos">
        @foreach($productos as $producto)
            <li class="producto m-2 text-center py-2" id="p{{$producto['id']}}" >
                <form method="post" action="./">
                    <a class="text-dark text-decoration-none" href="{{ route('show',$producto->id) }}">
                        <img class="imagen" src="{{ asset('img/magdalenas.png') }}" alt="">
                        <h2 class="px-2">{{$producto['nombre']}}</h2><p class="px-2 precio">{{$producto['precio']}}€</p>
                    </a>
                    <button type="button" class="btn btn-outline-danger">Danger</button>
                    <button id="{{$producto['id']}}" onclick="compra(this.id)" type="button" class="btn btn-outline-dark bcompra">Añadir al Carrito</button>
                </form>
            </li>
        @endforeach
        </ul>
    </div>
</div>
@endsection
<script>
    function compra(id){
        var productos = sessionStorage.getItem('carrito');
        if(productos){//Si hay mas productos
            var productosFind=[];
            productosFind=productos.split(" ");
            var duplicado=false;
            productosFind.find(function(element){//Busca si el producto ya existe
                if(element==id){
                    duplicado=true;
                }
            });
            if(duplicado==true){
                console.log("El producto esta duplicado");
            }else{
                productos=productos + " " + id;
                sessionStorage.setItem('carrito',productos);
            }
        }else{//Si el carrito esta vacio
            productos=id;
            sessionStorage.setItem('carrito',productos);
        }
      
    }
</script>

