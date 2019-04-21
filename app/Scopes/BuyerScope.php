<?php 


namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class BuyerScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $builder->has('transactions');
    }
}


// File ini disebut dengan global scope tujuannya untuk menseleksi suatu data berdasarkan kondisi tertentu
// sebenarnya bisa saja kita tidak menggunakan global scope ini tetapi dengan menggunakan global scope ini
// menjadi lebih mudah in the future untuk melakukan maintance, tidak harus edit satu persatu
