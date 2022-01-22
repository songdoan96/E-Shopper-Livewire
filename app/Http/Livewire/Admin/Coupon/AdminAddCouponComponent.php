<?php

namespace App\Http\Livewire\Admin\Coupon;

use App\Models\Coupon;
use Livewire\Component;

class AdminAddCouponComponent extends Component
{
    public $code;
    public $type;
    public $value;
    public $max_value;
    public $exp_date;
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'code' => 'required|unique:coupons',
            'type' => 'required',
            'value' => 'required|numeric',
            'exp_date' => 'required',
        ]);
    }
    public function addCoupon()
    {
        $this->validate([
            'code' => 'required|unique:coupons',
            'type' => 'required',
            'value' => 'required|numeric',
            'max_value' => 'required|numeric',
            'exp_date' => 'required',
        ]);
        $coupon = new Coupon();
        $coupon->code = $this->code;
        $coupon->type = $this->type;
        $coupon->value = $this->value;
        $coupon->max_value = $this->max_value;
        $coupon->exp_date = $this->exp_date;
        $coupon->save();
        session()->flash('success_msg', 'Thêm mã thành công !');
    }
    public function render()
    {
        return view('livewire.admin.coupon.admin-add-coupon-component')->layout("layouts.admin");
    }
}
