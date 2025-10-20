<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h1>Formulario añadir deaprtamento</h1>
    <form action="/addDepartForm" method="post">

        <label for="">
            Nombre departamento
            <input type="text" name="nameDepart">
        </label><br>
        <label for="">
            Numero departamento
            <input type="number" name="numberDepart">
        </label><br>
        <label for="">
            Localidad departamento
            <input type="text" name="locaDepart">
        </label><br>
        <button type="sumit">Enviar</button>
    </form>
</body>
</html>