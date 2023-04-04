<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaginateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
             'keyword' => ['string', 'nullable'],
            //'paginate' => ['required', 'boolean'],
            'size' => ['required_if:paginate,1'],
            'order_by' => ['nullable'],
            'page' => ['sometimes'],
            'company_id' => ['sometimes'],
            'department_id' => ['sometimes']
        ];
    }
}
