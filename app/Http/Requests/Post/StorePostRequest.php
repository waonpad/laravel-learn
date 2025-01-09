<?php

declare(strict_types=1);

namespace App\Http\Requests\Post;

use App\Http\DTO\Post\StorePostDto;
use App\Http\Requests\CustomFormRequest;
use App\Models\Post;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class StorePostRequest extends CustomFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::allows('create', [Post::class]);
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
        ];
    }

    public function makeInput(): StorePostDto
    {
        $validated = $this->validated();

        return new StorePostDto([
            'content' => $validated['content'],
            'user_id' => Auth::user()->id,
        ]);
    }
}
