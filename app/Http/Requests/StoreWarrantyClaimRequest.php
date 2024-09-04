<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWarrantyClaimRequest extends FormRequest
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
            'details' => 'required|string', /**/
            'manager' => 'string|nullable',
            'autor' => 'string|nullable',
            'client_name' => 'string|nullable',
            'sender_name' => 'required|string', /**/
            'client_phone' => 'string|nullable',
            'sender_phone' => 'required|string', /**/
            'type_of_claim' => 'string|nullable',
            'receipt_number' => 'string|nullable',
            'service_partner' => 'required|string', /**/
            'service_contract' => 'string|nullable',
            'product_article' => 'string|nullable',
            'status' => 'string|nullable',
            'spare_parts_sum' => 'decimal:2|nullable',
            'service_works_sum' => 'decimal:2|nullable',
            'items' => 'array|nullable',
            'items.*' => 'array|nullable',
            'items.*.articul' => 'string|nullable',
            'items.*.product' => 'string|nullable',
            'items.*.price' => 'string|nullable',
            'items.*.discount' => 'string|nullable',
            'items.*.qty' => 'string|nullable',
            'works' => 'array|nullable',
            'works.*' => 'array|nullable',
            'works.*.code_1c' => 'string|nullable',
            'works.*.checked' => 'string|nullable',
            'works.*.product' => 'string|nullable',
            'works.*.price' => 'numeric|nullable',
            'works.*.qty' => 'numeric|nullable',
        ];
    }
}
