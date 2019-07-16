<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdate extends FormRequest
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
    public function rules()
    {
        return [
            'name' => [
                'required',
                Rule::unique('users')->ignore($this->route('user')),
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($this->route('user')),
            ],
            'password' => [
                'min:6',
                Rule::unique('users')->ignore($this->route('user'))
                ],
            'avatar' => 'nullable|image',
        ];
    }
}
