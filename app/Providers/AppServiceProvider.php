<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Produk;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('*', function ($view) {
            $genders = Produk::select('gender')
                ->whereNotNull('gender')
                ->where('gender', '!=', '')
                ->distinct()
                ->pluck('gender');

            $view->with('genders', $genders);
        });
    }
}