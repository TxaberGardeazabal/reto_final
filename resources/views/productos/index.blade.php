<style>
    /*Movil*/
    #lProductos{
        list-style: none;
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: space-evenly;
        padding: 0%;
    }

    .producto{
        background-color: white;
        width: 88%;
        margin:0 auto;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        box-shadow: 0px 0px 2px 2px #ebebeb;
        position: relative;
    }

    .imagen{
        width: 20em;
    }

    .precio{
        font-weight: bold;
        font-size: larger
    }

    .bcompra{
        position: absolute;
        right: 2%;
        bottom: 3%;
    }

    .beliminar{
        position: absolute;
        left: 2%;
        bottom: 3%;
    }

    /*Tablet*/
    @media(min-width:768px){
        .producto{
            width: 45%;
        }
        .imagen{
            width: 23em;
        }
    }

    /*PC*/
    @media(min-width:992px){
        .producto{
            width: 30%;
        }
        .imagen{
            width: 23em;
        }
    }
</style>
@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 p-0">
        <ul id="lProductos">
        @foreach($productos as $producto)
            <li class="producto m-2 text-center py-2" id="p{{$producto['id']}}">
                <form method="post" action="./">
                    <img class="imagen" src="{{ asset('img/' . $producto['imagen']) }}">
                    <h2 class="px-2">{{$producto['nombre']}}</h2><p class="px-2 precio">{{$producto['precio']}}€</p>
                    <button type="button" class="btn btn-outline-danger beliminar">Eliminar</button>
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

