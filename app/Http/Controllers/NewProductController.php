<?php

namespace App\Http\Controllers;

use App\Models\Newproduct;
use Illuminate\Http\Request;

class NewProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('newproducts.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('newproducts.add');

    }
    public function commentindex($id)
    {
        $newproduct = Newproduct::findorfail($id);
        $newproducts = Newproduct::WhereHas('comments', function ($query) use ($id) {
            $query->where('commentable_id', $id);
        })->get();
        return view('newproductcomment', compact('newproduct', 'newproducts'));
    }

    public function comment(Request $request, $id)
    {
        $newproduct = Newproduct::findorfail($id);

        $newproduct->comments()->create([
            'comment' => $request->comment,
        ]);
        return redirect()->back();
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'nullable|text',
            'price' => 'required|integer',
        ]);

        $newproduct = $request->only(['name', 'desc', 'price']);

        Newproduct::create($newproduct);

        return redirect()->back();
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
