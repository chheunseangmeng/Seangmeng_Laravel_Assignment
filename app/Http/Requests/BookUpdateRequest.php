<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;


class BookUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            "success" => false,
            "message" => $validator->errors()
        ]));
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "title" => "string|min:2|max:255",
            "authorId" => "string|min:1|max:255",
            "isbn" => "string|min:2|max:255",
            "publicationYear" => "string|min:4|max:4",
            "gener" => "string|min:2|max:100",
            "availableCopies" => "string|min:1|max:10"
        ];
    }
}
