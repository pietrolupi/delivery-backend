<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\LeadController;
use App\Http\Controllers\PaymentController;

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

Route::get('/restaurants', [PageController::class, 'index']);
Route::get('/types', [PageController::class, 'getTypes']);
Route::get('/restaurants-by-type', [PageController::class, 'getRestaurantsByType']);
Route::get('/restaurants/restaurant-detail/{id}', [PageController::class, 'getRestaurantById']);
Route::get('/payment/token', [PaymentController::class, 'token']);
Route::post('/payment/checkout', [PaymentController::class, 'checkout']);
Route::post('/send-email', [LeadController::class, 'store']);
