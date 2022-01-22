<?php

namespace App\Http\Livewire\Admin\Coupon;

use App\Models\Coupon;
use Livewire\Component;

class AdminCouponComponent extends Component
{
    public function deleteCoupon($coupon_id)
    {
        Coupon::destroy($coupon_id);
        session()->flash('success_msg', 'Xoá mã thành công !');
    }
    public function render()
    {
        $coupons = Coupon::all();
        return view('livewire.admin.coupon.admin-coupon-component', compact('coupons'))->layout("layouts.admin");
    }
}
