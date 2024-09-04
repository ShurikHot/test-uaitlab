<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWarrantyClaimApiRequest extends FormRequest
{
    /**
     * Determine if the auth is authorized to make this request.
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
            'date' => 'date|nullable',
            'date_of_claim' => 'date|nullable',
            'date_of_sale' => 'date|nullable',
            'factory_number' => 'string|nullable',
            'comment' => 'string|nullable',
            'point_of_sale' => 'string|nullable',
            'product_name' => 'string|nullable',
            'details' => 'string|required',
            'manager' => 'string|nullable',
            'autor' => 'string|nullable',
            'client_name' => 'string|nullable',
            'sender_name' => 'string|required',
            'client_phone' => 'string|nullable',
            'sender_phone' => 'string|required',
            'type_of_claim' => 'string|nullable',
            'receipt_number' => 'string|nullable',
            'service_partner' => 'string|required',
            'service_contract' => 'string|nullable',
            'product_article' => 'string|nullable',
            'status' => 'string|nullable',
            'spare_parts_sum' => 'decimal:2|nullable',
            'service_works_sum' => 'decimal:2|nullable',

            'technical_conclusions.date' => 'date|required',
            'technical_conclusions.defect_codes_code_1c' => 'string|required|exists:defect_codes,code_1C',
            'technical_conclusions.conclusion' => 'string|nullable',
            'technical_conclusions.resolution' => 'string|nullable',
            'technical_conclusions.symptom_codes_code_1c' => 'string|required|exists:symptom_codes,code_1C',
            'technical_conclusions.warranty_claims_code_1c' => 'string|nullable|exists:warranty_claims,code_1c',
            'technical_conclusions.appeal_type' => 'string|nullable',

            'service_works.*.code_1c' => 'string|required|exists:service_works,code_1c',
            'service_works.*.warranty_claims_number_1c' => 'string|nullable|exists:warranty_claims,number_1c',
            'service_works.*.qty' => 'decimal:2|required',
            'service_works.*.price' => 'decimal:2|required',
            'service_works.*.sum' => 'decimal:2|nullable',

            'spare_parts.*.code_1c' => 'string|required|exists:spare_parts,code_1c',
            'spare_parts.*.warranty_claims_number_1c' => 'string|nullable|exists:warranty_claims,number_1c',
            'spare_parts.*.qty' => 'decimal:2|required',
            'spare_parts.*.price' => 'decimal:2|required',
            'spare_parts.*.discount' => 'integer|between:0,100|nullable',
        ];
    }

}
