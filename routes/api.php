<?php

use App\Http\Controllers\FamilyController;
use App\Http\Controllers\PersonController;
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

Route::middleware('auth:api')->group(function(){
    Route::get('user', function (Request $request) {
        return $request->user();
    });

    Route::get('people/{person}', [PersonController::class, 'Get']);
    Route::post('people', [PersonController::class, 'Create']);

    Route::post('families', [FamilyController::class, 'Create']);

    Route::post('families/{family}/people/{person}', [FamilyController::class, 'AddMember']);
});
