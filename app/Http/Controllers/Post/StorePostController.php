<?php

declare(strict_types=1);

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Resources\PostResource;
use App\UseCases\Post\StorePostAction;
use OpenApi\Attributes as OA;

class StorePostController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    #[OA\Post(
        path: '/posts',
        tags: ['Post'],
        security: [['bearerAuth' => true]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: StorePostRequest::class),
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: '',
                content: new OA\JsonContent(ref: PostResource::class),
            ),
            new OA\Response(
                response: 401,
                ref: '#/components/responses/401',
            ),
            new OA\Response(
                response: 403,
                ref: '#/components/responses/403',
            ),
            new OA\Response(
                response: 422,
                description: '',
                content: new OA\JsonContent(ref: '#/components/schemas/StorePostRequestBodyValidationError'),
            ),
            new OA\Response(
                response: 500,
                ref: '#/components/responses/500',
            ),
        ],
    )]
    public function __invoke(StorePostRequest $request, StorePostAction $action): PostResource
    {
        $input = $request->makeInput();

        $stored = $action($input);

        return new PostResource($stored);
    }
}
