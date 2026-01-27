<?php

namespace App\Http\Controllers\Auth\admin;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\Product;
use App\Models\ProductOffer;
use Illuminate\Http\Request;

class AdminControllerOffers extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $offers= Offer::with('productsOffer.product')->get();
        dd($offers);
        return view("admin.offers.index", compact ("offers") );

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
