<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Cart;

class WishlistComponent extends Component
{
    public function moveToCart($rowId)
    {

        $product = Cart::instance('wishlist')->get($rowId);
        Cart::instance('cart')->add($product->id, $product->name, 1, $product->price)->associate('App\Models\Product');
        Cart::instance('wishlist')->remove($rowId);
        $this->emitTo('cart-count-component', 'refreshCartCount');
        $this->emitTo('wishlist-count-component', 'refreshWishlistCount');
    }
    public function render()
    {
        return view('livewire.wishlist-component')->layout("layouts.base");
    }
}
