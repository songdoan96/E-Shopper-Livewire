<?php

namespace App\Http\Livewire;


use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;

class ShopComponent extends Component
{
    use WithPagination;

    public $sorting;
    public $pagesize;
    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->sorting = "default";
        $this->pagesize = 12;
    }
    // Add to cart
    public function storeCart($product_id, $product_name, $product_price)
    {
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

        if ($this->sorting == "date") {
            $products = Product::where('status', '1')->orderBy('created_at', 'desc')->paginate($this->pagesize);
        } else if ($this->sorting == "price_asc") {
            # code...
            $products = Product::where('status', '1')->orderBy('price', 'asc')->paginate($this->pagesize);
        } else if ($this->sorting == "price_desc") {
            $products = Product::where('status', '1')->orderBy('price', 'desc')->paginate($this->pagesize);
        } else {
            $products = Product::where('status', '1')->paginate($this->pagesize);
        }
        return view('livewire.shop-component', compact('products'))->layout("layouts.base");
    }
}
