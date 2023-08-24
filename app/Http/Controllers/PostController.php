<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostDetailResource;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $post = Post::all();
        return PostResource::collection($post->loadMissing('writer:id,username', 'comments:id,post_id,author_id,comment'));
    }
    public function show($id)
    {
        $post = Post::with('writer:id,username', 'comments')->findOrFail($id);
        return new PostDetailResource($post);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        $request['author_id'] = Auth::user()->id;


        $post = Post::create($request->all());
        return new PostResource($post->loadMissing('writer:id,username'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        $post = Post::findOrFail($id);
        $post->update($request->all());

        return new PostResource($post->loadMissing('writer:id,username'));
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return new PostResource($post->loadMissing('writer:id,username'));
    }
}
