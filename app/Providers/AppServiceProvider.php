<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Region;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('uuid', function ($attribute, $value, $parameters, $validator) {
            return \Ramsey\Uuid\Uuid::isValid($value);
        });

    }
}
