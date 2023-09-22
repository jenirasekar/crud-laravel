<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index() {
        $posts = Post::latest()->paginate(5);

        return view('posts.index', compact('posts'));
    }

    public function create() {
        return view('posts.create');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg, png, jpg, gif, svg|max:2048',
            'title' => 'required|min:5',
            'content' => 'required|min:10'
        ]);

        // upload image
        $image = $request->file('image');
        $image->storeAs('public/posts/', $image->hashName());

        // create post
        Post::create([
            'image' => $image->hashName(),
            'title' => $request->title,
            'content' =>$request->content
        ]);

        return redirect()->route('posts.index')->with(['success' => 'Data berhasil disimpan!']);
    }

    public function edit(Post $post) {
        
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post) {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg, png, jpg, gif, svg|max:2048',
            'title' => 'required|min:5',
            'content' => 'required|min:10'
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->storeAs('public/posts', $image->hashName());

            Storage::delete('public/posts' . $post->image);
        } else {
            $post->update([
                'title' => $request->title,
                'content' => $request->content
            ]);
        }

        return redirect()->route('posts.index')->with(['success' => 'Data berhasil diubah!']);
    }

    public function destroy(Post $post) {
        Storage::delete('public/posts' . $post->image);
        $post->delete();

        return redirect()->route('posts.index')->with(['success' => 'Data berhasil dihapus!']);
    }

    public function show(string $id) {
        $post = Post::findOrFail($id);

        return view('posts.show', compact('post'));
    }
}
