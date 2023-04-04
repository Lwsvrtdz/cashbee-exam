<?php

use Illuminate\Support\Facades\Route;

Route::group([], function () {
    Route::apiResource('companies', 'CompanyController');
});
