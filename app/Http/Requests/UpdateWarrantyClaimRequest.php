<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWarrantyClaimRequest extends FormRequest
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
            'code_1c' => 'string|nullable',
            'number_1c' => 'required|string',
            'date' => 'date|nullable',
            'date_of_claim' => 'date|nullable',
            'date_of_sale' => 'date|nullable',
            'factory_number' => 'string|nullable',
            'comment' => 'string|nullable',
            'point_of_sale' => 'string|nullable',
            'product_name' => 'string|nullable',
            'details' => 'string|nullable',
            'manager' => 'string|nullable',
            'autor' => 'string|nullable',
            'client_name' => 'string|nullable',
            'sender_name' => 'string|nullable',
            'client_phone' => 'string|nullable',
            'sender_phone' => 'string|nullable',
            'type_of_claim' => 'string|nullable',
            'receipt_number' => 'string|nullable',
            'service_partner' => 'string|nullable',
            'service_contract' => 'string|nullable',
            'product_article' => 'string|nullable',
            'status' => 'string|nullable',
            'spare_parts_sum' => 'decimal:2|nullable',
            'service_works_sum' => 'decimal:2|nullable',
        ];
    }
}
