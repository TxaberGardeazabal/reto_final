let elementosOcultos=false;//Indica si hay elementos ocultos
function eventosBusqueda(){
    if(document.getElementById("buscador").value==0){
        console.log("Elementos");
        let lproductos=Array.from(document.getElementsByClassName("nombre"));
        for(let i=0;i<lproductos.length;i++){
            document.getElementById(`p${i+1}`).style.display="list-item";
        }
        if(document.getElementById("mensaje")){
            document.getElementById("mensaje").remove();
        }
    }else{
        buscar();
    }
}

function buscar(){
    if(document.getElementById("mensaje")){
        document.getElementById("mensaje").remove();
    }
    let valorBuscado="";
    valorBuscado=document.getElementById("buscador").value;
    valorBuscado = valorBuscado.trim();//Elimina los espacios
    valorBuscado = valorBuscado.toLowerCase();
    let encontrado = false;
    let lproductos=Array.from(document.getElementsByClassName("nombre"));
    for(let i=0;i<lproductos.length;i++){
        lproductos[i]=lproductos[i].innerHTML;
    }
    if(valorBuscado){
        var elementosEncontrados = [];
        lproductos.filter(function(elemento,i){
            let texto="";
            texto=elemento;
            texto=texto.toLowerCase();
            if(texto.includes(valorBuscado)){
                elementosEncontrados.push(i+1);
            }
        });
        if(elementosEncontrados.length>0){
            encontrado = true;
            ocultar(elementosEncontrados,lproductos);
        }else{
            let lproductos=Array.from(document.getElementsByClassName("nombre"));
            for(let i=0;i<lproductos.length;i++){
                document.getElementById(`p${i+1}`).style.display="none";
            }
            notFoundItem(document.getElementById("buscador").value);
        }
    }
}

function ocultar(posicionesEncontradas,lproductos){//Oculta todo menos los elementos con id coincidentes
    let posicionesEncontradas2=[];
    posicionesEncontradas2=posicionesEncontradas;
    for(let i=0;i<lproductos.length;i++){ 
        // local document.getElementById(`p${i+1}`).style.display="none";
        if(i==0){
            num=i+1;
        }else{
            num=i+11;
        }
        document.getElementById(`p${num}`).style.display="none";
        elementosOcultos=true;
        posicionesEncontradas2.find(element=>{
            if(element==(i+1)){
                //id coincide, no ocultar
                elementosOcultos=false;
                document.getElementById(`p${i+1}`).style.display="list-item";
            }
        });
        
    }
}

function notFoundItem(busqueda){//Crea item de mensaje de error de la busqueda
    if(document.getElementById("mensaje")){
        document.getElementById("mensaje").remove();
    }
    var litem = document.createElement("li");
    var texto = document.createTextNode(`No se ha encontrado '${busqueda}'`);
    litem.appendChild(texto);
    litem.id = "mensaje";
    litem.setAttribute("style","color:red");
    document.getElementById("lProductos").appendChild(litem);
}

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
            muestraMensajeToast();
            
        }
    }else{//Si el carrito esta vacio
        productos=id;
        sessionStorage.setItem('carrito',productos);
        muestraMensajeToast();
    }
  
}
function muestraMensajeToast(){
    var mensaje=document.getElementById("mensaje");
    mensaje.classList.add("show");
}