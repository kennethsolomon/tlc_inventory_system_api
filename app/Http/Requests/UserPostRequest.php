<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id' => 'sometimes|integer',
            'firstname' => 'required|string',
            'middlename' => 'nullable',
            'lastname' => 'required|string',
            'position' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|confirmed|string',
            'role' => 'required|string',
        ];
    }
}
