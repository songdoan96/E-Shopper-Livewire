<?php

namespace App\Http\Livewire\Admin\Coupon;

use App\Models\Coupon;
use Livewire\Component;

class AdminEditCouponComponent extends Component
{
    public $code;
    public $type;
    public $value;
    public $max_value;
    public $exp_date;
    public $coupon_id;
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'code' => 'required',
            'type' => 'required',
            'value' => 'required|numeric',
            'max_value' => 'required|numeric',
            'exp_date' => 'required',
        ]);
    }
    public function mount($coupon_id)
    {
        $coupon = Coupon::find($coupon_id);
        $this->code = $coupon->code;
        $this->type = $coupon->type;
        $this->value = $coupon->value;
        $this->max_value = $coupon->max_value;
        $this->exp_date = $coupon->exp_date;
    }
    public function updateCoupon()
    {
        $this->validate([
            'code' => 'required',
            'type' => 'required',
            'value' => 'required|numeric',
            'max_value' => 'required|numeric',
            'exp_date' => 'required',
        ]);
        $coupon = Coupon::find($this->coupon_id);
        $coupon->code = $this->code;
        $coupon->type = $this->type;
        $coupon->value = $this->value;
        $coupon->max_value = $this->max_value;
        $coupon->exp_date = $this->exp_date;
        $coupon->update();
        session()->flash('success_msg', 'Cập nhật thành công !');
    }
    public function render()
    {
        return view('livewire.admin.coupon.admin-edit-coupon-component')->layout("layouts.admin");
    }
}
