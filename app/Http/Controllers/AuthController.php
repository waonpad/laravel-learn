<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
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

    public function user(Request $request): UserResource
    {
        return new UserResource($request->user());
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return new JsonResponse(['message' => 'ログアウトしました。'], 200);
    }
}
