<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUsersRequest extends FormRequest
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
            'fnameEdit'=>'required|string',
            'lnameEdit'=>'required|string',
            'emailEdit'=>'required|email',
            'phoneEdit'=>'required|digits:11|numeric',
            'addressEdit'=>'required|string',
            'cityEdit'=>'required|string',
            'provinceEdit'=>'required',
            'postalcodeEdit'=>'required|string|min:6|max:6',
        
        ];
    }
}
