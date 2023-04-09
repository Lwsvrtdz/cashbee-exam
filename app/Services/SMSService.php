<?php

namespace App\Services;

use App\Jobs\SMSJob;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Support\Facades\Log;

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
        // We are requiring this upon Request
        // no need to sanity check it.
        $receivers = Employee::whereIn('id', $payload['employees'])
            ->get();

        //Loop thru all selected Employees
        foreach ($receivers as $receiver) {
            SMSJob::dispatch($payload['message'], $receiver->id, $receiver->phone_number);
        }
    }
}
