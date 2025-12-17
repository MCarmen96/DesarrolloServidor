<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return "Nos muestra la lista de los productos";
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return "Esto nos lanza la creacion de un producto";
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        return "Este metodo lanzaria el producto para guardarlo en la BBDD";
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return "ESTE METODO NOS MUESTRA UN PRODUCTO EN CONCRETO POR SU ID " . $id;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        return "MUESTRA EL FORMULARIO PRA EDITAR UN PRODUCTO POR SU ID " . $id;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        return "LANZA EL FORMULARIO QUE AACTUALIZA EL PRODUCTO POR SU ID" .  $id;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        return "ELIMINA LE PRODUCTO POR SU ID" .  $id;
    }
}
