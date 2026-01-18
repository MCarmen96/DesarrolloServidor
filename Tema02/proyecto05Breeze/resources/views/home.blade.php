@extends('layouts.layout')
@section('content')
    <div class="container mt-5">
        @if(session('mensaje'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('mensaje') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <ul class="nav nav-tabs justify-content-center border-bottom-0 mb-4" id="productTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active bg-success text-white px-4 me-2" id="menus-tab"
                    data-bs-toggle="tab" data-bs-target="#menus" type="button"
                    role="tab" aria-controls="menus" aria-selected="true">
                    Menús completos
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link text-success border-success px-4" id="platos-tab"
                    data-bs-toggle="tab" data-bs-target="#platos" type="button"
                    role="tab" aria-controls="platos" aria-selected="false">
                    Platos individuales
                </button>
            </li>
        </ul>

        <div class="tab-content" id="productTabsContent">


                <div class="tab-pane fade show active" id="menus" role="tabpanel" aria-labelledby="menus-tab">
                    <div class="row">
                    @foreach($menus as $menu)
                        <div class="col-md-4">
                            <div class="card border-light shadow-sm">
                                <img src="{{asset($menu->image)}}" class="card-img-top" alt="Menú">
                                <div class="card-body">
                                    <h5 class="card-title text-success fw-bold">{{$menu->name}}</h5>
                                    <p class="card-text text-muted small">{{$menu->description}}</p>
                                    <ul class="list-unstyled">
                                        <li><strong>Precio:</strong> {{$menu->price}}</li>
                                        <li><strong>Fecha:</strong> {{$menu->date}}</li>
                                    </ul>

                                    @auth
                                        <form action="{{route('cart.add', $menu->id)}}" method="POST" class="mt-2">
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



            <div class="tab-pane fade" id="platos" role="tabpanel" aria-labelledby="platos-tab">
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
                                    <li><strong>Fecha:</strong> {{$dish->date}}</li>
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
        </div>
    </div>
@endsection
