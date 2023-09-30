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
}
