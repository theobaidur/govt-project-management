<?php

namespace App\Http\Requests\Admin\StockEntry;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreStockEntry extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('admin.stock-entry.create');
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
            'quantity' => ['required', 'numeric'],
            'unit_name' => ['nullable', 'string'],
            'unit_price' => ['required', 'numeric'],
            'stock_id' => ['nullable', 'exists:stocks,id'],
            
        ];
    }
}
