<?php

use Illuminate\Support\Facades\Route;

Route::group([], function () {
    Route::post('sms', 'SMSController@sendSMS');
});
