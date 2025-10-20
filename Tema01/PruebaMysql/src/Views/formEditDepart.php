<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <h1>Update Departamento</h1>
    <form action="/updateDepart" method="post">
        <label for="">Nombre
            <input type="text" value="<?php echo htmlspecialchars($nombre); ?>" name="newName">
        </label>

        <label for="">Localidad
            <input type="text" value="<?php echo htmlspecialchars($localidad); ?>" name="newLoc">
        </label>

        <label for="">NºDepart
            <input type="text" value="<?php echo htmlspecialchars($id); ?>" name="newId">
        </label>
        
    <button type="submit">Guardar Cambios</button>
    </form>
</body>
</html>