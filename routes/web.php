<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StripeController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get("/", [StripeController::class, 'handleGet']);
Route::post("/", [StripeController::class, 'handlePost'])->name("stripe.payment");
Route::get("/stripe-oauth-callback", [StripeController::class, 'stripeOauthCallback']);



