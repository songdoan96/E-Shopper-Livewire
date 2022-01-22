<?php

namespace App\Http\Livewire\Admin\Brand;

use App\Models\Brand;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class EditBrand extends Component
{
    use WithFileUploads;
    public $name;
    public $brand_id;
    public $newImage;
    public $image;

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required',
        ]);
    }
    protected $messages = [
        'name.required' => 'Vui lòng nhập tên thương hiệu',
    ];
    public function mount($brand_id)
    {
        $brand = Brand::find($brand_id);
        if ($brand) {
            $this->brand_id = $brand->id;
            $this->name = $brand->name;
            $this->image = $brand->logo;
        } else {
            return redirect()->route('admin.brands');
        }
    }
    public function updateBrand()
    {
        $this->validate([
            'name' => 'required',
        ]);
        $brand = Brand::find($this->brand_id);
        $brand->name = $this->name;
        $brand->slug = $this->generateSlug($this->name);
        if ($this->newImage) {
            $imageName = "brands_" . Carbon::now()->timestamp . '.' . $this->newImage->extension();
            $this->newImage->storeAs('brands', $imageName);
            $brand->image = $imageName;
        }
        $brand->save();
        session()->flash('success_msg', 'Cập nhật thành công');
    }
    public function generateSlug($name)
    {
        return Str::slug($name);
    }
    public function render()
    {
        return view('livewire.admin.brand.edit-brand')->layout("layouts.admin");
    }
}
