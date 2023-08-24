<?php

namespace App\Http\Middleware;

use App\Models\Comment;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class commentator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $currentUser = auth()->user()->id;
        $comment = Comment::findOrFail($request->id);

        if ($currentUser != $comment->author_id) {
            return response()->json([
                'message' => 'You are not authorized to edit this comment'
            ], 403);
        }

        return $next($request);
    }
}
