<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageCreateValidation extends FormRequest
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
            'title'=>'required|max:255|string|unique:pages',
            'main_image'=>'required|max:2048',
            'description'=>'nullable'
        ];
    }
}
