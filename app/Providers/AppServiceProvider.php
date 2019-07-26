<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use App;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //redirect http to https
        $arr_url = explode(".", request()->getHttpHost());
        $str_url = '';

        if(count($arr_url) >= 3){
            $str_url = $arr_url[1].'.'.$arr_url[2];
        }

        if (App::environment('product') && $str_url == 'dtg888.net') {
            Url::forceScheme('https');
        }
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
