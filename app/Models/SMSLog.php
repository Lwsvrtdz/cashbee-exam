<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SMSLog extends Model
{
    use HasFactory;

    protected $table = 'sms_logs';

    protected $fillable = [
        'message',
        'employee_id',
        'status'
    ];

    /**
     * The SMS Log statuses
     */
    public const STATUS_SENT = 0;
    public const STATUS_FAILED = 1;
}
