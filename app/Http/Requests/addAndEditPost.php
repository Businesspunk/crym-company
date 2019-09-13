<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class addAndEditPost extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'category_id' => 'required|exists:categories,id',
            'title' => 'required',
            'description' => 'required',
            'cost' => 'required|integer',
            'main_photo' => 'required',
        ];

        return $rules;
    }
}
