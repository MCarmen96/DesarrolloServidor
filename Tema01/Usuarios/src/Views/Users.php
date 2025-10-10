<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>LISTA DE USUARIOS</h1>
    <ul>
            <?=$fileUsers?>
    </ul>
    <hr>
    <form action="/viewForm" method="post">
        <label for="">Introduce un nombre
            <input type="text" name="nameUser">
        </label>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>