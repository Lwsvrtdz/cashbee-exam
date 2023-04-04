<?php

namespace App\Services;

use App\Jobs\SMSJob;
use App\Models\Company;
use App\Models\Employee;

class SMSService
{
    /**
     * Handle and send bulk SMS for all selected Employees
     *
     * @param array $payload
     * @return void
     */
    public function handleBulkSMS(array $payload): void
    {
        $company = Company::find($payload['company_id']);

        //If selecting just the whole company
        $receivers = $company->employees;

        //If selecting single department
        if (isset($filters['department_id']) && !isset($filters['employees'])) {
            $receivers =  Employee::where('department_id', $filters['company_id']);
        }

        if (isset($filters['employees']) && !empty($filters['employees'])) {
            $receivers = Employee::whereIn('id', $filters['employees']);
        }

        foreach ($receivers as $receiver) {
            SMSJob::dispatch($payload['message'], $receiver->employee_id, $receiver->phone_number);
        }
    }
}
