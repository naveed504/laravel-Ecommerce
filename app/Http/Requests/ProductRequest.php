<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'product_name' => 'required',
            'product_code' => 'required',
            'product_color' => 'required',
            'product_price' => 'required',
            'image'=>'required'
        ];
    }
    public function messages()
    {
        return
        [

            'product_name.required'=> 'Product Name field is required',
            'product_code.required'=> 'Product Code field is required',
            'product_price.required'=> 'Product Price field is required',
            'image.required'=> 'Product Image is required',
        ];
    }
}
