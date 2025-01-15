<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;

class UserResource extends CustomJsonResource
{
    public int $id;

    public string $name;

    public string $email;

    public string $emailVerifiedAt;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'email' => $this->resource->email,
            'emailVerifiedAt' => $this->resource->email_verified_at,
        ];
    }
}
