<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

#[OA\Schema(
    required: ['id', 'content', 'userId'],
)]
class PostResource extends CustomJsonResource
{
    #[OA\Property(
        type: 'integer',
    )]
    protected int $id;

    #[OA\Property(
        type: 'string',
    )]
    protected string $content;

    #[OA\Property(
        type: 'integer',
    )]
    protected int $userId;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'content' => $this->resource->content,
            'userId' => $this->resource->user_id,
        ];
    }
}
