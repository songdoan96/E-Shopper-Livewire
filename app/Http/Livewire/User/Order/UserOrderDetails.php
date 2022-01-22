<?php

namespace App\Http\Livewire\User\Order;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class UserOrderDetails extends Component
{
    public $order_id;
    public function mount($order_id)
    {
        $this->order_id = $order_id;
    }
    public function cancelOrder()
    {
        $order = Order::find($this->order_id);
        $order->status = "canceled";
        $order->canceled_date = DB::raw('CURRENT_TIMESTAMP');
        $order->save();
        session()->flash('success_msg', 'Đã hủy đơn hàng');
    }
    public function render()
    {
        $order = Order::where('user_id', Auth::user()->id)->where('id', $this->order_id)->first();
        return view('livewire.user.order.user-order-details', compact('order'))->layout("layouts.base");
    }
}
