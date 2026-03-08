@extends('layouts.layout')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-success fw-bold">Mis Pedidos</h2>
        <a href="{{ url('/') }}" class="btn btn-outline-primary btn-sm">Volver a la tienda</a>
    </div>

    @if($orders->count() > 0)
        <div class="accordion shadow-sm" id="accordionOrders">
            @foreach($orders as $order)
                <div class="accordion-item border-0 mb-3 shadow-sm">
                    <h2 class="accordion-header" id="heading{{ $order->id }}">
                        <button class="accordion-button collapsed bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $order->id }}">
                            <div class="d-flex w-100 justify-content-between align-items-center me-3">
                                <span>
                                    <span class="badge bg-success me-2">#{{ $order->id }}</span>
                                    <span class="text-muted small">{{ $order->created_at->format('d/m/Y H:i') }}</span>
                                </span>
                                <span class="fw-bold text-success fs-5">{{ number_format($order->total, 2) }} €</span>
                            </div>
                        </button>
                    </h2>

                    <div id="collapse{{ $order->id }}" class="accordion-collapse collapse" data-bs-parent="#accordionOrders">
                        <div class="accordion-body">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Producto</th>
                                        <th>Entrega</th>
                                        <th class="text-center">Cant.</th>
                                        <th class="text-end">Precio</th>
                                        <th class="text-end">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->products as $item)
                                        @php
                                            // Intentamos cargar la relación definida en el paso 1
                                            $po = $item->productOffer;

                                            // Si no carga por relación, forzamos la búsqueda por el ID
                                            // que sabemos que está en la columna 'product_id'
                                            if (!$po) {
                                                $po = \App\Models\ProductOffer::find($item->product_id);
                                            }

                                            $plato = $po ? $po->product : null;
                                            $oferta = $po ? $po->offer : null;
                                        @endphp

                                        <tr>
                                            @if($plato)
                                                <td>
                                                    <div class="fw-bold">{{ $plato->name }}</div>
                                                </td>
                                                <td>
                                                    @if($oferta)
                                                        <span class="text-secondary">
                                                            {{ \Carbon\Carbon::parse($oferta->date_delivery)->format('d/m/Y') }}
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="text-center">{{ $item->quantity }}</td>
                                                <td class="text-end">{{ number_format($plato->price, 2) }} €</td>
                                                <td class="text-end fw-bold">
                                                    {{ number_format($item->quantity * $plato->price, 2) }} €
                                                </td>
                                            @else
                                                <td colspan="5" class="text-center text-muted py-3">
                                                    <small>ID Relación #{{ $item->product_id }} no encontrada en ProductOffers</small>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-5">
            <p class="text-muted">No tienes pedidos registrados todavía.</p>
        </div>
    @endif
</div>
@endsection
