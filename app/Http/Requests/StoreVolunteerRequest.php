<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVolunteerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string',
            'number' => 'required|string',
            'city' => 'required|string',
            'code_postal' => 'required|string',
            'availabilities' => 'nullable|array',
            'availabilities.*' => 'string',
        ];
    }
}
