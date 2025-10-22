<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>FORMULARIO PARA AÑADIR DEPARTAMENTO</h1>
    <form action="" method="post">
        <label for="">Nombre
            <input type="text">
        </label>
        <label for="">Localidad
            <input type="text" value="<?php echo htmlspecialchars($loc); ?>">
        </label>
        <label for="">Numero depart
            <input type="text">
        </label>
    </form>
</body>
</html>