<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
class DashboardController extends Controller
{
    public function index() {
        
        $products = Product::with('category')->get();
        return view('dashboard', compact('products'));
    }

    public function search(Request $req) {
        $products = Product::whereHas('category', function($query) use($req) {
            $query->where('product_name', 'like', "%{$req->key}%");
        })->get();
        return view('dashboard', ['products'=>$products]);
    }

    public function add() {
        $category = Category::all();
        return view('product.store', compact('category'));
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
        
        
        return redirect('/dashboard');
    }

    public function delete($id_product) {
        $products = Product::where('id_product',$id_product)->delete();
        
        return redirect('/dashboard');
    } 

    public function edit($id_product) {
        $products = Product::where('id_product', $id_product);
        return view('product.edit', compact('products','category'));
    }
}


