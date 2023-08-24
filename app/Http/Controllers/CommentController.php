<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;


class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required',
            'comment' => 'required'
        ]);
        $request['author_id'] = auth()->user()->id;

        $comment = Comment::create($request->all());

        return new CommentResource($comment->loadMissing('comentator:id,username'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required'
        ]);

        $comment = Comment::findOrFail($id);
        $comment->update($request->all());

        return new CommentResource($comment->loadMissing('comentator:id,username'));
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return response()->json(['message' => 'Comment deleted successfully']);
    }
}
