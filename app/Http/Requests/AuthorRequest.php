<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthorRequest extends FormRequest
{
    // Allow all users for simplicity, or add your auth logic here
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        // If you want different rules for POST (create) and PUT/PATCH (update)
        $authorId = $this->route('id'); // get ID from route param for update

        return [
            'name' => 'required|string',
            'dob' => 'required|date',
            'gender' => 'required|string',
            'email' => 'required|email|unique:authors,email' . ($authorId ? ",$authorId" : ''),
            'nationality' => 'required|string',
        ];
    }
}
