@extends('layouts.app')

@section('content')
    <form class="col-11 col-md-9" action="{{route('store')}}" method="post">
    @csrf
    <h2 class="text-center">Añadir producto</h2>
        <label class="form-label position-relative">
            <input class="form-control" required type="text" name="nombre" id="nombre" placeholder=" ">
            <span class="p-2 ">Nombre</span>
        </label>
        <label class="form-label position-relative">
            <input class="form-control" required type="text" name="precio" id="precio" placeholder=" ">
            <span class="p-2 ">Precio</span>
        </label>
        <label class="form-label position-relative">
            <input class="" required type="file" name="imagen" id="imagen" accept="image/png,image/jpg,image/jpeg,">
        </label>
        <div>
            <textarea name="descripcion" id="descripcion" placeholder="Descripcion del producto " cols="100" rows="15"></textarea>
        </div>
        <input type="submit" value="Añadir">
    </form>


@endsection
