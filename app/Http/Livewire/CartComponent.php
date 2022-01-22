<?php

namespace App\Http\Livewire;

use App\Models\Coupon;
use Livewire\Component;
use Cart;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class CartComponent extends Component
{
    public $haveCoupon = 0;
    public $code;
    public $discount;
    public $subtotalAfterDiscount;
    public $taxAfterDiscount;
    public $totalAfterDiscount;
    public function removeCartItem($rowId)
    {
        Cart::instance('cart')->remove($rowId);
        $this->emitTo('cart-count-component', 'refreshCartCount');
    }
    public function increaseQty($rowId)
    {
        $qty = Cart::instance('cart')->get($rowId)->qty + 1;
        Cart::instance('cart')->update($rowId, $qty);
    }
    public function decreaseQty($rowId)
    {
        $qty = Cart::instance('cart')->get($rowId)->qty - 1;
        if ($qty > 0) {
            Cart::instance('cart')->update($rowId, $qty);
        }
    }
    function saveForLater($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        Cart::instance('saveForLater')->add($product)->associate("App\Models\Product");
        Cart::instance('cart')->remove($rowId);
        $this->emitTo('cart-count-component', 'refreshCartCount');
    }
    public function moveToCart($rowId)
    {
        $product = Cart::instance('saveForLater')->get($rowId);
        Cart::instance('cart')->add($product)->associate("App\Models\Product");
        Cart::instance('saveForLater')->remove($rowId);
        $this->emitTo('cart-count-component', 'refreshCartCount');
    }
    public function removeItemSaveForLater($rowId)
    {
        Cart::instance('saveForLater')->remove($rowId);
    }
    public function applyCouponCode()
    {
        $coupon = Coupon::where('code', $this->code)->where('exp_date', '>=', Carbon::now())->first();
        if ($coupon) {
            // Mã ok
            session()->put('coupon', [
                'code' => $coupon->code,
                'type' => $coupon->type,
                'value' => $coupon->value,
                'max_value' => $coupon->max_value,
                'exp_date' => $coupon->exp_date,
            ]);
        } else {
            session()->flash('error_msg', 'Không tìm thấy mã hoặc mã đã hết hạn');
            return;
        }
    }
    public function checkout()
    {
        Auth::user() ? redirect('/checkout') : redirect('/login');
    }
    public function calculateDiscounts()
    {

        if (session()->has('coupon')) {
            if (session()->get('coupon')['type'] == 'fixed') {
                $this->discount = session()->get('coupon')['value'];
            } else {
                $this->discount = (Cart::instance('cart')->subtotal() * session()->get('coupon')['value']) / 100;
            }
        }
        if (session()->has('coupon')) {
            if (session()->get('coupon')['type'] === 'fixed') {
                $this->discount = session()->get('coupon')['value'];
            } else {
                $this->discount = (Cart::instance('cart')->subtotal() * session()->get('coupon')['value']) / 100;
            }
            $this->subtotalAfterDiscount = Cart::instance('cart')->subtotal() - $this->discount;
            $this->taxAfterDiscount = $this->subtotalAfterDiscount * config('cart.tax') / 100;
            $this->totalAfterDiscount =  $this->subtotalAfterDiscount + $this->taxAfterDiscount;
        }
        // $this->discount = 0;
        // $this->subtotalAfterDiscount = Cart::instance('cart')->subtotal() - $this->discount;
        // $this->taxAfterDiscount = $this->subtotalAfterDiscount * config('cart.tax') / 100;
        // $this->totalAfterDiscount =  $this->subtotalAfterDiscount + $this->taxAfterDiscount;
    }
    public function setAmountForCheckout()
    {
        if (!Cart::instance('cart')->count() > 0) {
            session()->forget('checkout');
            return;
        }
        if (session()->has('coupon')) {
            session()->put('checkout', [
                'cart_subtotal' => Cart::instance('cart')->subtotal(),
                'discount' => $this->discount,
                'subtotal' => $this->subtotalAfterDiscount,
                'tax' => $this->taxAfterDiscount,
                'total' => $this->totalAfterDiscount,
            ]);
        } else {
            session()->put('checkout', [
                'cart_subtotal' => Cart::instance('cart')->subtotal(),
                'discount' => 0,
                'subtotal' => Cart::instance('cart')->subtotal(),
                'tax' =>  Cart::instance('cart')->tax(),
                'total' =>  Cart::instance('cart')->total(),
            ]);
        }
    }
    public function deleteCoupon()
    {
        session()->forget('coupon');
    }
    public function render()
    {
        // session()->forget('coupon');
        // session()->forget('checkout');

        if (session()->has('coupon')) {
            if (Cart::instance('cart')->subtotal() < session()->get('coupon')['max_value']) {
                session()->forget('coupon');
            } else {
                $this->calculateDiscounts();
            }
        }

        $this->setAmountForCheckout();
        return view('livewire.cart-component')->layout("layouts.base");
    }
}
