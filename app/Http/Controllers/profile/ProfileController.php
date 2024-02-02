<?php

namespace App\Http\Controllers\profile;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::where('user_id', auth()->user()->id)->with('postimages')->get();
        return view('profile.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('profile.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $post = Post::create([
            'text' => $request->text,
            'user_id' => auth()->user()->id,
        ]);

        if ($request->file('image')) {
            $image = $request->file('image');
            foreach ($image as $img) {
                $imagename = date(now()) . $img->getClientOriginalName();
                $img->move(public_path() . "/image/post", $imagename);
                $post->postimages()->create([
                    'image' => $imagename,
                    'post_id' => $post->id,
                ]);
            }

        }

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
        $post = Post::findorfail($id);
        return view('profile.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::findorfail($id);

        $post->update([
            'text' => $request->text,
        ]);
        if ($request->hasFile('image')) {
            foreach ($post->postimages as $img) {
                $path = public_path("image/post/{$img->image}");
                if (file_exists($path)) {
                    unlink($path);
                }
                $img->delete();
            }
            foreach ($request->file('image') as $image) {
                $imageName = now()->timestamp . '_' . $image->getClientOriginalName();
                $image->move(public_path('image/post'), $imageName);
                $post->postimages()->create([
                    'image' => $imageName,
                    'post_id' => $post->id,
                ]);

            }

            return redirect()->back();
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findorfail($id);
        $post->postimages()->delete();
        $post->delete();

        return redirect()->back();
    }
}
