document.getElementById('logout').addEventListener('click',eliminarSesion);
    function eliminarSesion(){
        storage.removeItem('carrito');
      
    }
