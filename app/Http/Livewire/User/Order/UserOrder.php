<?php

namespace App\Http\Livewire\User\Order;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserOrder extends Component
{
    public function render()
    {
        $orders = Order::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(12);
        // dd($orders);
        return view('livewire.user.order.user-order', compact('orders'))->layout("layouts.base");
    }
}
