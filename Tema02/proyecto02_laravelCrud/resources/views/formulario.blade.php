<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>CREAR </h1>
    <form action="/store" method="post">
    @csrf
        <label for="">Nombre
            <input type="text" name="name">
        </label>
        <label for=""> Email
            <input type="email" name="email">
        </label>
        <button>save</button>
    </form>
</body>
</html>
