<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'cart_id' => 'required|numeric',
            'title' => 'required|string',
            'description' => 'string',
            'price' => 'required|numeric',
            'discountPercentage' => 'numeric',
            'rating' => 'numeric',
            'stock' => 'required|integer',
            'brand' => 'string',
        ];
    }
}
