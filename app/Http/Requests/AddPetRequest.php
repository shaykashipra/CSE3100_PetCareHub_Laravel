<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddPetRequest extends FormRequest
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
           'pet_name' => 'required|string',
            'pet_image' => 'required',
            'age' => 'required',
            'gender' => 'required|string',
            'characteristic' => 'required',
            'animalType' => 'required|string',
            'coat' => 'required|string',
            'color' => 'required|string',
            'description' => 'required|string'           
        ];
    }
}
