@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-12  ">
        <h2 class="text-center mb-3">Carrito de la compra</h2>
        <table class="table table-bordered table-dark w-75 mx-auto text-center">
            <thead class="thead-dark">
                <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Precio</th>
                <th scope="col">Total</th>
                <th scope="col">Eliminar</th>
                </tr>
            </thead>
            <tbody id="tablaCarrito" class="table-light">            
            </tbody>
            
        </table>
        <div class="row justify-content-center w-40 mx-auto col-3">
            <a href="{{route('index') }}" class="btn btn-outline-dark m-3 ms-5">Volver</a>
        </div>
    </div>
</div>
@endsection

<script>
    
        var carrito=[];
        carrito=sessionStorage.getItem('carrito').split(" ");
        console.log(carrito);
        if(carrito){
            var tabla=document.getElementById("tablaCarrito");
            for(let i=0;i<carrito.length;i++){
                //Peticion 
                $.ajax({
                    url: '/producto/' + carrito[i],
                    type: 'GET',
                    cache: false,
                    success: function (data) {
                        console.log(data);
                        //Crea los elementos
                        var elemento=document.createElement("tr");
                        var nombre=document.createElement("td");
                        var textNombre=document.createTextNode(data["nombre"]);
                        var cantidad=document.createElement("td");
                        var inputCantidad=document.createElement("input");
                        var textCantidad=document.createTextNode("4");
                        inputCantidad.setAttribute("type","number");
                        inputCantidad.setAttribute("value",1);
                        inputCantidad.setAttribute("min",1);
                        var precio=document.createElement("td");
                        var textPrecio=document.createTextNode(`${data["precio"]} €`);
                        var precioFinal=document.createElement("td");
                        var textPrecioFinal=document.createTextNode(`${data["precio"]} €`);
                        var eliminar=document.createElement("button");
                        var textEliminar=document.createTextNode("Eliminar");
                        nombre.appendChild(textNombre);
                        cantidad.appendChild(inputCantidad);
                        precio.appendChild(textPrecio);
                        precioFinal.appendChild(textPrecioFinal);
                        eliminar.appendChild(textEliminar);
                        eliminar.id=`e${data["id"]}`;
                        eliminar.setAttribute("class","btn btn-outline-danger");
                        elemento.appendChild(nombre);
                        elemento.appendChild(cantidad);
                        elemento.appendChild(precio);
                        elemento.appendChild(precioFinal);
                        elemento.appendChild(eliminar);
                        tabla.appendChild(elemento);
                    }
                });
            }
        }else{
            alert('no hay productos')
        }
    
   
</script>
