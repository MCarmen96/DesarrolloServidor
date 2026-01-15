@extends('layouts.layout')
@section('content')
    <div class="container mt-5">
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
            dd($menus);
            @foreach($menus as $menu)
                <div class="tab-pane fade show active" id="menus" role="tabpanel" aria-labelledby="menus-tab">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card border-light shadow-sm">
                                <img src="{{'$menu->imagen'}}" class="card-img-top" alt="Menú">
                                <div class="card-body">
                                    <h5 class="card-title text-success fw-bold">{{$menu->name}}</h5>
                                    <p class="card-text text-muted small">{{$menu->desciption}}</p>
                                    <ul class="list-unstyled">
                                        <li><strong>Precio:</strong> {{$menu->price}}</li>
                                        <li><strong>Fecha:</strong> {{$menu->date}}</li>
                                    </ul>
                                    <a href="{{route('login')}}" class="text-danger text-decoration-none small">Inicia sesión para comprar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            @foreach($dishes as $dish)
            <div class="tab-pane fade" id="platos" role="tabpanel" aria-labelledby="platos-tab">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card border-light shadow-sm">
                            <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Plato">
                            <div class="card-body">
                                <h5 class="card-title text-success fw-bold">Pastel de Patata</h5>
                                <p class="card-text text-muted small">Ración individual artesana.</p>
                                <ul class="list-unstyled">
                                    <li><strong>Precio:</strong> 3.25 €</li>
                                </ul>
                                <a href="#" class="text-danger text-decoration-none small">Inicia sesión para comprar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
