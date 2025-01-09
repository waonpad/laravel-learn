<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class CustomFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, array<mixed>|string|ValidationRule>
     */
    public function rules(): array
    {
        return [];
    }

    protected function failedValidation(Validator $validator): void
    {
        // path内にエラーがある場合は、400でエラーを返す
        if ($validator->errors()->has('path.*')) {
            $res = new JsonResponse(
                [
                    'message' => 'Invalid path parameters',
                    'errors' => $validator->errors()->get('path.*'),
                ],
                400
            );

            throw new HttpResponseException($res);
        }

        // query内にエラーがある場合は、400でエラーを返す
        if ($validator->errors()->has('query.*')) {
            $res = new JsonResponse(
                [
                    'message' => 'Invalid query parameters',
                    'errors' => $validator->errors()->get('query.*'),
                ],
                400
            );

            throw new HttpResponseException($res);
        }

        // そうでない場合(フォーム)は、422でエラーを返す
        $res = new JsonResponse(
            [
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors(),
            ],
            422
        );

        throw new HttpResponseException($res);
    }
}
