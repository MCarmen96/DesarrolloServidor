<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Order;
use App\Models\Order_Item;
use Illuminate\Http\Request;


class CartController extends Controller
{
    //
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }


    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);
        $idProduct = (int)$id;
        // si el producto ya esta en el carrito, incrementamos su cantidad
        if (isset($cart[$idProduct])) {
            $cart[$id]['quantity']++;
        } else {
            // si no esta el producto en el carrito lo agregamos

            $cart[$idProduct] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->image
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('succes', 'Producto añadido al carrito');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);
        $idProduct = (int)$id;
        //si el producto existe en el carrito lo eliminamos
        if (isset($cart[$idProduct])) {
            unset($cart[$idProduct]); //elimina una variable o un elemento específico de un array
            // actualizamos el carrito
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
        $cart = session()->get('cart', []);
        $idProduct = (int)$id;
        if (isset($cart[$idProduct])) {
            $cart[$idProduct]['quantity']++;
            session()->put('cart', $cart);
        }
        return redirect()->route('cart.index')->with('success', 'Cantidad incrementada');
    }

    public function decrease($id)
    {
        $cart = session()->get('cart', []);
        $idProduct = (int)$id;
        if (isset($cart[$idProduct]) && $cart[$idProduct]['quantity'] > 1) {
            $cart[$idProduct]['quantity']--;
            session()->put('cart', $cart);
        }
        return redirect()->route('cart.index')->with('success', 'Cantidad decrementada');
    }

    public function order()
    {
        //aqui iria la logica para procesar el pedido (guardar en base de datos, enviar email, etc)
        $cart = session()->get('cart', []); //guardamos el carrito en una variable

        //si el carrito esta vacio, redirigimos con un mensaje de error
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'El carrito está vacío');
        }


        $order = Order::create([
            'user_id' => Auth::id(),
            'status' => 'pendiente',
            'total' => 0
        ]);

        $precioTotal = 0;

        foreach ($cart as $key => $product) {
            $precioTotal += $product["quantity"] * $product["price"];
            Order_Item::create([
                "order_id" => $order->id,
                "product_id" => $key,
                "quantity" => $product["quantity"],
                "unit_price" => $product["price"],
            ]);
        }

        $order->total = $precioTotal;
        $order->save();

        session()->forget('cart');

        return redirect()->route('cart.index')->with('success', 'Pedido realizado con éxito!!');
    }
}
