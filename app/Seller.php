<?php

namespace App;
use App\Product;
use App\Scopes\SellerScope;
use App\Transformers\SellerTransformer;

class Seller extends User
{
    public $transformer = SellerTransformer::class;

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
