<?php

namespace App\Listeners;

use App\Events\SMSEvent;
use App\Models\SMSLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SMSListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SMSEvent $event)
    {
        $log = new SMSLog();
        $log->message = $event->message;
        $log->employee_id = $event->employeeId;
        $log->status = $event->status;
        $log->save();
    }
}
