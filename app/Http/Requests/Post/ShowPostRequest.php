<?php

declare(strict_types=1);

namespace App\Http\Requests\Post;

use App\Http\Requests\CustomFormRequest;
use OpenApi\Attributes as OA;

#[OA\Schema(
)]
class ShowPostRequest extends CustomFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

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
