<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Cart;

class ProductDetailsComponent extends Component
{
    public $product_slug;
    public $quantity = 1;
    public function mount($product_slug)
    {
        $this->product_slug = $product_slug;
    }
    public function storeCart($product_id, $product_name, $product_price)
    {
        if (!$this->quantity > 0) {
            $this->quantity = 1;
        }
        Cart::instance('cart')->add($product_id, $product_name, $this->quantity, $product_price)->associate('App\Models\Product');
        $this->emitTo('cart-count-component', 'refreshCartCount');
    }
    public function render()
    {
        $product = Product::where('slug', $this->product_slug)->first();
        return view('livewire.product-details-component', compact('product'))->layout("layouts.base");
    }
}
