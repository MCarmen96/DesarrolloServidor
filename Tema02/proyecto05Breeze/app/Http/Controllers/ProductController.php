<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //class ProductController extends Controller

    public function home()
    {
        $menus = Product::where("product_type", "menu")->get();
        $dishes = Product::where("product_type", "dish")->get();
        return view("home", compact("menus", "dishes"));
    }

}
