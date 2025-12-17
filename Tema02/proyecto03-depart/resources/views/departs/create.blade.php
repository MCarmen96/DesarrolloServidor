@extends('layout')

@section('content')
<h1>Crear departamento</h1>

<form action="{{ route('departs.store') }}" method="POST">
    @csrf

    <label>Departamento Nº</label><br>
    <input type="number" name="depart_no" required><br><br>

    <label>Nombre</label><br>
    <input type="text" name="dnombre" required><br><br>

    <label>Localización</label><br>
    <input type="text" name="loc" required><br><br>

    <button>Guardar</button>
</form>
@endsection
