<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;

class FoodController extends Controller
{
    public function index() {
        $products = Product::whereHas('category', function ($query) {
            $query->where('id_category', '=', '1');
        })->get();
        return view('food.dashboard', compact('products', 'category'));
    }
    public function add() {
        $category = Category::all();
        return view('food.store', compact('category'));
    }
    public function store(Request $request) {
        $this->validate($request, [
            'product_name' => 'required',
            'id_category' => 'required',
        ]);

        if($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalName();
            $filename = time().'.'.$extension;
            $file->move('storage/uploads/',$filename);
            $image = $filename;
        } else {
            $image = NULL;
        }

        Product::create([
            'product_name' => $request->get('product_name'),
            'id_category' => $request->get('id_category'),
            'image' => $image
        ]);
        
        
        return redirect('/food');
    }
    public function delete($id_product) {
        $products = Product::find($id_product)->delete();
        
        return redirect('/food');
    }
    public function edit($id_product) {
        $products = Product::whereHas('category', function($query) use($id_product){
            $query->where('id', $id_product);
        })->get();
        return view('food.edit', compact('products'));
    }
    public function update(Request $request, $id) {
        if($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalName();
            $filename = time().'.'.$extension;
            $file->move('storage/uploads/',$filename);
            $image = $filename;

            Product::find($id)->update([
                'image' => $image
            ]);

        }

        Product::find($id)->update([
            'product_name' => $request->get('product_name'),
            'id_category' => $request->get('id_category'),
        ]);

        return redirect('/food');
    }
}
