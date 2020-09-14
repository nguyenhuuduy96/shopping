<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Cart;
use Illuminate\Support\Facades\View;
use Auth;
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
       View::composer('layouts.home.layouts.cart',function($view){
            
            if (Auth::check()) {
                $carts = Cart::session(Auth::user()->id)->getContent();
            }else{
                $carts = Cart::getContent();
            }
            $cartSubTotal = Cart::getSubTotal();
            // dd($carts);
            $view->with(['carts'=>$carts,'cartSubTotal'=>$cartSubTotal]);
        });
    }
}
