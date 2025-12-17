@extends('layout')

@section('content')
<h1>Empleados</h1>

<a href="{{ route('emples.create') }}">➕ Nuevo empleado</a>

<table border="1">
    <thead>
        <tr>
            <th>Emp_no</th>
            <th>Foto</th>
            <th>Apellido</th>
            <th>Oficio</th>
            <th>Director</th>
            <th>Departamento</th>
            <th>Salario</th>
            <th>Comisión</th>
            <th>Acciones</th>


        </tr>
    </thead>
    <tbody>
        @foreach ($emples as $e)
        <tr>
            <td>{{ $e->emple_no }}</td>
            <td>
                @if (!empty($e->foto))
                    <img src="{{ asset('storage/'.$e->foto) }}" width="150">
                @endif
            </td>
            <td>{{ $e->apellido }}</td>
            <td>{{ $e->oficio }}</td>
            <td>{{ $e->director->apellido ?? '- Sin director -' }}</td>
            <td>{{ $e->depart->dnombre ?? '- Sin departamento -' }}</td>
            <td>{{ $e->salario }}</td>
            <td>{{ $e->comision ?? '-' }}</td>
            <td>
                <a href="{{ route('emples.edit', $e->emple_no) }}">Editar</a>

                <form action="{{ route('emples.destroy', $e->emple_no) }}"
                    method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button>Borrar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@if (session('error'))
<p style="color:red">{{ session('error') }}</p>
@endif
@endsection
