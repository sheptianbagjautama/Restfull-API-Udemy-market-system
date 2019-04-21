<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'description',
    ];

    // untuk menghilangkan json field pivot di restull api 
    protected $hidden = [
        'pivot' 
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
