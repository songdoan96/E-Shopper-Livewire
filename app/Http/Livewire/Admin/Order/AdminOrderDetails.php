<?php

namespace App\Http\Livewire\Admin\Order;

use App\Models\Order;
use Livewire\Component;

class AdminOrderDetails extends Component
{
    public $order_id;
    public function mount($order_id)
    {
        $this->order_id = $order_id;
    }
    public function render()
    {
        $order = Order::find($this->order_id);
        return view('livewire.admin.order.admin-order-details', compact('order'))->layout("layouts.admin");
    }
}
