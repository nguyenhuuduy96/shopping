<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Cart;
use Illuminate\Support\Facades\View;
use Auth;
Use App\Models\ProductCategory;
Use App\Models\Setting;
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
            if (Auth::check()) {
                $carts = Cart::session(Auth::user()->id)->getContent();
            }else{
                $carts = Cart::getContent();
            }
            $countCart = count($carts);
            $ProductCates = ProductCategory::wherenull('parent_id')->get();
            $setting = !empty(Setting::first())?Setting::first():null;
            $view->with(['ProductCates'=>$ProductCates,'setting'=>$setting,'countCart'=>$countCart]);
        });
        view()->composer('layouts.home.layouts.footer', function ($view) {
            $setting = !empty(Setting::first())?Setting::first():null;
            $view->with(['setting'=>$setting]);
        });
    }
}
