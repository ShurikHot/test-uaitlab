<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTechnicalConclusionRequest extends FormRequest
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
            'number_1c' => 'string|nullable',
            'date' => 'date|nullable',
            'defect_codes_code_1c' => 'string|nullable',
            'warranty_claim_number_1c' => 'string|exists:warranty_claims,number_1c',
            'conclusion' => 'string|nullable',
            'resolution' => 'string|nullable',
            'symptom_codes_code_1c' => 'string|nullable',
            'appeal_type' => 'string|nullable',
        ];
    }
}
