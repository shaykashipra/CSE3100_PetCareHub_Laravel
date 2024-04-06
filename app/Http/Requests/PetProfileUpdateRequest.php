<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PetProfileUpdateRequest extends FormRequest
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
            'petnameEdit' => 'required|string',
            'ageEdit' => 'required',
            'genderEdit' => 'required|string',
            'colorEdit' => 'required|string',
            'characteristic' => 'required',
            'coatEdit' => 'required|string',
            'statusEdit'=>'required|string',
            'descriptionEdit' => 'required|string'
        ];
    }
}
