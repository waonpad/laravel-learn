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
        ],
    )]
    public function __invoke(ShowPostRequest $request, string $id, ShowPostAction $action): PostResource
    {
        $post = $action($id);

        return new PostResource($post);
    }
}
