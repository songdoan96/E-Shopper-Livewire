<?php

namespace App\Http\Livewire\Admin\Order;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AdminOrder extends Component
{
    public function changeStatusOrder($order_id, $status)
    {
        $order = Order::find($order_id);
        $order->status = $status;
        if ($status == "delivered") {
            $order->delivered_date = DB::raw('CURRENT_TIMESTAMP');
        } else {
            $order->canceled_date = DB::raw('CURRENT_TIMESTAMP');
        }
        $order->update();
    }
    public function render()
    {
        $orders = Order::orderBy('created_at', 'DESC')->paginate(12);
        return view('livewire.admin.order.admin-order', compact('orders'))->layout("layouts.admin");
    }
}
