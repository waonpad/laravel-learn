<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class ExampleController
{
    /**
     * @return JsonResponse
     */
    public function index()
    {
        return new JsonResponse(['message' => 'Hello, World!']);
    }
}
