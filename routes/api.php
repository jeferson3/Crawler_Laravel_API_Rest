<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => '/'], function (){
   Route::apiResource('exchange-rate', \App\Http\Controllers\ExchangeRateController::class);
});
