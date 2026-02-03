<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\ProductOffer;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //class ProductController extends Controller

    public function home()
    {

        //$menus = Product::where("product_type", "menu")->get();

        $dishes = ProductOffer::with('productsOffer.product')->get();

        return view("home", compact ("dishes") );
    }

}
