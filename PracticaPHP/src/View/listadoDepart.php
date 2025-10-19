<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>LISTADO DEPARTAMENTOS</h1>

        <?php 
            for ($i=0; $i < count($departamentos) ; $i++) { 
                echo `<li>Nombre:{$departamentos[$i]}</li>`;
                   
            }
        ?>

        
</body>
</html>