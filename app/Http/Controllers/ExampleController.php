<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class ExampleController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index()
    {
        return new JsonResponse(['message' => 'Hello, World!']);
    }
}
