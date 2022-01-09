<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductDetailsComponent extends Component
{
    public $product_slug;
    public function mount($product_slug)
    {
        $this->product_slug = $product_slug;
    }
    public function render()
    {
        $product = Product::where('slug', $this->product_slug)->first();
        return view('livewire.product-details-component', compact('product'))->layout("layouts.base");
    }
}
