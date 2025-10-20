<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>LISTADO DEPARTAMENTOS</h1>
    <ul>

    
    <?php
    
        for ($i=0; $i < count($departamentos); $i++) { 
            echo '<li>';
            echo "Numero: {$departamentos[$i]['depart_no']}, Nombre:{$departamentos[$i]['dnombre']}, localidad:{$departamentos [$i]['loc']}";
            echo "<a href='/delDepart?id={$departamentos[$i]['depart_no']}'>Eliminar</a>";
            echo '</li>';
        }
        echo "<br>";
        echo "<a href='/'>Volver al inicio</a>";
    ?>
    
    </ul>
</body>
</html>