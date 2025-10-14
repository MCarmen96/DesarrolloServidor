<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="/viewUpdateUser" method="post">
        <label for="">Introduce un nombre a modificar</label>
        <?php 
            echo "<input type='text' name='nameUser' value='$user'>";
            echo "<input type='hidden' name='id' value=\"{$id}\" >";
        ?>
        <button type="submit">Guardar cambios</button>
        
    </form>
</body>
</html>