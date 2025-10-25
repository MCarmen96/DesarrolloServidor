<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>FORMULARIO PARA EDITAR DEPARTAMENTO</h1>
    <form action="/saveEdit" method="post">
        <label for="">Nombre
            <input type="text" value="<?php echo htmlspecialchars($nombre); ?>" name="newname">
        </label>
        <label for="">Localidad
            <input type="text" value="<?php echo htmlspecialchars($loc); ?>" name="newloc">
        </label>
        <label for="">Numero depart
            <input type="text" readonly value="<?php echo htmlspecialchars($id); ?>" name="id">
        </label>
        <button type="submit">Guardar</button>
    </form>
    <a href="/">Volver a incio</a>
</body>
</html>