<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class RequestUpdateUser extends FormRequest
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
     * @return array
     */
    public function rules($user)
    {
        $values = [
            'name' => 'required|min:3|max:30',
            'lastname' => 'required|min:3|max:30',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user)],
            'role' => 'required|in:client,seller,admin',
            'profile_photo_path' => 'nullable|image',
        ];

        if(!$user) {
            $validation_password = [
                'password' => 'required|confirmed',
            ];
            
            $values = array_merge($values, $validation_password);
        }

        return $values;
    }

    public function messages()
    {
        return [
            'name.required' => 'El campo de nombre es obligatorio',
        ];
    }
}
