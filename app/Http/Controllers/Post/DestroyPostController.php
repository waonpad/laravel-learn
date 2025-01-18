<?php

declare(strict_types=1);

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\DestroyPostRequest;
use App\UseCases\Post\DestroyPostAction;
use Illuminate\Http\Response;
use OpenApi\Attributes as OA;

class DestroyPostController extends Controller
{
    /**
     * Remove the specified resource from storage.
     */
    #[OA\Delete(
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
        responses: [
            new OA\Response(
                response: 204,
                description: '',
            ),
            new OA\Response(
                response: 400,
                description: '',
                content: new OA\JsonContent(ref: '#/components/schemas/DestroyPostRequestPathValidationError'),
            ),
        ],
    )]
    public function __invoke(DestroyPostRequest $request, string $id, DestroyPostAction $action): Response
    {
        $action($id);

        return response()->noContent();
    }
}
