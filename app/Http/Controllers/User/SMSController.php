<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\SMSRequest;
use App\Jobs\SMSJob;
use App\Services\SMSService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SMSController extends Controller
{
    private $service;

    public function __construct(SMSService $service)
    {
        $this->service = $service;
    }

    public function sendSMS(SMSRequest $request): JsonResponse
    {
        $this->service->handleBulkSMS($request->validated());

        return response()->json([
            'message' => 'Sending SMS... Please wait'
        ]);
    }
}
