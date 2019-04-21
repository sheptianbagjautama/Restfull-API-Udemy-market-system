<?php

namespace App\Http\Controllers\Product;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Category;

class ProductCategoryController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        $categories = $product->categories;
        return $this->showAll($categories);
    }

    public function update(Request $request, Product $product, Category $category)
    {
        // untuk menambah atau mengupdate data yang terdapat relasi many to many
        // attach, sync, syncWithoutDetaching
        // attach akan mengupdate data tapi ketika memasukan 2 data kategori menjadi duplikat
        // sync akan mengupdate data tapi ketika memasukan data kategori , kategori yang lain menjadi terhapus
        // syncWithoutDetaching mengupdate data , ketika mengupdate data kategori tidak mengalami duplikasi dan juga tidak menghapus kategori yang lain
        $product->categories()->syncWithoutDetaching([$category->id]);
        return $this->showAll($product->categories);
    }

    public function destroy(Product $product, Category $category)
    {
        if (!$product->categories()->find($category->id)) {
            return $this->errorResponse('The specified category is not a category of this product', 404);
        }

        // ketika menghapus data makan di detach untuk menghapus relasi antar produk dan juga kategori yang dihapus
        $product->categories()->detach($category->id);
        return $this->showAll($product->categories);
    }
}
