@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-12 p-0">
        <ul id="lProductos">
            <li class="producto m-2 text-center py-2" id="p{{$producto['id']}}" >
                
                <img class="imagen mt-2" src="{{ asset('img/' . $producto['imagen']) }}">
                <h2 class="px-2">{{$producto['nombre']}}</h2>
                <p class="px-2 precio">{{$producto['precio']}}€</p>   
                    
                <form class="col-11 " method="post" enctype="multipart/form-data" action="{{ route('update',  $producto['id']) }}">  
                    @csrf
                    @method("PUT")

                    @auth
                        @if(auth()->user()->admin!=0)
                            <label class="form-label position-relative">
                                <input class="form-control"  type="text" name="nombre" id="nombre" placeholder=" ">
                                <span class="p-2 ">Nombre</span>
                            </label>
                            <label class="form-label position-relative">
                                <input class="form-control"  type="text" name="precio" id="precio" placeholder=" ">
                                <span class="p-2 ">Precio</span>
                            </label>
                            <label class="form-label position-relative ">
                                <input class=""  type="file" name="imagen" id="imagen" accept="image/png,image/jpg,image/jpeg,">
                            </label> 
                        
                        @endif
                        <div class="form-floating">
                            <textarea class="form-control text-center mt-3" name="descripcion"  placeholder="" id="floatingTextarea2" style="height: 100px" 
                            @if(auth()->user()->admin!=1){
                                disabled
                            }
                            @endif
                            >{{$producto['descripcion']}} </textarea>
                        </div>
                        <div>
                            @if(auth()->user()->admin!=0)
                                <input class="btn btn-success m-3 mb-2" type="submit" value="Actualizar">
                            @endif
                            @if(auth()->user()->admin!=1)
                                <button id="{{$producto['id']}}" onclick="compra(this.id)" type="button" class="btn btn-outline-dark mt-1">Añadir al Carrito</button>
                            @endif

                            <a href="{{route('index') }}" class="btn btn-outline-dark m-3 mb-2">Volver</a>
                        </div>
                    @else
                        <div class="form-floating">
                            <textarea class="form-control text-center" name="descripcion"  placeholder="" id="floatingTextarea2" style="height: 100px" disabled
                            >{{$producto['descripcion']}} </textarea>
                        </div>
                        <div>
                            <button id="{{$producto['id']}}" onclick="compra(this.id)" type="button" class="btn btn-outline-dark mt-1">Añadir al Carrito</button>
                            <a href="{{route('index') }}" class="btn btn-outline-dark m-3 mb-2">Volver</a>
                        </div>
                    @endauth
                </form>
            </li>
        </ul>
    </div>
</div>
@endsection

