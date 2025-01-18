<?php

declare(strict_types=1);

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\UseCases\Post\UpdatePostAction;
use OpenApi\Attributes as OA;

class UpdatePostController extends Controller
{
    /**
     * Update the specified resource in storage.
     */
    #[OA\Patch(
        path: '/posts/{id}',
        tags: ['Post'],
        security: [['bearerAuth' => true]],
        parameters: [
            new OA\PathParameter(
                name: 'id',
                schema: new OA\Schema(
                    type: 'string',
                ),
                required: true,
            ),
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: UpdatePostRequest::class),
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: '',
                content: new OA\JsonContent(ref: PostResource::class),
            ),
            new OA\Response(
                response: 400,
                description: '',
                content: new OA\JsonContent(ref: '#/components/schemas/UpdatePostRequestPathValidationError'),
            ),
            new OA\Response(
                response: 401,
                ref: '#/components/responses/401'
            ),
            new OA\Response(
                response: 403,
                ref: '#/components/responses/403'
            ),
            new OA\Response(
                response: 422,
                description: '',
                content: new OA\JsonContent(ref: '#/components/schemas/UpdatePostRequestBodyValidationError'),
            ),
            new OA\Response(
                response: 500,
                ref: '#/components/responses/500'
            ),
        ],
    )]
    public function __invoke(UpdatePostRequest $request, string $id, UpdatePostAction $action): PostResource
    {
        $input = $request->makeInput();

        $stored = $action($id, $input);

        return new PostResource($stored);
    }
}
