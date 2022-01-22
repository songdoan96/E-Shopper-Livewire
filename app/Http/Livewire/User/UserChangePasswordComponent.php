<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UserChangePasswordComponent extends Component
{
    public $current_password;
    public $password;
    public $confirm_password;
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'current_password' => 'required',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);
    }
    public function changePassword()
    {
        $this->validate([
            'current_password' => 'required',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);
        if (Hash::check($this->current_password, Auth::user()->password)) {
            User::where('id', Auth::user()->id)->update(['password' => Hash::make($this->password)]);
            session()->flash('success_msg', 'Đổi mật khẩu thành công.');
        } else {
            session()->flash('error_msg', 'Mật khẩu cũ không đúng');
        }
    }
    public function render()
    {
        return view('livewire.user.user-change-password-component')->layout("layouts.base");
    }
}
