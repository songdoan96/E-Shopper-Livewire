<?php

use App\Http\Livewire\Admin\AdminDashboard;
use App\Http\Livewire\Admin\AdminSettingsComponent;
use App\Http\Livewire\Admin\Brand\AddBrand;
use App\Http\Livewire\Admin\Brand\AdminBrand;
use App\Http\Livewire\Admin\Brand\EditBrand;
use App\Http\Livewire\Admin\Category\AddCategory;
use App\Http\Livewire\Admin\Category\AdminCategory;
use App\Http\Livewire\Admin\Category\EditCategory;
use App\Http\Livewire\Admin\Contact\AdminContactComponent;
use App\Http\Livewire\Admin\Coupon\AdminAddCouponComponent;
use App\Http\Livewire\Admin\Coupon\AdminCouponComponent;
use App\Http\Livewire\Admin\Coupon\AdminEditCouponComponent;
use App\Http\Livewire\Admin\Home\AdminAddHomeSlider;
use App\Http\Livewire\Admin\Home\AdminEditHomeSlider;
use App\Http\Livewire\Admin\Home\AdminHomeCategory;
use App\Http\Livewire\Admin\Home\AdminHomeSlider;
use App\Http\Livewire\Admin\Home\HomeCategory;
use App\Http\Livewire\Admin\Order\AdminOrder;
use App\Http\Livewire\Admin\Order\AdminOrderDetails;
use App\Http\Livewire\Admin\Product\AddProduct;
use App\Http\Livewire\Admin\Product\AddProductComponent;
use App\Http\Livewire\Admin\Product\AdminProduct;
use App\Http\Livewire\Admin\Product\EditProduct;
use App\Http\Livewire\Admin\Slider\AdminAddSliderComponent;
use App\Http\Livewire\Admin\Slider\AdminEditSliderComponent;
use App\Http\Livewire\Admin\Slider\AdminSliderComponent;
use App\Http\Livewire\CartComponent;
use App\Http\Livewire\CategoryComponent;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Livewire\ContactComponent;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\ProductDetailsComponent;
use App\Http\Livewire\SearchComponent;
use App\Http\Livewire\ShopComponent;
use App\Http\Livewire\ThankyouComponent;
use App\Http\Livewire\User\Order\UserOrder;
use App\Http\Livewire\User\Order\UserOrderDetails;
use App\Http\Livewire\User\Review\UserReviewComponent;
use App\Http\Livewire\User\UserChangePasswordComponent;
use App\Http\Livewire\User\UserDashboard;
use App\Http\Livewire\WishlistComponent;
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

Route::get('/', HomeComponent::class)->name('home');
Route::get('/details/{product_slug}', ProductDetailsComponent::class)->name('product.details');

Route::get('/checkout', CheckoutComponent::class)->name('checkout');
Route::get('/cart', CartComponent::class)->name('cart');
Route::get('/wishlist', WishlistComponent::class)->name('wishlist');
Route::get('/thankyou', ThankyouComponent::class)->name('thankyou');
Route::get('/shop', ShopComponent::class)->name('shop');
Route::get('/contact-us', ContactComponent::class)->name('contact');
Route::get('/search', SearchComponent::class)->name('product.search');


// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

// user
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', UserDashboard::class)->name('user.dashboard');
    Route::get('/orders', UserOrder::class)->name('user.orders');
    Route::get('/orders/{order_id}', UserOrderDetails::class)->name('user.orders_details');

    Route::get('/reviews/{order_item_id}', UserReviewComponent::class)->name('user.reviews');


    Route::get('/change-password', UserChangePasswordComponent::class)->name('user.change_password');
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
        Route::get('/product/add', AddProductComponent::class)->name('admin.add_product');
        Route::get('/product/edit/{product_id}', EditProduct::class)->name('admin.edit_product');

        Route::get('/home-categories', AdminHomeCategory::class)->name('admin.home_categories');

        Route::get('/home-sliders', AdminSliderComponent::class)->name('admin.home_sliders');
        Route::get('/home-sliders/add', AdminAddSliderComponent::class)->name('admin.add_home_sliders');
        Route::get('/home-sliders/edit/{slider_id}', AdminEditSliderComponent::class)->name('admin.edit_home_sliders');

        Route::get('/coupons', AdminCouponComponent::class)->name('admin.coupons');
        Route::get('/coupon/add', AdminAddCouponComponent::class)->name('admin.add_coupon');
        Route::get('/coupon/edit/{coupon_id}', AdminEditCouponComponent::class)->name('admin.edit_coupon');

        Route::get('/orders', AdminOrder::class)->name('admin.orders');
        Route::get('/orders/{order_id}', AdminOrderDetails::class)->name('admin.orders_details');

        Route::get('/contact-us', AdminContactComponent::class)->name('admin.contacts');
        Route::get('/settings', AdminSettingsComponent::class)->name('admin.settings');
    });
});
