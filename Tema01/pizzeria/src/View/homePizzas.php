<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="/js/color-modes.js"></script>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
</head>
<body>
    <h1>----MENU PIZZAS------</h1>
    
    <?php
    
        for ($i=0; $i <count($lista) ; $i++) { 
            echo "<li> ID: {$lista[$i]["id"]}, Nombre: {$lista[$i]["nombre"]}, Ingredientes: {$lista[$i]["ingredientes"]}, Alergenos: {$lista[$i]["alergenos"]}, Precio: {$lista[$i]["precio"]}</li>";
            echo "<a href='/delPizza?id={$lista[$i]['id']}'> Eliminar</a> ";
            echo "<a href='/edit?id={$lista[$i]['id']}'> Modificar </a>";
        }
    ?>

    <h1>======AÑADIR NUEVAS PIZZAS=======</h1>
    <form action="/createPizza" method="post">

        <label for="">ID
            <input type="number" required name="id">
        </label>
        <label for="">Nombre Pizza
            <input type="text" required name="name">
        </label>

        <label for="">Ingredientes
            <input type="text" required name="ingredientes">
        </label>

        <label for="">Alergenos
            <input type="text" required  name="alergenos"> 
        </label>

        <label for="">Precio
            <input type="number" required name="precio">
        </label>

        <button type="submit" class="rounded ">Guardar Pizza</button>
    </form>
    <script src="/js/bootstrap.bundle.min.js" class="astro-vvvwv3sm" ></script>
</body>
</html>