<?php

namespace App\Http\Livewire\Admin\Category;

use App\Models\Category;
use Livewire\Component;

class AdminCategory extends Component
{
    public function deleteCategory($cat_id)
    {
        Category::find($cat_id)->delete();
        session()->flash('success_msg', 'Đã xóa danh mục');
    }
    public function changeStatus($cat_id)
    {
        $cat = Category::find($cat_id);
        $cat->status = $cat->status ? "0" : "1";
        $cat->save();
    }
    public function render()
    {
        $categories = Category::all();
        return view('livewire.admin.category.admin-category', compact('categories'))->layout("layouts.admin");
    }
}
