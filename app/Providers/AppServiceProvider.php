<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Cart;
use Illuminate\Support\Facades\View;
use Auth;
Use App\Models\ProductCategory;
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
        view()->composer('layouts.home.layouts.header', function ($view) {
            $ProductCates = ProductCategory::wherenull('parent_id')->get();
            $view->with(['ProductCates'=>$ProductCates]);
        });
    }
}
