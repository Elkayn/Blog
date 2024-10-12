<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StatisticResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'count_posts' => $this->count_posts,
            'count_comments' => $this->count_comments,
            'count_likes_posts' => $this->count_likes_posts,
            'count_likes_comments' => $this->count_likes_comments,
            'date' => $this->date,
        ];
    }
}
