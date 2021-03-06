<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecipeRequest extends FormRequest
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
            'name' => ['required','max:100'],
            'image' => [
              'file',
              'image',
              'mimes:jpeg,jpg,png',
              'dimensions:min_width=50,min_height=50,max_width=1000,max_height=1000',
            ],
            'category_id' => ['required','exists:categories,id'],
            'process' => ['required','max:300'],
        ];
    }
    
    public function attributes()
    {
        return[
            'name' => 'レシピ名',  
            
        ];
    }
}
