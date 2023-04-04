<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
    Route::post('login', [
        'as' => 'login',
        'uses' => 'AuthController@login'
    ]);
});


 include 'src/user.php';
 // temporarily removing this: 'middleware' => ['auth:api'],
 Route::group([ 'namespace' => 'User'], function () {
    include 'src/sms.php';
    include 'src/company.php';
    include 'src/department.php';
    include 'src/employee.php';
 });
