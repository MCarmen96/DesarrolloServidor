@extends('layout')

@section('content')
<h1>Departamentos</h1>

<a href="{{ route('departs.create') }}">➕ Nuevo departamento</a>

<table border="1">
    <thead>
        <tr>
            <th>Depart_no</th>
            <th>Nombre</th>
            <th>Localización</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($departs as $d)
        <tr>
            <td>{{ $d->depart_no }}</td>
            <td>{{ $d->dnombre }}</td>
            <td>{{ $d->loc }}</td>
            <td>
                <a href="{{ route('departs.edit', $d->depart_no) }}">Editar</a>

                <form action="{{ route('departs.destroy', $d->depart_no) }}"
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

@endsection
