<?php

namespace App\Http\Resources\Post;

use App\Http\Resources\CommentResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostWithCommentResource extends JsonResource
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
                'image' => $this->img_path,
                'category_id' => $this->category_id,
                'view' => $this->view,
                'is_commentable' => $this->is_commentable,
                'publish_at' => $this->publish_at,
                'is_liked' => $this->is_liked,
                'comments' => CommentResource::collection($this->comments)->resolve()
            ];
    }
}
