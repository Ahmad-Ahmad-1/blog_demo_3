<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'caption' => $this->caption,
            'user_id' => $this->user_id,
            'Create Date' => $this->created_at,
            'Last Update' => $this->updated_at,
            'imgUrl' => $this->getFirstMediaUrl('imgs'),
        ];
    }
}
