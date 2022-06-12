<?php

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\CompanyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', [AuthApiController::class, 'login']);

Route::middleware('auth:sanctum')->group(function (){

    Route::get('companies', [ApiController::class, 'companies']);
    Route::get('clients/{id}', [ApiController::class, 'clients']);
    Route::get('client_companies/{id}', [ApiController::class, 'client_companies']);

});



