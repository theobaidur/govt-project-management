<?php

namespace App\Http\Requests\Admin\Invoice;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreInvoice extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('admin.invoice.create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'system_invoice_no' => ['nullable', 'string'],
            'billing_invoice_no' => ['nullable', 'string'],
            'amount' => ['required', 'numeric'],
            'cash' => ['required', 'numeric'],
            'tax' => ['nullable', 'numeric'],
            'security_money' => ['nullable', 'numeric'],
            'invoice_type' => ['required', 'in:credit_voucher,debit_voucher'],
            'note' => ['nullable', 'string'],
            'billing_account_id' => ['nullable', 'exists:billing_accounts,id'],
            'project_id' => ['nullable', 'exists:projects,id'],
            'billing_name'=> ['required_without:billing_account_id|string']
        ];
    }
}