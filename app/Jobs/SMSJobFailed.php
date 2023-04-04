<?php

namespace App\Jobs;

use App\Models\SMSLog;
use Illuminate\Queue\Events\JobFailed;

class SMSJobFailed
{
    /**
     * Handle a job failure.
     *
     * @param  \Illuminate\Queue\Events\JobFailed  $event
     * @return void
     */
    public function handle(JobFailed $event)
    {
        $payload = $event->job->payload();
        $data = $payload['data']['command'];

        $smsLog = new SMSLog();
        $smsLog->message = $data['message'];
        $smsLog->employee_id = $data['employee_id'];
        $smsLog->phone_number = $data['phone_number'];
        $smsLog->status = SMSLog::STATUS_FAILED;
        $smsLog->save();
    }
}
