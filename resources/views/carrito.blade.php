@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 p-0">
        <h2>Carrito de la compra</h2>
        <table class="table w-75 mx-auto">
            <thead>
                <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Precio</th>
                </tr>
            </thead>
            <tbody id="tbody">
             
            </tbody>
        </table>
    </div>
</div>
@endsection

<script>
    var carrito=[];
    carrito=sessionStorage.getItem('carrito');
    console.log(carrito);
    if(carrito){
        if(carrito.length==1){

        }else{
            var tabla=document.getElementById("tbody");
            console.log(carrito[0]);
            for(let i=0;i<carrito.length;i++){
                var elemento=document.createElement("tr");
                var elemento2=document.createElement("td");
                var texto=document.createTextNode(carrito[i]);
                elemento2.appendChild(texto);
                elemento.appendChild(elemento2);
                tabla.appendChild(elemento);
    }
        }
    }else{
        alert("No hay productos en el carrito");
    }
    
</script>
