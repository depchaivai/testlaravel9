<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


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
            'name' => [
                'required',
                Rule::unique('products')->ignore($this->id)
            ],
            'sku' => [
                'required',
                Rule::unique('products')->ignore($this->id)
            ],
            'category' => [
                'required',
                'numeric'
            ],
            'room' => [
                'numeric',
            ],
            'collection' => [
                'numeric',
            ]
        ];
    }
}
