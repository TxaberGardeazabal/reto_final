@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 p-0">
        <ul id="lProductos">
            <li class="producto m-2 text-center py-2" id="p{{$producto['id']}}" >
                
                <img class="imagen" src="{{ asset('img/' . $producto['imagen']) }}">
                <h2 class="px-2">{{$producto['nombre']}}</h2>
                <p class="px-2 precio">{{$producto['precio']}}€</p>   
                    
                <form class="col-11 " method="post" enctype="multipart/form-data" action="{{ route('update',  $producto['id']) }}">  
                    @csrf
                    @method("PUT")
                    @if(auth()->user()->admin!=0)
                        <label class="form-label position-relative">
                            <input class="form-control"  type="text" name="nombre" id="nombre" placeholder=" ">
                            <span class="p-2 ">Nombre</span>
                        </label>
                        <label class="form-label position-relative">
                            <input class="form-control"  type="text" name="precio" id="precio" placeholder=" ">
                            <span class="p-2 ">Precio</span>
                        </label>
                        <label class="form-label position-relative">
                            <input class=""  type="file" name="imagen" id="imagen" accept="image/png,image/jpg,image/jpeg,">
                        </label> 
                    
                    @endif
                    <div class="form-floating">
                        <textarea class="form-control text-center" name="descripcion"  placeholder="" id="floatingTextarea2" style="height: 100px" 
                        @if(auth()->user()->admin!=1){
                            disabled
                        }
                        @endif
                        >{{$producto['descripcion']}} </textarea>
                    </div>
                    <div>
                        @if(auth()->user()->admin!=0)
                        <input class="btn btn-primary m-2" type="submit" value="Actualizar">
                        @endif

                        <button id="{{$producto['id']}}" onclick="compra(this.id)" type="button" class="btn btn-outline-dark bcompra">Añadir al Carrito</button>
                        <a href="{{route('index') }}" class="btn btn-outline-dark m-3 mb-0">Volver</a>
                    </div>
                </form>
            </li>
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