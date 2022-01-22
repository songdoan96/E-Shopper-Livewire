<?php

namespace App\Http\Livewire\Admin\Slider;

use App\Models\HomeSlider;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminAddSliderComponent extends Component
{
    use WithFileUploads;

    public $title;
    public $sub_title;
    public $description;
    public $image;
    public $price;
    public $link;
    public $status;
    public function addHomeSlider()
    {
        $slider = new HomeSlider();
        $slider->title = $this->title;
        $slider->sub_title = $this->sub_title;
        $slider->description = $this->description;
        if ($this->image) {
            $imageName = "slider_" . Carbon::now()->timestamp . '.' . $this->image->extension();
            $this->image->storeAs('sliders', $imageName);
            $slider->image = $imageName;
        }
        $slider->price = $this->price;
        $slider->link = $this->link;
        $slider->status = $this->status;
        $slider->save();
        session()->flash('success_msg', "Thêm slider thành công !");
    }
    public function render()
    {
        return view('livewire.admin.slider.admin-add-slider-component')->layout('layouts.admin');
    }
}
