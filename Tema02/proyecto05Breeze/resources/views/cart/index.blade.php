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
            @if(empty($cart))
                <div class="alert alert-success text-center py-4" role="alert">
                    <h4 class="alert-heading">Tu carrito está vacío</h4>
                    <p class="mb-0">¡Echa un vistazo a nuestros menús para añadir algo rico!</p>
                    <hr>
                    <a href="{{ url('/') }}" class="btn btn-success">Ver nuestras Ofertas</a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Oferta (Fecha)</th>
                                <th>Imagen</th>
                                <th>Producto</th>
                                <th>Precio</th>
                                <th class="text-center">Cantidad</th>
                                <th class="text-end">Total Línea</th>
                                <th class="text-center">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $totalAcumulado = 0; @endphp

                            @foreach($cart as $offerId => $items)
                                @php
                                    $offer = $offersById[$offerId] ?? null;
                                @endphp

                                @foreach($items as $productId => $qty)
                                    @php
                                        // Buscamos la relación exacta
                                        $po = \App\Models\ProductOffer::where('offer_id', $offerId)
                                            ->where('product_id', $productId)
                                            ->first();

                                        $prod = $po ? $po->product : null;
                                        $lineaTotal = $prod ? ($prod->price * $qty) : 0;
                                        $totalAcumulado += $lineaTotal;
                                    @endphp

                                    @if($prod)
                                        <tr>
                                            <td class="fw-bold">
                                                {{ $offer ? $offer->date_delivery->format('d/m/Y') : 'N/A' }}
                                            </td>
                                            <td>
                                                <img src="{{ asset($prod->image) }}" width="60" class="rounded shadow-sm">
                                            </td>
                                            <td>
                                                <div class="fw-bold">{{ $prod->name }}</div>
                                                <small class="text-muted">{{ Str::limit($prod->description, 40) }}</small>
                                            </td>
                                            <td>{{ number_format($prod->price, 2) }} €</td>

                                            <td class="text-center" style="min-width: 130px;">
                                                <div class="d-flex justify-content-center align-items-center">
                                                    {{-- BOTÓN DECREMENTAR --}}
                                                    <form action="{{ route('cart.decrease', $po->id) }}" method="POST" class="m-0">
                                                        @csrf
                                                        @method('PUT')
                                                        <button class="btn btn-sm btn-outline-success px-2 py-0" type="submit" {{ $qty <= 1 ? 'disabled' : '' }}>-</button>
                                                    </form>

                                                    <span class="mx-3 fw-bold">{{ $qty }}</span>

                                                    {{-- BOTÓN INCREMENTAR --}}
                                                    <form action="{{ route('cart.increase', $po->id) }}" method="POST" class="m-0">
                                                        @csrf
                                                        @method('PUT')
                                                        <button class="btn btn-sm btn-outline-success px-2 py-0" type="submit">+</button>
                                                    </form>
                                                </div>
                                            </td>

                                            <td class="text-end fw-bold text-success">
                                                {{ number_format($lineaTotal, 2) }} €
                                            </td>

                                            <td class="text-center">
                                                <form action="{{ route('cart.remove', $po->id) }}" method="POST" class="m-0">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-outline-danger">Eliminar</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <td colspan="5" class="text-end fw-bold text-uppercase">Total Pedido:</td>
                                <td class="text-end fw-bold text-success fs-5">{{ number_format($totalAcumulado, 2) }} €</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <form action="{{ route('cart.clear') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-warning text-white fw-bold">Vaciar Carrito</button>
                    </form>

                    <div>
                        <a href="{{ url('/') }}" class="btn btn-primary fw-bold me-2">Seguir comprando</a>
                        <form action="{{ route('cart.order') }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-success fw-bold px-4">Confirmar pedido</button>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
