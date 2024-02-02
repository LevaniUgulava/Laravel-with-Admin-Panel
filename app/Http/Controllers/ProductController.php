<?php

namespace App\Http\Controllers;

use App\Events\AddProduct;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $products = Product::orderbydesc('id')->get();
        return view('products.index', compact('products'));
    }

    public function isredactor($id)
    {

        $user = User::findorfail($id);
        $user->update([
            'role' => null,
        ]);
        return redirect()->back();
    }

    public function isactive($id)
    {

    }

    public function isnotactive($id)
    {

    }

    public function isnotredactor($id)
    {

        $user = User::findorfail($id);
        $user->update([
            'role' => 'redactor',
        ]);
        return redirect()->back();
    }

    public function isoperator($id)
    {

        $user = User::findorfail($id);
        $user->update([
            'role' => null,
        ]);
        return redirect()->back();
    }

    public function isnotoperator($id)
    {

        $user = User::findorfail($id);
        $user->update([
            'role' => 'operator',
        ]);
        return redirect()->back();
    }

    public function admin()
    {

        $users = User::where('id', '!=', auth()->user()->id)->get();
        return view('user', compact('users'));
    }

    public function commentindex($id)
    {
        $product = Product::findorfail($id);
        $products = Product::wherehas('comments', function ($query) use ($id) {
            $query->where('commentable_id', $id);
        })->get();
        return view('productcomment', compact('product', 'products'));
    }

    public function comment(Request $request, $id)
    {
        $product = Product::findorfail($id);
        $product->comments()->create([
            'comment' => $request->comment,
        ]);
        return redirect()->back();
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.add');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'desc' => ['required', 'string'],
            'price' => ['required', 'integer'],

        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = date(now()) . $image->getClientOriginalName();
            $path = public_path() . "/image/product";

            $image->move($path, $imagename);
        }

        $product = Product::create([
            'name' => $request->name,
            'desc' => $request->desc,
            'price' => $request->price,
        ]);
        $product->images()->create([
            'image' => $imagename,
            'product_id' => $product->id,
        ]);

        $product->save();

        AddProduct::dispatch($product);

        // dispatch(new CustomerJob());

        return redirect()->back()->with('message', 'Product is Added!');
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
        $product = Product::findorfail($id);
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findorfail($id);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'desc' => ['required', 'string'],
            'price' => ['required', 'integer'],

        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = date(now()) . $image->getClientOriginalName();
            $path = public_path() . "/image/product";

            $image->move($path, $imagename);
        }

        $product->update([
            'name' => $request->name,
            'desc' => $request->desc,
            'price' => $request->price,
        ]);
        if ($request->image) {
            $product->images()->update([
                'image' => $imagename,
            ]);
        }

        $product->save();
        $user = User::findorfail(Auth::user()->id);

        $user->products()->attach($product->id);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findorfail($id);
        $product->delete();

        return redirect()->back();
    }

    public function log()
    {
        $products = Product::with('users')->get();
        return view('log.index', compact('products'));
    }
}
