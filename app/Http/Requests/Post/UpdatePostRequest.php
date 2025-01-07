<?php

declare(strict_types=1);

namespace App\Http\Requests\Post;

use App\Http\DTO\Post\UpdatePostDto;
use App\Http\Requests\CustomFormRequest;
use App\Models\Post;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Gate;

class UpdatePostRequest extends CustomFormRequest
{
    protected $content;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $post = Post::findOrFail($this->route('id'));

        Gate::forUser(auth('sanctum')->user())->authorize('update', [Post::class, $post]);

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, array<mixed>|string|ValidationRule>
     */
    public function rules(): array
    {
        return [
            'content' => ['required', 'string', 'max:255'],
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

    public function makeInput(): UpdatePostDto
    {
        $validated = $this->validated();

        return new UpdatePostDto([
            'content' => $validated['content'],
        ]);
    }
}
