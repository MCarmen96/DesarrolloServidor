@extends('layouts.layout')

@section('content')
<div class="container mt-5">
    @if(session('success'))
    <div class="alert alert-success mt-3">
        {{ session('success') }}
    </div>
    @endif
    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h3 class="text-success mb-0">Mi Carrito</h3>
        </div>

        <div class="card-body">
            @if(count($cart) > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Imagen</th>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                            <th class="text-center">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $totalAcumulado = 0; @endphp
                        @foreach($cart as $id => $details)
                        @php
                        $subtotal = $details['price'] * $details['quantity'];
                        $totalAcumulado += $subtotal;
                        @endphp
                        <tr>
                            <td>
                                <img src="{{ asset($details['image']) }}" width="80" class="rounded shadow-sm">
                            </td>
                            <td class="fw-bold">{{ $details['name'] }}</td>
                            <td>{{ number_format($details['price'], 2) }} €</td>

                            <td class="text-center" style="width: 150px;">
                                <div class="input-group input-group-sm justify-content-center">

                                    <form action="{{ route('cart.decrease', $id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button class="btn btn-outline-success px-2 py-0" type="submit"
                                            {{ $details['quantity'] <= 1 ? 'disabled' : '' }}>
                                            -
                                        </button>
                                    </form>

                                    <span class="px-3 fw-bold align-self-center">{{ $details['quantity'] }}</span>

                                    <form action="{{ route('cart.increase', $id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button class="btn btn-outline-success px-2 py-0" type="submit">
                                            +
                                        </button>
                                    </form>

                                </div>
                            </td>
                            <td class="fw-bold text-success">{{ number_format($subtotal, 2) }} €</td>
                            <td class="text-center">
                                <form action="{{ route('cart.remove', $id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="fs-5">
                            <td colspan="4" class="text-end fw-bold text-uppercase pt-4">Total Pedido =</td>
                            <td colspan="2" class="fw-bold text-success pt-4">{{ number_format($totalAcumulado, 2) }} €</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="d-flex justify-content-between mt-4">
                {{-- VACIAR CARRITO --}}
                <form action="{{ route('cart.clear') }}" method="POST">
                    @csrf
                    @method('DELETE') {{-- Esto le dice a Laravel: "Aunque el form diga POST, trata esto como un DELETE" --}}
                    <button type="submit" class="btn btn-warning text-white fw-bold">
                        Vaciar Carrito
                    </button>
                </form>
                <div>
                    <a href="{{ url('/') }}" class="btn btn-primary fw-bold me-2">Seguir comprando</a>
                    <form action="{{ route('cart.order') }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-success fw-bold">Confirmar pedido</button>
                    </form>

                </div>
            </div>

            @else
            <div class="alert alert-success text-center py-4" role="alert">
                <h4 class="alert-heading">Tu carrito está vacío</h4>
                <p class="mb-0">¡Echa un vistazo a nuestros menús para añadir algo rico!</p>
                <hr>
                <a href="{{ url('/') }}" class="btn btn-success">Ver productos</a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
