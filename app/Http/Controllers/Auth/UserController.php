<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;
use OpenApi\SchemaDefinitions\Responses\InternalServerError;
use OpenApi\SchemaDefinitions\Responses\Unauthorized;

class UserController extends Controller
{
    #[OA\Get(
        path: '/user',
        tags: ['Auth'],
        security: [['bearerAuth' => ['apiKey']]],
        responses: [
            new OA\Response(
                response: 200,
                description: '',
                content: new OA\JsonContent(ref: UserResource::class)
            ),
            new OA\Response(response: 401, ref: Unauthorized::class),
            new OA\Response(response: 500, ref: InternalServerError::class),
        ]
    )]
    public function __invoke(Request $request): UserResource
    {
        return new UserResource($request->user());
    }
}
