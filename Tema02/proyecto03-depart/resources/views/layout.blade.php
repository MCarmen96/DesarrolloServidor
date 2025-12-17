<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
</head>
<body>

<nav>
    <a href="{{ route('departs.index') }}">Departamentos</a> |
    <a href="{{ route('emples.index') }}">Empleados</a>
</nav>

<hr>

@yield('content')

</body>
</html>
