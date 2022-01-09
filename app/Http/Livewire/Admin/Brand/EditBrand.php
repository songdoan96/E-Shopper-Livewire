<?php

namespace App\Http\Livewire\Admin\Brand;

use App\Models\Brand;
use Livewire\Component;
use Illuminate\Support\Str;

class EditBrand extends Component
{
    public $name;
    public $brand_id;
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required|unique:brands',
        ]);
    }
    protected $messages = [
        'name.required' => 'Vui lòng nhập tên thương hiệu',
        'name.unique' => 'Tên thương hiệu đã tồn tại',
    ];
    public function mount($brand_id)
    {
        $brand = Brand::find($brand_id);
        if ($brand) {
            $this->brand_id = $brand->id;
            $this->name = $brand->name;
        } else {
            return redirect()->route('admin.brands');
        }
    }
    public function updateBrand()
    {
        $this->validate([
            'name' => 'required|unique:brands',
        ]);
        $brand = Brand::find($this->brand_id);
        $brand->name = $this->name;
        $brand->slug = $this->generateSlug($this->name);
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
