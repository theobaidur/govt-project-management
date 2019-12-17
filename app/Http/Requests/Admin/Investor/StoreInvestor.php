<?php

namespace App\Http\Requests\Admin\Investor;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreInvestor extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('admin.investor.create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'exists:admin_users,id'],
            'project_id' => ['required', 'exists:projects,id'],
            'investment_amount' => ['required', 'numeric'],
            
        ];
    }
}
