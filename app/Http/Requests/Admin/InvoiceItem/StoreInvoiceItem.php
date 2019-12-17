<?php

namespace App\Http\Requests\Admin\InvoiceItem;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreInvoiceItem extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('admin.invoice-item.create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'type' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'quantity' => ['nullable', 'numeric'],
            'unit_name' => ['nullable', 'string'],
            'unit_price' => ['nullable', 'numeric'],
            'amount' => ['required', 'numeric'],
            'invoice_id' => ['nullabe', 'exists:invoices,id'],
            'stock_id' => ['nullabe', 'exists:stocks,id'],
        ];
    }
}
