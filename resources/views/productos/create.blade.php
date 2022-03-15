@extends('layouts.app')

@section('content')
    <form class="col-11 col-md-9 border border-2 rounded-3 border-secondary p-3" action="{{route('store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <h2 class="col text-center">A&ntilde;adir producto</h2>
        </div>
        <div class="row">
            <label class="form-label position-relative col-12 col-md-6 mt-3">
                <input class="form-control" required type="text" name="nombre" id="nombre" placeholder=" ">
                <span class="ps-3 ">Nombre</span>
            </label>
            <label class="form-label position-relative col-12 col-md-6 mt-3">
                <input class="form-control" required type="text" name="precio" id="precio" placeholder=" ">
                <span class="ps-3">Precio</span>
            </label>
            @if(precioError)
                <p>Precio incorrecto</p>
            @endif
        </div>
        <div class="row my-2">
            <div class="col">
                <label class="form-label m-0 mb-1" for="imagen">Foto</label>
                <input class="form-control" required type="file" name="imagen" id="imagen" accept="image/png,image/jpg,image/jpeg,">
            </div>
        </div>
            
        <div class="row my-2">
            <div class="col">
                <label class="form-label m-0 mb-1" for="descripcion">Descripcion</label>
                <textarea class="form-control" required name="descripcion" id="descripcion" placeholder="una breve descripcion del producto " rows="3"></textarea>
            </div>
        </div>
        <div class="row my-2">
            
            <div class="col">
                <input class="btn btn-success" type="submit" value="Añadir">
                <a href="{{route('index') }}" class="btn btn-outline-dark m-1 ">Volver</a>
            </div>
        </div>
    </form>


@endsection
