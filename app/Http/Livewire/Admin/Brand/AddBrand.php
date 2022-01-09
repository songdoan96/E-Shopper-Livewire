<?php

namespace App\Http\Livewire\Admin\Brand;

use App\Models\Brand;
use Livewire\Component;
use Illuminate\Support\Str;

class AddBrand extends Component
{
    public $name;
    public function generateSlug($name)
    {
        return Str::slug($name);
    }
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required',
        ]);
    }
    protected $messages = [
        'name.required' => 'Vui lòng nhập tên thương hiệu',
        'name.unique' => 'Tên thương hiệu đã tồn tại',
    ];
    public function addBrand()
    {
        $this->validate([
            'name' => 'required|unique:categories',
        ]);
        $brand = new Brand();
        $brand->name = $this->name;
        $brand->slug = $this->generateSlug($this->name);
        $brand->save();
        session()->flash('success_msg', 'Thêm thương hiệu ' . $this->name . ' thành công');
    }
    public function render()
    {
        return view('livewire.admin.brand.add-brand')->layout("layouts.admin");
    }
}
