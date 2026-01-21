<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //class ProductController extends Controller

    public function home()
    {

        //$menus = Product::where("product_type", "menu")->get();
        $dishes = Product::all();
        return view("home", compact ("dishes") );
    }

}
