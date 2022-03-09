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
