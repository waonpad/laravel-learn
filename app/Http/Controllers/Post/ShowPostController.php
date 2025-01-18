<?php

declare(strict_types=1);

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\ShowPostRequest;
use App\Http\Resources\PostResource;
use App\UseCases\Post\ShowPostAction;
use OpenApi\Attributes as OA;

class ShowPostController extends Controller
{
    /**
     * Display the specified resource.
     */
    #[OA\Get(
        path: '/posts/{id}',
        tags: ['Post'],
        parameters: [
            new OA\PathParameter(
                name: 'id',
                schema: new OA\Schema(
                    type: 'string',
                ),
                required: true,
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: '',
                content: new OA\JsonContent(ref: PostResource::class),
            ),
            new OA\Response(
                response: 400,
                description: '',
                content: new OA\JsonContent(ref: '#/components/schemas/ShowPostRequestPathValidationError'),
            ),
            new OA\Response(
                response: 500,
                ref: '#/components/responses/500',
            ),
        ],
    )]
    public function __invoke(ShowPostRequest $request, string $id, ShowPostAction $action): PostResource
    {
        $post = $action($id);

        return new PostResource($post);
    }
}
