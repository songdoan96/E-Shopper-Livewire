<?php

namespace App\Http\Livewire\Admin\Category;

use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Str;

class EditCategory extends Component
{
    public $name;
    public $cat_id;
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required|unique:categories',
        ]);
    }
    protected $messages = [
        'name.required' => 'Vui lòng nhập tên danh mục',
        'name.unique' => 'Tên danh mục đã tồn tại',
    ];
    public function mount($cat_id)
    {
        $cat = Category::find($cat_id);
        if ($cat) {
            $this->cat_id = $cat->id;
            $this->name = $cat->name;
        } else {
            return redirect()->route('admin.categories');
        }
    }
    public function updateCategory()
    {
        $this->validate([
            'name' => 'required|unique:categories',
        ]);
        $cat = Category::find($this->cat_id);
        $cat->name = $this->name;
        $cat->slug = $this->generateSlug($this->name);
        $cat->save();
        session()->flash('success_msg', 'Cập nhật thành công');
    }
    public function generateSlug($name)
    {
        return Str::slug($name);
    }

    public function render()
    {
        return view('livewire.admin.category.edit-category')->layout("layouts.admin");
    }
}
