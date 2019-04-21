<?php

namespace App;
use App\Product;
use App\Scopes\SellerScope;

class Seller extends User
{
    // Menggunakan global scope(SellerScope) harus diinisialisasi di method bawaan laravel yaitu boot
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new SellerScope); 
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
