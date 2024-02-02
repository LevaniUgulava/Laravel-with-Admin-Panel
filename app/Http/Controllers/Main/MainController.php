<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Newproduct;
use App\Models\Product;

class MainController extends Controller
{
    public function index()
    {
        $products = Product::orderbydesc('id')->get();
        return view('main', compact('products'));
    }

    public function newproduct()
    {
        $newproducts = Newproduct::orderbydesc('id')->get();
        return view('newproduct', compact('newproducts'));
    }

    public function index1()
    {

        return view('layouts.admin');
    }

    public function register()
    {
        return view('auth.register');
    }
    public function login()
    {
        return view('auth.login');
    }

    public function delete($id)
    {
        $product = Product::findorfail($id);
        $this->authorize('delete', $product);

        $product->images()->delete();
        $product->delete();

        return redirect()->back();
    }

}
