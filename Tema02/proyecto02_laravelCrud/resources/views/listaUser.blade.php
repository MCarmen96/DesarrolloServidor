<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>LISTA USERS</h1>

    <ul>
        @foreach ($contenido as $usuario)
            <li><p>Nombre: {{ $usuario['nombre']}} - Email:{{ $usuario['email']}} - Id:{{ $usuario['id']}}  <a href="{{route('usuarios.show',$usuario['id'])}}">ver</a></p></li>
        @endforeach

    </ul>
</body>
</html>
