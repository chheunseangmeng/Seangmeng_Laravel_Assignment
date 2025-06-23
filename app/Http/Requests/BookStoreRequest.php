<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;

class BookStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json([
            "success" => false,
            "message" => $validator->errors()
        ], 200));
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "title" => "required|string|min:2|max:255",
            "authorId" => "string|min:1|max:255",
            "isbn" => "required|string|min:2|max:255",
            "publicationYear" => "required|string|min:4|max:4",
            "gener" => "string|min:2|max:150",
            "availableCopies" => "required|string|min:1|max:10"
        ];
    }
}
