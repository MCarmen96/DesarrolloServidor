<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return response()->json(Product::all(),200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nombre'=>'required|string|max:255',
            'descripcion'=>'nullable|string|max:255',
            'precio'=>'required|numeric'

        ]);

        $product=Product::create($request->all());
        return response()->json($product,201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $product=Product::findOrFail($id);
        return response()->json($product,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $product=Product::findOrFail($id);
        $request->validate([
            'nombre'=>'required|string|max:255',
            'descripcion'=>'nullable|string|max:255',
            'precio'=>'required|numeric',
            'foto'=>'nullable|string'
        ]);

        $product->update($request->all());
        return response()->json($product,200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Product::destroy($id);
        return response()->json(null,204);
    }
}
