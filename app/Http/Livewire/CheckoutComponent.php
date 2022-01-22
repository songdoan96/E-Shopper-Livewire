<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Shipping;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Cart;

class CheckoutComponent extends Component
{
    public $thankyou;

    public $name;
    public $phone;
    public $email;
    public $line;
    public $city;
    public $province;
    public $note;
    public $method;
    public function placeOrder()
    {
        $shipping = new Shipping();
        $shipping->name = $this->name;
        $shipping->phone = $this->phone;
        $shipping->email = $this->email;
        $shipping->line = $this->line;
        $shipping->city = $this->city;
        $shipping->province = $this->province;
        $shipping->note = $this->note;
        $shipping->save();

        $shipping_id = $shipping->id;
        $user_id = Auth::user()->id;

        $order = new Order();
        $order->user_id = $user_id;
        $order->shipping_id = $shipping_id;
        $order->subtotal = session()->get('checkout')['subtotal'];
        $order->discount = session()->get('checkout')['discount'];
        $order->tax = session()->get('checkout')['tax'];
        $order->total = session()->get('checkout')['total'];
        $order->status = "ordered";
        $order->coupon_code = session()->get('coupon')['code'];
        $order->cart_subtotal = session()->get('checkout')['cart_subtotal'];
        $order->save();


        foreach (Cart::instance('cart')->content() as $key => $item) {
            $orderItem = new OrderItem();
            $orderItem->product_id = $item->id;
            $orderItem->order_id =  $order->id;
            $orderItem->price =  $item->price;
            $orderItem->quantity =  $item->qty;

            $orderItem->save();
        }
        $this->resetCart();
    }
    public function resetCart()
    {
        $this->thankyou = 1;
        Cart::instance('cart')->destroy();
        session()->forget('coupon');
        session()->forget('checkout');
    }
    public function verifyCheckout()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        } else if ($this->thankyou == 1) {
            return redirect()->route('thankyou');
        } else if (!session()->get('checkout')) {
            return redirect()->route('cart');
        }
    }
    public function render()
    {
        $this->verifyCheckout();
        return view('livewire.checkout-component')->layout("layouts.base");
    }
}
