<?php

namespace App\Jobs;

use App\Events\SMSEvent;
use App\Models\SMSLog;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Twilio\Rest\Client;

class SMSJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    private $message;

    private $employeeId;

    private $phoneNumber;

    private $status;

    /**
     * Create a new job instance.
     */
    public function __construct(string $message, int $employeeId, string $phoneNumber)
    {
        $this->message = $message;
        $this->employeeId = $employeeId;
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $twilio = new Client(config('services.twilio.account_sid'), config('services.twilio.auth_token'));

        $twilio->messages->create(
            $this->phoneNumber,
            array(
                'from' => config('services.twilio.from'),
                'body' => $this->message,
            )
        );

        $this->status = SMSLog::STATUS_SENT;

        event(new SMSEvent($this->message, $this->employeeId, $this->phoneNumber, $this->status));
    }

     /**
     * Handle a failed job.
     * This will log a Failed SMS on our SMSLog
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function failed(\Exception $exception)
    {
        // Log the failed job on SMSLog
        Log::error('SMS Job Failed: ' . $exception->getMessage());

        $this->status = SMSLog::STATUS_FAILED;

        event(new SMSEvent($this->message, $this->employeeId, $this->phoneNumber, $this->status));
    }
}
