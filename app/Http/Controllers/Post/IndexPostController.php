<?php

declare(strict_types=1);

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\IndexPostRequest;
use App\Http\Resources\PostCollection;
use App\UseCases\Post\IndexPostAction;
use OpenApi\Attributes as OA;

class IndexPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    #[OA\Get(
        path: '/posts',
        tags: ['Post'],
        parameters: [
            new OA\QueryParameter(
                name: 'page',
                schema: new OA\Schema(
                    type: 'integer',
                ),
                required: false,
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: '',
                content: new OA\JsonContent(ref: PostCollection::class),
            ),
            new OA\Response(
                response: 400,
                description: '',
                content: new OA\JsonContent(ref: '#/components/schemas/IndexPostRequestQueryValidationError'),
            ),
            new OA\Response(
                response: 500,
                ref: '#/components/responses/500',
            ),
        ],
    )]
    public function __invoke(IndexPostRequest $request, IndexPostAction $action): PostCollection
    {
        return new PostCollection($action());
    }
}
