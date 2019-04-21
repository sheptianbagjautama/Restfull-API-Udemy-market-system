<?php

namespace App;
use App\Transaction;
use App\Scopes\BuyerScope;

class Buyer extends User
{
    // Menggunakan global scope(BuyerScope) harus diinisialisasi di method bawaan laravel yaitu boot
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new BuyerScope); 
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
