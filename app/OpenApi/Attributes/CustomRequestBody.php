<?php

declare(strict_types=1);

namespace App\OpenApi\Attributes;

use OpenApi\Attributes as OAA;

class CustomRequestBody extends OAA\RequestBody
{
    public function __construct(
        null|object|string $ref = null,
        ?string $request = null,
        ?string $description = null,
        ?bool $required = null,
        null|array|OAA\Attachable|OAA\JsonContent|OAA\MediaType|OAA\XmlContent $content = null,
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
