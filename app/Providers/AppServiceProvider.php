<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Product;
use App\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserCreated;
use App\Mail\UserMailChanged;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
      
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        // logic ini untuk verifikasi email ketika user registrasi
        User::created(function($user) {
            Mail::to($user)->send(new UserCreated($user));
        });

        // User::created(function($user) {
        //     retry(5, function() use ($user) {
        //         Mail::to($user)->send(new UserCreated($user));
        //     },100);
        // });

        // logic ini untuk updated email ketika user melakukan perubahan email
        User::updated(function($user) {
            if ($user->isDirty('email')) {
                Mail::to($user)->send(new UserMailChanged($user));     
            }
        });

        // User::updated(function($user) {
        //     if ($user->isDirty('email')) {
        //         retry(5, function() use ($user) {
        //             Mail::to($user)->send(new UserMailChanged($user)); 
        //         },100);  
        //     }
        // });


        // logic ini yaitu untuk melakukan update status quantity ketika nilai quantity nya adalah 0 
        Product::updated(function($product) {
            if ($product->quantity == 0 && $product->isAvailable()) {
                $product->status = Product::UNAVAILABLE_PRODUCT;

                $product->save();
            }
        });
    }
}
