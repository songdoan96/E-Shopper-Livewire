<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Admin\Home\AdminHomeSlider;
use App\Models\Brand;
use App\Models\Category;
use App\Models\HomeCategory;
use App\Models\HomeSlider;
use App\Models\Product;
use Livewire\Component;

class HomeComponent extends Component
{
    public $category_id;
    public $brand_id;

    public function showProducts($id, $type)
    {
        $this->category_id = $type == "category" ? $id : null;
        $this->brand_id = $type == "brand" ? $id : null;
    }

    public function render()
    {
        $categories = Category::where('status', '1')->get();
        $brands = Brand::where('status', '1')->get();
        $featured_products = Product::where('featured', '1')->inRandomOrder()->limit(10)->get();
        $home_categories = HomeCategory::find(1);
        $sliders = HomeSlider::where('status', '1')->get();
        if ($home_categories) {
            $cats = explode(',', $home_categories->sel_categories);
            $sel_categories = Category::whereIn('id', $cats)->get();
        } else {
            $sel_categories = null;
        }

        if ($this->category_id) {
            $products = Product::where('category_id', $this->category_id)->where('status', '1')->limit(12)->orderBy('created_at', 'DESC')->get();
        } else if ($this->brand_id)
            $products = Product::where('brand_id', $this->brand_id)->where('status', '1')->limit(12)->orderBy('created_at', 'DESC')->get();
        else {
            $products = Product::where('status', '1')->limit(12)->orderBy('created_at', 'DESC')->get();
        }

        return view('livewire.home-component', compact('categories', 'brands', 'featured_products', 'products', 'sel_categories', 'sliders'))->layout("layouts.base");
    }
}
