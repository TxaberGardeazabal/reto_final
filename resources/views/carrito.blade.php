@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 p-0">
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
            <tfoot>
                <tr>
                <td colspan="3">Precio Final</td>
                <td id="precioFinalTotal" colspan="2">0</td>
                </tr>
            </tfoot>
        </table>
  
        <hr class="w-75 mx-auto">
        <button type="button" id="comprar" class="btn" disabled style="width:75%;margin:0 12.5%;background-color: rgb(130, 224, 170) !important;padding:0.3% 0;font-size:140%">Comprar</button>
        <div class="row justify-content-center w-40 mx-auto col-3">
          <a href="{{route('index') }}" class="btn btn-outline-dark m-3 ms-5">Volver</a>
        </div>
        <!--Toast de compra Correcta-->
        <div id="mensaje" class="toast " style="position: absolute; top: 0; right: 0;">
            <div class="toast-header">
                Compra Exitosa
                <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
            </div>
            <div class="toast-body">
                Se ha realizado la compra correctamente.
            </div>
        </div>
    </div>
</div>

@endsection


<script>
    //<script src="{{ asset('js/carrito.js') }}" defer>  no funciona el apartado de subir a la base de datos, por eso lo dejamos en la misma pagina
    window.onload=function(){
        var carrito=[];
        carrito=sessionStorage.getItem('carrito').split(" ");
        if(carrito){
            var tabla=document.getElementById("tablaCarrito");
            let precioFinalTotal=0;
            document.getElementById("comprar").removeAttribute("disabled");
            //En caso de que se vacie el carrito
            for(let i=0;i<carrito.length;i++){
               peticion(i,carrito);
            }
        }else{
            alert("No hay productos en el carrito");
        }
        function peticion(i,carrito){
            $.ajax({
                url: '/carrito/producto/' + carrito[i],
                type: 'GET',
                cache: false,
                success: function (data) {
                    var elemento=document.createElement("tr");
                    var nombre=document.createElement("td");
                    var textNombre=document.createTextNode(data["nombre"]);
                    var cantidad=document.createElement("td");
                    var inputCantidad=document.createElement("input");
                    var textCantidad=document.createTextNode("4");
                    inputCantidad.setAttribute("type","number");
                    inputCantidad.setAttribute("value",1);
                    inputCantidad.setAttribute("min",1);
                    inputCantidad.setAttribute("name",`cantidad${data["id"]}`);
                    inputCantidad.classList.add("cantidad");
                    inputCantidad.id=`in${data["id"]}`;
                    var precio=document.createElement("td");
                    var textPrecio=document.createTextNode(`${data["precio"]} €`);
                    var precioFinal=document.createElement("td");
                    var textPrecioFinal=document.createTextNode(`${data["precio"]} €`);
                    var eliminar=document.createElement("button");
                    var textEliminar=document.createTextNode("Eliminar");
                    nombre.appendChild(textNombre);
                    cantidad.appendChild(inputCantidad);
                    precio.appendChild(textPrecio);
                    precio.id=`prec${data["id"]}`;
                    precioFinal.appendChild(textPrecioFinal);
                    precioFinal.id=`pf${data["id"]}`;
                    eliminar.appendChild(textEliminar);
                    eliminar.id=`e${data["id"]}`;
                    eliminar.setAttribute("class","btn btn-outline-danger");
                    elemento.appendChild(nombre);
                    elemento.appendChild(cantidad);
                    elemento.appendChild(precio);
                    elemento.appendChild(precioFinal);
                    elemento.appendChild(eliminar);
                    elemento.id=data["id"];
                    elemento.classList.add("productos");
                    tabla.appendChild(elemento);
                    
                    $(inputCantidad).on("change",()=>{
                        let id=inputCantidad.id.slice(2,inputCantidad.length);
                        let numProductos=parseFloat(document.getElementById(inputCantidad.id).value);
                        let precio=parseFloat(document.getElementById(`prec${id}`).innerHTML);
                        let newPrecioFinal=Math.round((numProductos*precio) * 100) / 100;//Precio redondeado
                        document.getElementById(`pf${id}`).innerHTML=`${newPrecioFinal} €`;
                        calculaPrecioFinalTotal(sessionStorage.getItem("carrito"));
                    });
                    document.getElementById("precioFinalTotal").innerHTML=`${Math.round((parseFloat(document.getElementById("precioFinalTotal").innerHTML)+parseFloat(data["precio"]))*100)/100} €`;
                
                    $(eliminar).on("click",()=>{
                        let newCarrito=[];
                        document.getElementById(data["id"]).remove();//Eliminar elemento de la tabla
                        newCarrito=sessionStorage.getItem("carrito").split(" ");
                        newCarrito.find((element)=>{
                            if(element==data["id"]){
                                newCarrito.splice(newCarrito.indexOf(element),1);//Eliminar elemento de session
                            }
                        });
                        console.log(sessionStorage.getItem("carrito").length);
                        if(sessionStorage.getItem("carrito").length==1){
                            sessionStorage.removeItem("carrito");
                            document.getElementById("comprar").setAttribute("disabled","true");
                            calculaPrecioFinalTotal(null);
                        }else{
                            let stringCarrito="";
                            for(let i=0;i<newCarrito.length;i++){
                                stringCarrito+=newCarrito[i] + " ";
                            }
                            sessionStorage.setItem("carrito",stringCarrito.trim());
                            calculaPrecioFinalTotal(sessionStorage.getItem("carrito"));//Recalcular el precio final
                        }
                        
                    }); 
                } 
            });
        }
        function calculaPrecioFinalTotal(carrito){
            var precioFinal=0;
            if(carrito!=null){
                let arrCarrito=[];
                arrCarrito=carrito.split(" ");
                if(carrito.length!=0){
                    for(let i=0;i<=arrCarrito.length-1;i++){
                        precioFinal+=parseFloat(document.getElementById(`pf${arrCarrito[i]}`).innerHTML);
                    }
                }
            }
            document.getElementById("precioFinalTotal").innerHTML=`${Math.round((precioFinal + Number.EPSILON)* 100) / 100} €`;
        }
        function muestraMensajeToast(){
            var mensaje=document.getElementById("mensaje");
            mensaje.classList.add("show");
        }
        $("#comprar").on("click",function(){
            let productos=document.getElementsByClassName("productos");//Obtengo el id de los elentos en la tabla
            let productosDB=new Array();
            Array.from(productos).forEach(element => {
                let cantidad=document.getElementById(`in${element.id}`).value;
                let id=element.id;
                let producto={
                    "id_producto":id,
                    "cantidad":cantidad
                }
                productosDB.push(producto);//Id de los elementos
            });
            console.log(productosDB);//AJAX para subir datos a la DB
            $.ajax({
                url:'/carrito/compra',
                type:'POST',
                cache:false,
                data:{ "_token": "{{ csrf_token() }}","productos":productosDB},
                success:function(data){
                    if(data=="Insercion correcta"){
                        let elementosTabla=[];
                        elementosTabla=sessionStorage.getItem("carrito").split(" ");
                        for(let i=0;i<elementosTabla.length;i++){
                            document.getElementById(elementosTabla[i]).remove();
                        }
                        calculaPrecioFinalTotal(null);
                        sessionStorage.removeItem("carrito");
                        //Mostrar mensaje de compra realizada con exito
                        document.getElementById("comprar").setAttribute("disabled","true");
                        muestraMensajeToast();
                    }
                },error:function(mensaje){
                    console.log(mensaje)
                }
            });
        });
    };
</script>