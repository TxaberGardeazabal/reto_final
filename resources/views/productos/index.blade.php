<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Productos</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container-fluid">
        <!--foreach($productos as $producto)-->
        <div class="row">
            <div><img src="{{ asset('img/magdalenas.png') }}" alt=""></div>
            <div class="col-12 col-md-3 text-center"><h2>Magdalenas </h2><p>2,33 €</p></div>
            
        </div>

        <!--endforeach-->
    </div>
</body>
</html>