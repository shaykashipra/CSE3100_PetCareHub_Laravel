<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
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
            'fname'=>'required|string|max:255',
            'lname'=>'string|max:255',
            'phone'=>'nullable|numeric|digits:11',
            'street'=>'nullable|string|max:255',
            'city'=>'nullable|string|max:255',
            'province'=>'nullable|string|max:255',
            'postal_code'=>'nullable|numeric|digits:4',
        ];
    }
}
