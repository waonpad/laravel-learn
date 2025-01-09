<?php

declare(strict_types=1);

namespace App\Http\Requests\Post;

use App\Http\Requests\CustomFormRequest;
use App\Models\Post;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Gate;

class DestroyPostRequest extends CustomFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $post = Post::findOrFail($this->route('id'));

        return Gate::allows('delete', [Post::class, $post]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, array<mixed>|string|ValidationRule>
     */
    public function rules(): array
    {
        return [
            'path' => ['required', 'array'],
            'path.id' => ['required', 'string', 'min:1'],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function validationData(): array
    {
        $data = $this->all();
        $data['path'] = [
            'id' => $this->route('id'),
        ];

        return $data;
    }
}
