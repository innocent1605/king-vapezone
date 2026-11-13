<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Schema::defaultStringLength(191);

        // Register routes
        Route::middleware('web')
            ->group(base_path('routes/web.php'));

        $this->app->booted(function () {
            $this->app['router']->getRoutes()->refreshNameLookups();
            $this->app['router']->getRoutes()->refreshActionLookups();
        });

        View::composer('*', function ($view) {
            $cartCount = 0;
            if (Auth::check()) {
                $cart = Cart::where('user_id', Auth::id())->with('items')->first();
                $cartCount = $cart ? $cart->item_count : 0;
            }

            $siteSettings = [];
            try {
                if (Schema::hasTable('settings')) {
                    $siteSettings = Setting::pluck('value', 'key')->toArray();
                }
            } catch (\Throwable $e) {
                // Table might not exist yet during migration
            }

            $navCategories = [];
            try {
                if (Schema::hasTable('categories')) {
                    $navCategories = Category::where('is_active', true)->take(8)->get();
                }
            } catch (\Throwable $e) {
                //
            }

            $view->with([
                'cartCount' => $cartCount,
                'siteSettings' => $siteSettings,
                'navCategories' => $navCategories,
            ]);
        });
    }
}
