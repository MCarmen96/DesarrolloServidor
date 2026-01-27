@extends('layouts.layout')
@section('content')
    <div class="container mt-5">
        @if(session('mensaje'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('mensaje') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <h1 class="h1 text-md-center md-4">Nuestra Carta</h1>
            <div class="row">
            @foreach($dishes as $dish)
                <div class="col-md-4">
                    <div class="card border-light shadow-sm">
                        <img src="{{asset($dish->image)}}" class="card-img-top" alt="Plato">
                        <div class="card-body">
                            <h5 class="card-title text-success fw-bold">{{$dish->name}}</h5>
                            <p class="card-text text-muted small">{{$dish->description}}</p>
                            <ul class="list-unstyled">
                                <li><strong>Precio:</strong> {{$dish->price}} €</li>

                            </ul>
                            @auth
                                <form action="{{route('cart.add', $dish->id)}}" method="POST" class="mt-2">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        Añadir al carrito
                                    </button>
                                </form>
                            @else
                                <a href="{{route('login')}}" class="text-danger text-decoration-none small">Inicia sesión para comprar</a>
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
    </div>
@endsection
