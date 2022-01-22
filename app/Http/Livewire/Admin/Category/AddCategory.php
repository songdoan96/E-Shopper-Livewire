<?php

namespace App\Http\Livewire\Admin\Category;

use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Str;

class AddCategory extends Component
{
    public $name;
    public $status;
    public function generateSlug($name)
    {
        return Str::slug($name);
    }
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required|unique:categories',
            'status' => 'required'
        ]);
    }
    protected $messages = [
        'name.required' => 'Vui lòng nhập tên danh mục',
        'status.required' => 'Vui lòng chọn trạng thái',
        'name.unique' => 'Tên danh mục đã tồn tại',
    ];
    public function addCategory()
    {
        $this->validate([
            'name' => 'required|unique:categories',
            'status' => 'required'
        ]);
        $category = new Category();
        $category->name = $this->name;
        $category->status = $this->status;
        $category->slug = $this->generateSlug($this->name);
        $category->save();
        session()->flash('success_msg', 'Thêm danh mục ' . $this->name . ' thành công');
        $this->reset('name');
    }
    public function render()
    {
        return view('livewire.admin.category.add-category')->layout("layouts.admin");
    }
}
