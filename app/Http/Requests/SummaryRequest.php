<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SummaryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'text' => ['required', 'string', 'min:20', 'max:5000'],
        ];
    }

    public function messages(): array
    {
        return [
            'text.required' => 'The text field is required.',
            'text.string' => 'The text must be a valid string.',
            'text.min' => 'The text must have at least 20 characters.',
            'text.max' => 'The text cannot exceed 5000 characters.'
        ];
    }
}
