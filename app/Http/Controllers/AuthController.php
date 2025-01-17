<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use OpenApi\Attributes as OA;

class AuthController extends Controller
{
    #[OA\Post(
        path: '/login',
        tags: ['Auth'],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: LoginRequest::class)
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: '',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: 'token',
                            type: 'string',
                        ),
                    ]
                )
            ),
        ]
    )]
    public function login(LoginRequest $request): JsonResponse
    {
        $input = $request->makeInput();

        $credentials = [
            'email' => $input->email,
            'password' => $input->password,
        ];

        if (Auth::attempt($credentials)) {
            $user = $request->user();
            $token = $user->createToken('AccessToken')->plainTextToken;

            return new JsonResponse(['token' => $token], 200);
        }

        throw new AuthenticationException();
    }

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
        ]
    )]
    public function user(Request $request): UserResource
    {
        return new UserResource($request->user());
    }

    #[OA\Post(
        path: '/logout',
        tags: ['Auth'],
        security: [['bearerAuth' => ['apiKey']]],
        responses: [
            new OA\Response(
                response: 204,
                description: '',
            ),
        ]
    )]
    public function logout(Request $request): Response
    {
        $request->user()->currentAccessToken()->delete();

        return response()->noContent();
    }
}
