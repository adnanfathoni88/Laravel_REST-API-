<?php

namespace App\Http\Resources;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'created_at' => (string) $this->created_at->format('Y-m-d'),
            'writer' => $this->whenLoaded('writer'),
            'comment' => $this->whenLoaded('comments'),

            'comment count' => $this->when($request->routeIs('posts'), function () {
                return Post::count();
            }),

        ];
    }
}
