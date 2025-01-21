<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CustomResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }

    /**
     * リソースのペジネーション情報のカスタマイズ.
     *
     * @param array{current_page: int, data: list<mixed>, first_page_url: string, from: int, last_page: int, last_page_url: string, links: list<array{url: null|string, label: string, active: bool}>, next_page_url: null|string, path: string, per_page: int, prev_page_url: null|string, to: int, total: int} $paginated
     * @param array{links: array{first: string, last: string, prev: null|string, next: null|string}, meta: array{current_page: int, from: int, last_page: int, links: list<array{url: null|string, label: string, active: bool}>, path: string, per_page: int, to: int, total: int}}                             $default
     *
     * @return array{links: array{first: string, last: string, prev: null|string, next: null|string}, meta: array{currentPage: int, from: int, lastPage: int, links: list<array{url: null|string, label: string, active: bool}>, path: string, perPage: int, to: int, total: int}}
     */
    public function paginationInformation(Request $request, array $paginated, array $default): array
    {
        return camelizeArrayRecursive($default);
    }
}
