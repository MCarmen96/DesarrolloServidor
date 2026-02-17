<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Order;
use App\Models\ProductOffer;
use App\Models\Offer;
use App\Models\ProductOrder;
use Illuminate\Http\Request;


class CartController extends Controller
{
    //
    /*
            cart = [
                offer_id => [
                    productOffer_id => quantity
                ]
            ];

            cart = [
                10 => [ // offer_id = 10
                    101 => 2, // productOffer_id 101, cantidad 2
                    102 => 1
                ],
                12 => [ // offer_id = 12
                    150 => 1,
                    151 => 3
                ]
            ];


    */

    public function index()
    {
        $cart = session()->get('cart', []);

        $offersIds=array_keys($cart);//conseguimos un array de id de ofertas y productos-oferta, este sin duplicados
        //dd($offersIds);
        $productOffersIds=[];

        foreach($cart as $offId=>$items){
            // $items ahora es un array de [productOffer_id => cantidad]
            $productOffersIds=array_merge($productOffersIds,array_keys($items));
        }
        $productOffersIds=array_unique($productOffersIds);

        //dd($productOffersIds);
        /*
                The keyBy method keys the collection by the given key.
                If multiple items have the same key, only the last one will appear in the new collection:
        */
        //dd($cart);
        $offersById=Offer::whereIn('id',$offersIds)->get(['id','date_delivery','time_delivery'])->keyBy('id');

        $productOffersById=ProductOffer::with('product') ->whereIn ('id',$productOffersIds) ->get(['id','offer_id','product_id'])->keyBy('id');

        return view('cart.index',compact('cart','offersById','productOffersById'));
    }


    public function add(Request $request, $id)// cuidado el id que le paso es el de la oferta no el del producto
    {
            // 1. $id es el ID de la tabla PRODUCT_OFFER
        $productOffer = ProductOffer::findOrFail($id);

        $offerId = $productOffer->offer_id;      // Primera llave
        $productId = $productOffer->product_id;  // Segunda llave

        $cart = session()->get('cart', []);

        if (!isset($cart[$offerId])) {
            $cart[$offerId] = [];
        }

        // Usamos el ID del PRODUCTO base como clave interna
        if (isset($cart[$offerId][$productId])) {
            $cart[$offerId][$productId]++;
        } else {
            $cart[$offerId][$productId] = 1;
        }

        session()->put('cart', $cart);
        return redirect()->route('cart.index')->with('success', 'Añadido al carrito');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);

            session()->put('cart', $cart);
        }
        //redireccionar al carrito con mensaje de exito
        return redirect()->route('cart.index')->with('success', 'Producto eliminado del carrito');
    }

    public function clear()
    {
        session()->forget('cart'); //elimina una variable de la sesión
        return redirect()->route('cart.index')->with('success', 'Carrito vaciado');
    }

    public function increase($id)
    {
    // 1. Buscamos la relación para saber qué llaves buscar en el array
        $productOffer = ProductOffer::findOrFail($id);
        $offerId = $productOffer->offer_id;
        $productId = $productOffer->product_id;

        $cart = session()->get('cart', []);

        // 2. Accedemos a tu estructura exacta
        if (isset($cart[$offerId][$productId])) {
            $cart[$offerId][$productId]++;
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index');
    }

    public function decrease($id)
    {
            $productOffer = ProductOffer::findOrFail($id);
        $offerId = $productOffer->offer_id;
        $productId = $productOffer->product_id;

        $cart = session()->get('cart', []);

        if (isset($cart[$offerId][$productId])) {
            if ($cart[$offerId][$productId] > 1) {
                $cart[$offerId][$productId]--;
            } else {
                // Si llega a 0, eliminamos ese producto de esa oferta
                unset($cart[$offerId][$productId]);

                // Si la oferta se queda vacía, eliminamos la oferta
                if (empty($cart[$offerId])) {
                    unset($cart[$offerId]);
                }
            }
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index');
    }

    public function order()
    {
            $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'El carrito está vacío');
        }

        // 1. Creamos el pedido principal
        $order = Order::create([
            'user_id' => Auth::id(),
            'total' => 0
        ]);

        $precioTotal = 0;

        foreach ($cart as $offerId => $products) {
            foreach ($products as $productId => $quantity) {

                // 2. BUSCAMOS la relación en product_offers
                $po = ProductOffer::where('offer_id', $offerId)
                                ->where('product_id', $productId)
                                ->first();

                if ($po) {
                    $precioTotal += $quantity * $po->product->price;

                    // 3. AQUÍ ESTÁ EL CAMBIO CRÍTICO:
                    // Según tu error, el campo "product_id" de "product_orders"
                    // apunta a la tabla "product_offers" (suena raro pero es lo que dice el SQL).
                    // Si la columna se llama product_id pero apunta a product_offers,
                    // debemos pasarle el ID de $po.

                    ProductOrder::create([
                        "order_id"   => $order->id,
                        "product_id" => $po->id, // <--- Pasamos el ID de la relación, no del plato
                        "quantity"   => $quantity
                    ]);
                }
            }
        }

        $order->update(['total' => $precioTotal]);
        session()->forget('cart');

        return redirect()->route('cart.index')->with('success', 'Pedido realizado con éxito');
    }

    public function orders()
    {
        $orders = Order::where('user_id', Auth::id())
        ->with('products.productOffer.product')
        ->latest()
        ->get();

        return view('cart.orders', compact('orders'));
    }
}
