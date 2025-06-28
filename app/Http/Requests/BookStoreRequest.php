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


    protected function failedValidation(Validator $validator)
    {
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
            "authorId" => "required|integer|exists:authors,id",
            "isbn" => "required|string|min:2|max:255",
            "publicationYear" => "required|digits:4",
            "generation" => "nullable|string|min:2|max:150",
            "availableCopies" => "required|integer|min:1",
        ];
    }
}
