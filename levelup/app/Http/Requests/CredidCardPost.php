<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CredidCardPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //date
            'type'      => 'required|string|in:visa,am,mc',
            'username'  => 'required|string|max:50',
            'cvv'   =>  'required|integer|digits_between:3,4',
            'pan'   =>  'required|integer|digits_between:16,19',
        ];
    }
    public function messages()
    {
        return [
            'type.required' => 'Credit card type is required',
            'username.required' => 'Credit card owner is required',
            'cvv.required' => 'Credit card CVV is required',
            'pan.required' => 'Credit card pan is required',

            'cvv.integer' => 'CVV must be an integer',
            'pan.integer' => 'PAN must be an integer',

            'cvv.digits_between' => 'CVV must be between 3 and 4 digits (inclusive)',
        ];
    }
}
