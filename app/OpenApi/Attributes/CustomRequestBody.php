<?php

declare(strict_types=1);

namespace App\OpenApi\Attributes;

use OpenApi\Attributes as OA;

class CustomRequestBody extends OA\RequestBody
{
    public function __construct(
        null|object|string $ref = null,
        ?string $request = null,
        ?string $description = null,
        ?bool $required = null,
        null|array|OA\Attachable|OA\JsonContent|OA\MediaType|OA\XmlContent $content = null,
        // annotation
        ?array $x = null,
        ?array $attachables = null
    ) {
        parent::__construct(
            ref: $ref,
            request: $request,
            description: $description,
            required: $required,
            content: $content,
            x: $x,
            attachables: $attachables,
        );
    }
}
