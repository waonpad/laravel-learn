<?php

declare(strict_types=1);

namespace App\Http\Requests\Post;

use App\Http\Requests\CustomFormRequest;
use App\OpenApi\Attributes\ValidationErrorSchema;

class ShowPostRequest extends CustomFormRequest
{
    #[ValidationErrorSchema(
        schema: 'ShowPostRequestPathValidationError',
        validationErrorProperties: ['path.id'],
    )]
    public null $__attributesAnchor;

    public function rules(): array
    {
        return [
            'path' => ['required', 'array'],
            'path.id' => ['required', 'string', 'min:1'],
        ];
    }

    public function validationData(): array
    {
        $data = $this->all();
        $data['path'] = [
            'id' => $this->route('id'),
        ];

        return $data;
    }
}
