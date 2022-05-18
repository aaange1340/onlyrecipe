<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'profile' => ['required','max:100'],
            'name' => ['required','max:20'],
            'image' => [
                'file',
                'image',
                'mimes:jpeg,jpg,png',
                ],
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'ユーザー名',
            'profile' => 'プロフィール',
        ];
    }
}
