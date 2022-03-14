window.onload=function(){
    var carrito=[];
    carrito=sessionStorage.getItem('carrito').split(" ");
    if(carrito!=null){
        var tabla=document.getElementById("tablaCarrito");
        let precioFinalTotal=0;
        document.getElementById("comprar").removeAttribute("disabled");
        //En caso de que se vacie el carrito
        for(let i=0;i<carrito.length;i++){
           peticion(i,carrito);
        }
    }else{
        console.log("No hay productos en el carrito");
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
