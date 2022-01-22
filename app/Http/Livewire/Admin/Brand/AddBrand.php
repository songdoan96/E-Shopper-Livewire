<?php

namespace App\Http\Livewire\Admin\Brand;

use App\Models\Brand;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class AddBrand extends Component
{
    use WithFileUploads;
    public $name;
    public $image;
    public $status;
    public function generateSlug($name)
    {
        return Str::slug($name);
    }
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required|unique:brands',
            'status' => 'required',
        ]);
    }
    protected $messages = [
        'name.required' => 'Vui lòng nhập tên thương hiệu',
        'status.required' => 'Vui lòng chọn trạng thái',
        'name.unique' => 'Tên thương hiệu đã tồn tại',
    ];
    public function addBrand()
    {
        $this->validate([
            'name' => 'required|unique:brands',
            'status' => 'required',
        ]);
        $brand = new Brand();
        $brand->name = $this->name;
        $brand->status = $this->status;
        $brand->slug = $this->generateSlug($this->name);
        if ($this->image) {
            # code...
            $imageName = "brands_" . Carbon::now()->timestamp . '.' . $this->image->extension();
            $this->image->storeAs('brands', $imageName);
            $brand->logo = $imageName;
        }
        $brand->save();
        session()->flash('success_msg', 'Thêm thương hiệu ' . $this->name . ' thành công');
        $this->reset('name');
    }
    public function render()
    {
        return view('livewire.admin.brand.add-brand')->layout("layouts.admin");
    }
}
