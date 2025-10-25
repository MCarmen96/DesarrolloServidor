<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Segunda practica Mysql con ORM</h1>
    <h2>Listado de los departramentos</h2>
    <?php
        for ($i=0; $i <count($lista); $i++) { 
            echo "<li>";
            echo "Nombre: {$lista[$i]['dnombre']},Localidad: {$lista[$i]['loc']}, Nº: {$lista[$i]['depart_no']}";
            echo "<a href='/delete?id={$lista[$i]['depart_no']}'> Eliminar </a> <a href='/edit?id={$lista[$i]['depart_no']}'>Editar</a>";
            echo "</li>";
        }
    ?>
    <hr>
    <h2>Añadir nuevos departamento</h2>
    <form action="/create" method="post">
        <label for="">Nombre
            <input type="text" name="name">
        </label>
        <label for="">Localidad
            <input type="text" name="loc">
        </label>
        <label for="">Numeor Departamento
            <input type="text" name="id">
        </label>
        <button type="submit">Guardar</button>
    </form>
    
</body>
</html>