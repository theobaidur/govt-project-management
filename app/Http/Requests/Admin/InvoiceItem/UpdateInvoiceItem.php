<?php

namespace App\Http\Requests\Admin\InvoiceItem;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateInvoiceItem extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('admin.invoice-item.edit', $this->invoiceItem);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'type' => ['sometimes', 'string'],
            'description' => ['nullable', 'string'],
            'quantity' => ['nullable', 'numeric'],
            'unit_name' => ['nullable', 'string'],
            'unit_price' => ['nullable', 'numeric'],
            'amount' => ['sometimes', 'numeric'],
            'invoice_id' => ['sometimes', 'string'],
            
        ];
    }

    /**
     * Modify input data
     *
     * @return array
     */
    public function getSanitized(): array
    {
        $sanitized = $this->validated();


        //Add your code for manipulation with request data here

        return $sanitized;
    }
}
