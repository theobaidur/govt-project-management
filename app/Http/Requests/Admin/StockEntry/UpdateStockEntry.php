<?php

namespace App\Http\Requests\Admin\StockEntry;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateStockEntry extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('admin.stock-entry.edit', $this->stockEntry);
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
            'quantity' => ['sometimes', 'numeric'],
            'unit_name' => ['nullable', 'string'],
            'unit_price' => ['sometimes', 'numeric'],
            'stock_id' => ['nullable', 'exists:stocks,id'],
            
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
