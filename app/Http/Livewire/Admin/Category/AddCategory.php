<?php

namespace App\Http\Livewire\Admin\Category;

use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Str;

class AddCategory extends Component
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
        'name.required' => 'Vui lòng nhập tên danh mục',
        'name.unique' => 'Tên danh mục đã tồn tại',
    ];
    public function addCategory()
    {
        $this->validate([
            'name' => 'required|unique:categories',
        ]);
        $category = new Category();
        $category->name = $this->name;
        $category->slug = $this->generateSlug($this->name);
        $category->save();
        session()->flash('success_msg', 'Thêm danh mục ' . $this->name . ' thành công');
    }
    public function render()
    {
        return view('livewire.admin.category.add-category')->layout("layouts.admin");
    }
}
