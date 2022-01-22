<?php

namespace App\Http\Livewire\Admin\Slider;

use App\Models\HomeSlider;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminSliderComponent extends Component
{

    use WithFileUploads;
    public $title;
    public $sub_title;
    public $description;
    public $image;
    public $price;
    public $link;
    public $status;

    public function deleteSlider($slider_id)
    {
        HomeSlider::destroy($slider_id);
    }
    public function changeStatus($slider_id)
    {
        $home_slider = HomeSlider::find($slider_id);
        $home_slider->status = $home_slider->status == "1" ? "0" : "1";
        $home_slider->update();
    }
    public function render()
    {
        $home_sliders = HomeSlider::all();
        return view('livewire.admin.slider.admin-slider-component', compact('home_sliders'))->layout("layouts.admin");
    }
}
