<?php

namespace App\Http\Resources;

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
            'content' => $this->content,
            'image' => $this->img_path,
            'category_id' => $this->category_id,
            'profile_id' => $this->profile_id,
            'view' => $this->view,
            'is_commentable' => $this->is_commentable,
            'publish_at' => $this->publish_at,
            'img_url' => $this->img_url,
            'is_liked' => $this->is_liked,
            'tags' => TagResource::collection($this->tags)->resolve()
        ];
    }
}
