<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;

//

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Restaurant;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('generals.partials.aside', function ($view) {
            $restaurant = Restaurant::where('user_id', Auth::id())->first();
            $view->with('restaurant', $restaurant);
        });
    }
}
