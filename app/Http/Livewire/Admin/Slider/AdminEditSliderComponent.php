<?php

namespace App\Http\Livewire\Admin\Slider;

use App\Models\HomeSlider;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminEditSliderComponent extends Component
{
    use WithFileUploads;

    public $title;
    public $sub_title;
    public $description;
    public $image;
    public $price;
    public $link;
    public $status;
    public $newImage;
    public $slider_id;
    public function mount($slider_id)
    {
        $slider = HomeSlider::find($slider_id);
        if ($slider) {
            $this->slider_id = $slider_id;
            $this->title = $slider->title;
            $this->sub_title = $slider->sub_title;
            $this->description = $slider->description;
            $this->image = $slider->image;
            $this->price = $slider->price;
            $this->link = $slider->link;
            $this->status = $slider->status;
        } else {
            return redirect()->route('admin.home_sliders');
        }
    }

    public function updateHomeSlider()
    {
        $slider = HomeSlider::find($this->slider_id);
        $slider->title = $this->title;
        $slider->sub_title = $this->sub_title;
        $slider->description = $this->description;
        if ($this->newImage) {
            $imageName = "slider_" . Carbon::now()->timestamp . '.' . $this->newImage->extension();
            $this->newImage->storeAs('sliders', $imageName);
            $slider->image = $imageName;
        }
        $slider->price = $this->price;
        $slider->link = $this->link;
        $slider->status = $this->status;

        $slider->update();
        session()->flash('success_msg', 'Cập nhật thành công !');
    }
    public function render()
    {
        return view('livewire.admin.slider.admin-edit-slider-component')->layout("layouts.admin");
    }
}
