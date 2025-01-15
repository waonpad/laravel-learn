<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Post\DestroyPostRequest;
use App\Http\Requests\Post\IndexPostRequest;
use App\Http\Requests\Post\ShowPostRequest;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\UseCases\Post\DestroyPostAction;
use App\UseCases\Post\IndexPostAction;
use App\UseCases\Post\ShowPostAction;
use App\UseCases\Post\StorePostAction;
use App\UseCases\Post\UpdatePostAction;
use Illuminate\Http\Response;
use OpenApi\Attributes as OA;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexPostRequest $request, IndexPostAction $action): PostCollection
    {
        return new PostCollection($action());
    }

    /**
     * Store a newly created resource in storage.
     */
    #[OA\Post(
        path: '/posts',
        tags: ['Post'],
        security: [['bearerAuth' => ['apiKey']]],
    )]
    #[OA\RequestBody(
        description: '',
        required: true,
        content: new OA\JsonContent(ref: '#/components/schemas/StorePostRequest')
    )]
    #[OA\Response(
        response: 201,
        description: '',
        content: new OA\JsonContent(ref: '#/components/schemas/PostResource')
    )]
    public function store(StorePostRequest $request, StorePostAction $action): PostResource
    {
        $input = $request->makeInput();

        $stored = $action($input);

        // @status 201
        return new PostResource($stored);
    }

    /**
     * Display the specified resource.
     */
    public function show(ShowPostRequest $request, string $id, ShowPostAction $action): PostResource
    {
        $post = $action($id);

        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, string $id, UpdatePostAction $action): PostResource
    {
        $input = $request->makeInput();

        $stored = $action($id, $input);

        return new PostResource($stored);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DestroyPostRequest $request, string $id, DestroyPostAction $action): Response
    {
        $action($id);

        return response()->noContent();
    }
}
