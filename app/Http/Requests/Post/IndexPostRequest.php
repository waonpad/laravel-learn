<?php

declare(strict_types=1);

namespace App\Http\Requests\Post;

use App\Http\Requests\CustomFormRequest;

class IndexPostRequest extends CustomFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'query' => ['required', 'array'],
            'query.page' => ['required', 'integer', 'min:1'],
        ];
    }

    public function validationData(): array
    {
        $data = $this->all();
        $data['query'] = [
            'page' => $this->query('page') ?? 1,
        ];

        return $data;
    }
}
