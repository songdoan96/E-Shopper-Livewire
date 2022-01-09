<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;


class AdminProduct extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function deleteProduct($cat_id)
    {
        Product::find($cat_id)->delete();
        session()->flash('success_msg', 'Đã xóa danh mục');
    }
    public function changeStatus($cat_id)
    {
        $cat = Product::find($cat_id);
        $cat->status = $cat->status ? "0" : "1";
        $cat->update();
    }

    public function changeFeatured($cat_id)
    {
        $cat = Product::find($cat_id);
        $cat->featured = $cat->featured ? "0" : "1";
        $cat->update();
    }
    public function render()
    {
        $products = Product::paginate(10);
        return view('livewire.admin.product.admin-product', compact('products'))->layout("layouts.admin");
    }
}
