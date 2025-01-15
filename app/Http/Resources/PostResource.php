<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;

class PostResource extends CustomJsonResource
{
    public int $id;

    public string $content;

    public int $userId;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'content' => $this->resource->content,
            'userId' => $this->resource->user_id,
        ];
    }
}
