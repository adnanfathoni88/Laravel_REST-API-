<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostDetailResource extends JsonResource
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
            'content' => $this->content,
            'author_id' => $this->author_id,
            'created_at' => (string) $this->created_at->format('Y-m-d'),
            'writer' => $this->whenLoaded('writer'),
            'comment' => $this->whenLoaded('comments', function () {
                return collect($this->comments)->each(
                    function ($comment) {
                        $comment->comentator;
                        return $comment;
                    }
                );
            }),
        ];
    }
}
