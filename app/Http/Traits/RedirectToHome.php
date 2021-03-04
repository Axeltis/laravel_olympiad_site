<?php
namespace App\Http\Traits;
use Illuminate\Support\Facades\Auth;

trait RedirectToHome
{
    protected function redirectTo(): string
    {
        if(Auth::check())
            return route(Auth::user()->role->slug.'.home');
        else return route('login');
    }
}
