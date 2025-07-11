<?php

use Livewire\Volt\Volt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\OrderController;
use App\Exports\OrdersExport;
use Maatwebsite\Excel\Facades\Excel;

//kode baru diubah menjadi seperti ini
Route::get('/', [HomepageController::class, 'index'])->name('home');
Route::get('products', [HomepageController::class, 'products']);
Route::get('/product/{slug}', [HomepageController::class, 'show'])->name('product.detail');
Route::get('categories',[HomepageController::class, 'categories']);
route::get ('/about',[HomepageController::class, 'about']);
Route::get('category/{slug}', [HomepageController::class, 'category']);
Route::get('cart', [HomepageController::class, 'cart']);
Route::get('checkout', [HomepageController::class, 'checkout']);
Route::post('/order/submit', [OrderController::class, 'submit'])->name('order.submit');
Route::get('/dashboard/orders/create', [OrderController::class, 'create'])->name('orders.create');

Route::get('/orders/export', function (Request $request) {
    $month = $request->input('month', now()->format('m'));
    $year = $request->input('year', now()->format('Y'));
    return Excel::download(new OrdersExport($month, $year), 'orders-' . $month . '-' . $year . '.xlsx');
})->name('orders.export');


Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

Route::group(['prefix'=>'dashboard'],function(){
    Route::resource('posts', PostsController::class);
})->middleware(['auth', 'verified']);



Route::group(['prefix'=>'dashboard'], function(){
    Route::get('/',[DashboardController::class,'index'])->name('dashboard');

    Route::resource('categories',ProductCategoryController::class);
    Route::get('products',[ProductsController::class,'products'])->name('products');
    route::resource('products',ProductsController::class);
    Route::resource('orders', OrderController::class);

})->middleware(['auth', 'verified']);

Route::group(['prefix' => 'customer'], function () {
    Route::controller(CustomerAuthController::class)->group(function () {
        //tampilkan halaman login
        Route::get('login', 'login')->name('customer.login');
        //aksi login
        Route::post('login', 'store_login')->name('customer.store_login');
        //tampilkan halaman register
        Route::get('register', 'register')->name('customer.register');
        //aksi register
        Route::post('register', 'store_register')->name('customer.store_register');
        //aksi logout
        Route::post('logout', 'logout')->name('customer.logout');
    });
});



require __DIR__.'/auth.php';