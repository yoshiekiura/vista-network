<?php

namespace App\Providers;

use App\ChargeCommision;
use App\Footer;
use App\General;
use App\Logo;
use App\Menu;
use App\Social;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        $general = General::find(1);
        $charge = ChargeCommision::find(1);
        $menu = Menu::all();
        $social = Social::all();
        View::share(compact( 'general','menu', 'social', 'charge'));
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
