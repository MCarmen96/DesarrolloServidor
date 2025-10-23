<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>=====EDITAR PIZZA=====</h1>
    <form action="/saveEdit" method="post">

         <label for="">Nombre Pizza
            <input type="text" value="<?php echo htmlspecialchars($nombre);?>" name="newName">
        </label>

        <label for="">Ingredientes
            <input type="text" value="<?php echo htmlspecialchars($ingred);?>" name="newIngre">
        </label>

        <label for="">Alergenos
            <input type="text" value="<?php echo htmlspecialchars($alerg);?>" name="newAlerg">
        </label>

        <label for="">ID
            <input type="number" readonly value="<?php echo htmlspecialchars($id);?>" name="id">
        </label>

        <label for="">Precio
            <input type="number" value="<?php echo htmlspecialchars($precio);?>" name="newPrecio">
        </label>

        <button type="submit">Guardar Pizza</button>
    </form>

        <a href="/">Volver a Inicio</a>
</body>
</html>