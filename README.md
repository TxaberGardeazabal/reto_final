# Reto Final (Hosteleria)

Esta aplicacion esta hecha con la funcion de gestionar pedidos de productos en escuela de hosteleria, hecho con entorno laravel.

## Usuarios
- **Administrador**
    - Usuario: admin@admin
    - Contraseña: 12345Abcde
- **Cliente**
    - Usuario: cliente@cliente
    - Contraseña: 12345678


| **Administrador**                                     | **Cliente**                                                    |
|-------------------------------------------------------|----------------------------------------------------------------|
| - Puede eliminar productos                            | - Puede añadir productos al carrito de la compra               |
| - Puede crear productos                               | - Puede ver la descripción del producto                        |
| - Ver todos los pedidos                               | - Puede ver los pedidos que tiene junto con los productos      |
| - Actualizar el estado de los pedidos                 | - Puede ver los productos que tiene en el carrito de la compra |
| - Puede ver la descripción del producto y modificarlo | - Puede hacer el pedido (apartado del carrito)                 |


## Manual de usuario
- Nada mas entrar en la aplicación aparece la pagina de los productos donde tu puedes añadir al carrito lo que desees comprar.
- Al clicar en el nombre Hosteleria te lleva a la pagina principal.
- La pagina de productos tiene una barra buscadora para poder buscar o filtrar los productos deseados.
- Para poder ver la descripcion del producto solo tiene que clicar en la imagen o en el texto de cada producto.
 ### Cliente
- Para poder comprar los productos añadidos en el carrito tienes que iniciar sesión, la compra se realiza en la ventana carrito.
- Una vez inicias sesion o te registras aparecerá en la barra de arriba un boton con el nombre con el que te has registrado.
- Para poder ver sus pedidos y el carrito de compra, clicas en el boton anteriormente mencionado y aparece un desplegable 
  con todas las opciones.
- Para cerrar sesion se hace desde el desplegable anteriormente mencionado.
 ### Admin
- El administrador tiene una cuenta para poder administrar todo, las opciones estan en el mismo sitio que en el cliente.
- En vez de tener un boton de añadir a la cesta tiene un botón de eliminar que elimina el producto.
- El apartado de creacion del producto aparece en el desplegable.
- En la descripcion del producto tiene una opcion de modificar el producto, el nombre, precio, imagen y descripcion.
- En el apartado de los pedidos puede ver todos y tiene la opcion de cambiar el estado en el que esta dicho pedido.
- En el cambio de ese pedido cuando se cambie a 'preparado' se envia un email al cliente que ha hecho el pedido, 
  diciendo que ya esta listo. 
- Para cerrar sesion se hace desde el desplegable anteriormente mencionado.

## Setup

[https://github.com/jvadillo/guia-laravel-8-paso-a-paso](https://github.com/jvadillo/guia-laravel-8-paso-a-paso)

## Heroku

[herokuapp](https://hosteleriasuper.herokuapp.com/)
