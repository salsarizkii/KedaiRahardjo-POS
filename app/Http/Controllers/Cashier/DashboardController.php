<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        // Dummy data kategori
        $categories = Category::select('id', 'name', 'slug')->get();

        // Ambil produk dengan relasi kategori
        $products = Product::select(
            'id',
            'product_name',
            'category_id',
            'product_code',
            'product_image',
            'product_description',
            'product_stock',
            'buying_price',
            'selling_price',
            'created_at',
            'updated_at'
        )
            ->with('category')
            ->get();

        // Kelompokkan produk berdasarkan kategori slug
        $groupedProducts = $products->groupBy(function ($product) {
            return $product->category->slug;
        });


        // Dummy untuk menampilkan menu yang paling laris
        $bestSellers = Product::where('is_best_seller', true)->get();

        // return view('cashier.dashboard.index', compact('categories', 'menu', 'bestSellers'));
        return view('cashier.dashboard.index', compact('groupedProducts', 'categories', 'bestSellers'));
    }
}
