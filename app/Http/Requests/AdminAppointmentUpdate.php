<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminAppointmentUpdate extends FormRequest
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
            // 'doctor_id' => 'required|exists:doctors,id',
            // 'date' => 'required',
            // 'time' => 'required',
            // 'room_id' => 'nullable|string',
            // 'status' => 'string|in:pending,approved,rejected',           
        ];
    }
}
