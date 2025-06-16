<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Categories;
use App\Models\Product;

class HomepageController extends Controller
{
    public function index()
    {
        $categories = Categories::all();
        $products = Product::all();


        return view('web.homepage', [
            'categories' => $categories,
            'products' => $products,
            'title' => 'Homepage'
        ]);
    }

    public function products()
    {
        $products = Product::all();  // Ambil semua produk

        return view('web.products', [
            'products' => $products,   // Kirim variabel products ke view
            'title' => 'Products'
        ]);
    }


   public function show($slug)
{
    $product = Product::where('slug', $slug)->firstOrFail();

    return view('web.product', [
        'product' => $product,
        'title' => $product->name
    ]);
}



    public function categories()
    {
    $categories = Categories::all(); // Atau gunakan pagination jika perlu
    return view('web.categories', compact('categories'));
}

    public function category($slug)
    {
        $category = Categories::where('slug', $slug)->first();

        if (!$category) {
            abort(404);
        }

        $products = $category->products;

        return view('web.category_by_slug', [
            'category' => $category,
            'products' => $products,
            'title' => $category->name,
            'slug' => $slug,
        ]);
    }


    public function cart()
    {
        return view('web.cart', [
            'title' => 'Cart'
        ]);
    }

    public function checkout()
    {
        return view('web.checkout', [
            'title' => 'Checkout'
        ]);
    }
    public function about()
{
    return view('web.about', [
        'title' => 'Tentang Kami'
    ]);
}

}

