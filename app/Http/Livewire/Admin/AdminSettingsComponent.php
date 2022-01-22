<?php

namespace App\Http\Livewire\Admin;

use App\Models\Setting;
use Livewire\Component;

class AdminSettingsComponent extends Component
{
    public $email;
    public $phone;
    public $phone2;
    public $address;
    public $facebook;
    public $youtube;
    public $map;
    public $twitter;
    public $instagram;

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'email' => 'email'

        ]);
    }
    public function mount()
    {
        $settings = Setting::find(1);
        if ($settings) {
            $this->email = $settings->email;
            $this->phone = $settings->phone;
            $this->phone2 = $settings->phone2;
            $this->address = $settings->address;
            $this->facebook = $settings->facebook;
            $this->youtube = $settings->youtube;
            $this->map = $settings->map;
            $this->twitter = $settings->twitter;
            $this->instagram = $settings->instagram;
        }
    }
    public function saveSettings()
    {
        $this->validate([
            'email' => 'email'
        ]);
        $setting = Setting::find(1);
        if (!$setting) {
            $setting = new Setting();
        }
        $setting->email = $this->email;
        $setting->phone = $this->phone;
        $setting->phone2 = $this->phone2;
        $setting->address = $this->address;
        $setting->facebook = $this->facebook;
        $setting->youtube = $this->youtube;
        $setting->map = $this->map;
        $setting->twitter = $this->twitter;
        $setting->instagram = $this->instagram;

        $setting->update();
        session()->flash('success_msg', 'Cập nhật thành công.');
    }
    public function render()
    {
        $settings = Setting::find(1);
        return view('livewire.admin.admin-settings-component', compact('settings'))->layout("layouts.admin");
    }
}
