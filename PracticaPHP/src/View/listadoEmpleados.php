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
            for ($i=0; $i < count($empleados) ; $i++) { 
                echo `<li>Nombre:{$empleados[$i]}</li>`;
                echo `<li>Apellido:{$empleados[$i]}</li>`;
                
            }
            
        ?>

        
</body>
</html>