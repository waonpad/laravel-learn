<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use App\Http\DTO\Auth\LoginDto;
use App\Http\Requests\CustomFormRequest;
use Illuminate\Contracts\Validation\ValidationRule;

class LoginRequest extends CustomFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
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
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    public function makeInput(): LoginDto
    {
        $validated = $this->validated();

        return new LoginDto([
            'email' => $validated['email'],
            'password' => $validated['password'],
        ]);
    }
}
