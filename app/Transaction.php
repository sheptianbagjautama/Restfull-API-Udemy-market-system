<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Buyer;
use App\Product;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Transformers\TransactionTransformer;

class Transaction extends Model
{
    use SoftDeletes;
    
    public $transformer = TransactionTransformer::class;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'quantity',
        'buyer_id',
        'product_id',
    ];

    public function buyer()
    {
        return $this->belongsTo(Buyer::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
