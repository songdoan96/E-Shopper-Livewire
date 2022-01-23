<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Admin\Home\AdminHomeSlider;
use App\Models\Brand;
use App\Models\Category;
use App\Models\HomeCategory;
use App\Models\HomeSlider;
use App\Models\Product;
use Livewire\Component;
use Cart;
use Illuminate\Support\Facades\Auth;

class HomeComponent extends Component
{

    public $min_price;
    public $max_price;
    public $products;

    public function showProducts($id, $type)
    {
        if ($type == "category") {
            $this->products = Product::where('category_id', $id)->where('status', '1')->limit(8)->orderBy('created_at', 'DESC')->get();
        } else {
            $this->products = Product::where('brand_id', $id)->where('status', '1')->limit(8)->orderBy('created_at', 'DESC')->get();
        }
    }

    public function mount()
    {

        $this->products = Product::where('status', '1')->limit(8)->orderBy('created_at', 'DESC')->get();
        if (Auth::check()) {
            // Cart::instance('cart')->restore(Auth::user()->email);
            // Cart::instance('wishlist')->restore(Auth::user()->email);
        }
    }

    // Add to cart
    public function storeCart($product_id, $product_name, $product_price)
    {
        if (Auth::check()) {
            Cart::instance('cart')->store(Auth::user()->email);
            Cart::instance('wishlist')->store(Auth::user()->email);
        }
        Cart::instance('cart')->add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        $this->emitTo('cart-count-component', 'refreshCartCount');
    }
    // Add to wishlist
    public function storeWishlist($product_id, $product_name, $product_price)
    {
        Cart::instance('wishlist')->add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        $this->emitTo('wishlist-count-component', 'refreshWishlistCount');
    }
    // remove item wishlist
    public function removeWishlistItem($product_id)
    {
        foreach (Cart::instance('wishlist')->content() as $row) {
            if ($row->id == $product_id) {
                Cart::instance('wishlist')->remove($row->rowId);
                $this->emitTo('wishlist-count-component', 'refreshWishlistCount');
                return;
            }
        }
    }
    public function render()
    {
        // session()->flush();
        $categories = Category::where('status', '1')->get();
        $brands = Brand::where('status', '1')->get();
        $featured_products = Product::where('featured', '1')->inRandomOrder()->limit(10)->get();
        $home_categories = HomeCategory::find(1);
        $sliders = HomeSlider::where('status', '1')->get();
        if ($home_categories) {
            $cats = explode(',', $home_categories->sel_categories);
            $sel_categories = Category::whereIn('id', $cats)->where('status', '1')->get();
        } else {
            $sel_categories = null;
        }

        $products = $this->products;
        if (Auth::check()) {
            Cart::instance('cart')->store(Auth::user()->email);
            Cart::instance('wishlist')->store(Auth::user()->email);
        }

        return view('livewire.home-component', compact('categories', 'brands', 'featured_products', 'products', 'sel_categories', 'sliders'))->layout("layouts.base");
    }
}
