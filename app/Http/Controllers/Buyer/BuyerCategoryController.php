<?php

namespace App\Http\Controllers\Buyer;

use App\Buyer;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class BuyerCategoryController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Buyer $buyer)
    {
        $sellers = $buyer->transactions()->with('product.categories')
            ->get()
            // pluck berguna untuk hanya menampilkan kategories saja tidak dengan produk dan juga transaksinya
            ->pluck('product.categories')
            // Agar array bersarang menjadi di gabung jadi 1 array misalkan
            ->collapse()
            // tampil data dijson unik kategori tidak repeat
            ->unique('id')
            // untuk menghilangkan kategori yang null
            ->values();
        return $this->showAll($sellers);
    }

}
