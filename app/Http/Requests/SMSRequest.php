<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SMSRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'message' => ['required', 'string'],
            'department_id' => ['sometimes', 'string'],
            'company_id' => ['required', 'string'],
            'employees' => ['sometimes', 'array']
        ];
    }
}
