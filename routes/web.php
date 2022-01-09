<?php

use App\Http\Livewire\Admin\AdminDashboard;
use App\Http\Livewire\Admin\Brand\AddBrand;
use App\Http\Livewire\Admin\Brand\AdminBrand;
use App\Http\Livewire\Admin\Brand\EditBrand;
use App\Http\Livewire\Admin\Category\AddCategory;
use App\Http\Livewire\Admin\Category\AdminCategory;
use App\Http\Livewire\Admin\Category\EditCategory;
use App\Http\Livewire\Admin\Home\AdminAddHomeSlider;
use App\Http\Livewire\Admin\Home\AdminEditHomeSlider;
use App\Http\Livewire\Admin\Home\AdminHomeCategory;
use App\Http\Livewire\Admin\Home\AdminHomeSlider;
use App\Http\Livewire\Admin\Home\HomeCategory;
use App\Http\Livewire\Admin\Product\AddProduct;
use App\Http\Livewire\Admin\Product\AdminProduct;
use App\Http\Livewire\Admin\Product\EditProduct;
use App\Http\Livewire\CartComponent;
use App\Http\Livewire\CategoryComponent;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\ProductDetailsComponent;
use App\Http\Livewire\User\UserDashboard;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', HomeComponent::class);
Route::get('/details/{product_slug}', ProductDetailsComponent::class)->name('product.details');

Route::get('/checkout', CheckoutComponent::class)->name('checkout');
Route::get('/cart', CartComponent::class);

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

// user
Route::middleware(['auth:sanctum', 'verified', 'isAdmin'])->group(function () {
    Route::get('/dashboard', UserDashboard::class)->name('dashboard');
});
// admin
Route::middleware(['auth:sanctum', 'verified', 'isAdmin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', AdminDashboard::class)->name('admin.dashboard');

        Route::get('/categories', AdminCategory::class)->name('admin.categories');
        Route::get('/category/add', AddCategory::class)->name('admin.add_category');
        Route::get('/category/edit/{cat_id}', EditCategory::class)->name('admin.edit_category');

        Route::get('/brands', AdminBrand::class)->name('admin.brands');
        Route::get('/brand/add', AddBrand::class)->name('admin.add_brand');
        Route::get('/brand/edit/{brand_id}', EditBrand::class)->name('admin.edit_brand');

        Route::get('/products', AdminProduct::class)->name('admin.products');
        Route::get('/product/add', AddProduct::class)->name('admin.add_product');
        Route::get('/product/edit/{product_id}', EditProduct::class)->name('admin.edit_product');

        Route::get('/home-categories', AdminHomeCategory::class)->name('admin.home_categories');

        Route::get('/home-sliders', AdminHomeSlider::class)->name('admin.home_sliders');
        Route::get('/home-sliders/add', AdminAddHomeSlider::class)->name('admin.add_home_sliders');
        Route::get('/home-sliders/edit/{slider_id}', AdminEditHomeSlider::class)->name('admin.edit_home_sliders');
    });
});
