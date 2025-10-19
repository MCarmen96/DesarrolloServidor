<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>LISTADO EMPLEADOS</h1>

        <?php 
            foreach($empleados as $id =>$emple){

                $depart=$emple["depart"];

                $nombreDepart=$departamentos[$depart];

                echo "<li>";
                echo "Nombre: {$emple["nombre"]}, Apellido:{$emple["apellido"]}, departamento: {$nombreDepart}";
                echo "<a href='/eliminar?id={$id}'> Eliminar</a>";
                echo "</li>";
            }
            
        ?>

        

        
</body>
</html>