<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaginateResource extends JsonResource
{
    /**
     * The resource instance.
     */
    public mixed $data;

    public int $currentPage;

    public int $from;

    public int $lastPage;

    public ?string $nextPageUrl;

    public string $path;

    public int $perPage;

    public ?string $prevPageUrl;

    public int $to;

    public int $total;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->data,
            'currentPage' => $this->resource->currentPage(),
            // 'firstPageUrl' => $this->resource->firstPageUrl(),
            'from' => $this->resource->firstItem(),
            'lastPage' => $this->resource->lastPage(),
            // 'lastPageUrl' => $this->resource->lastPageUrl(),
            // 'links' => $this->resource->links(),
            'nextPageUrl' => $this->resource->nextPageUrl(),
            'path' => $this->resource->path(),
            'perPage' => $this->resource->perPage(),
            'prevPageUrl' => $this->resource->previousPageUrl(),
            'to' => $this->resource->lastItem(),
            'total' => $this->resource->total(),
        ];
    }
}
