<?php

namespace App\Http\Livewire\Admin\Brand;

use App\Models\Brand;
use Livewire\Component;

class AdminBrand extends Component
{
    public function deleteBrand($brand_id)
    {
        Brand::find($brand_id)->delete();
        session()->flash('success_msg', 'Đã xóa danh mục');
    }
    public function changeStatus($brand_id)
    {
        $cat = Brand::find($brand_id);
        $cat->status = $cat->status ? "0" : "1";
        $cat->save();
    }
    public function render()
    {
        $brands = Brand::all();
        return view('livewire.admin.brand.admin-brand', compact('brands'))->layout("layouts.admin");
    }
}
