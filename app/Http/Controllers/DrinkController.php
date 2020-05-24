<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;

class DrinkController extends Controller
{
    public function index() {
        $products = Product::whereHas('category', function ($query) {
            $query->where('id_category', '=', '2');
        })->get();
        return view('drink.dashboard', compact('products', 'category'));
    }
}
