<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <h1>lista nombres</h1>
    <?php
        for ($i=0; $i <count($names) ; $i++) { 
            echo"<li>{$names[$i]}</li>";
        }
    ?>
    <form action="/newUser" method="post">
        <label for="">
            <input type="text" name="name">
        </label>
        <button type="submit">enviar</button>
    </form>
</body>
</html>