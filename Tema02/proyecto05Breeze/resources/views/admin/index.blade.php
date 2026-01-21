@extends('layouts.layout')
@section('content')
    <div class="container mt-5">
        {{-- ESTA ES LA LÍNEA QUE TE FALTA --}}
        <div class="row">
            <h1 class="h1 text-center">Productos</h1>
            @foreach($dishes as $dish)
                <div class="col-md-4 mb-4"> {{-- Añadí mb-4 para que tengan margen abajo --}}
                    <div class="card border-light shadow-sm">
                        <img src="{{ asset($dish->image) }}" class="card-img-top" alt="Plato">
                        <div class="card-body">
                            <h5 class="card-title text-success fw-bold">{{ $dish->name }}</h5>
                            <p class="card-text text-muted small">{{ $dish->description }}</p>
                            <ul class="list-unstyled">
                                <li><strong>Precio:</strong> {{ $dish->price }} €</li>

                            </ul>

                            <form action="{{route('admin.products.edit', $dish->id)}}" method="POST" class="mt-2">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-primary">
                                    Edit
                                </button>
                            </form>
                            <form action="{{route('admin.products.destroy', $dish->id)}}" method="POST" class="mt-2">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger">
                                    Delete
                                </button>
                            </form>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection



