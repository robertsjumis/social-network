<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadImage extends FormRequest
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
            'image' => 'image|required|dimensions:min_width=50,min_height=50,max_width:2048,max_height:2048'
        ];
    }

    public function messages()
    {
        return [
            'image.required' => 'An image file is required',
            "image.image" => "An image file is required",
            'image.dimensions'  => 'Unappropriate dimensions',
        ];
    }
}
