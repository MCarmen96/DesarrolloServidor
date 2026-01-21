<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Muestra el listado de todos los productos (página principal del admin).
     */
    public function index()
    {
        //
        $dishes = Product::all();
        return view("admin.index", compact ("dishes") );
    }

    /**
     * Muestra el formulario para crear un nuevo producto.
     */
    public function create()
    {
        //
    }

    /**
     * Guarda el nuevo producto en la base de datos (aquí va la validación).
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Muestra los detalles de un producto específico (por ejemplo, para ver fichas).
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Muestra el formulario para editar un producto ya existente.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Actualiza los datos del producto en la base de datos.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Elimina permanentemente un producto de la base de datos.
     */
    public function destroy(string $id)
    {
        //
    }
}
