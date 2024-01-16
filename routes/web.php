<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guest\PageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RestaurantController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* routes guest */
Route::get('/', [PageController::class, 'index'])->name('home');

/* Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

 */

 /* routes app(login) */
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/* routes admin */

Route::middleware(['auth','verified'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function(){
        Route::get('/', [DashboardController::class, 'index'])->name('home');
        Route::resource('restaurant', RestaurantController::class);
        Route::resource('products', ProductController::class);
        Route::resource('orders', OrderController::class);
    });

require __DIR__.'/auth.php';
