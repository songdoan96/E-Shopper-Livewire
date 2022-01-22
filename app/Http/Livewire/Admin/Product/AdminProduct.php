<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;


class AdminProduct extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function deleteProduct($id)
    {
        // Product::find($id)->delete();
        $product = Product::find($id);
        if ($product->image) {
            unlink('assets/images/products' . '/' . $product->image);
        }
        if ($product->images) {

            $images = explode("|", $product->images);
            foreach ($images as $image) {
                if ($image) {
                    unlink('assets/images/products' . '/' . $image);
                }
            }
        }
        $product->delete();
        session()->flash('success_msg', 'Đã xóa danh mục');
    }
    public function changeStatus($id)
    {
        $cat = Product::find($id);
        $cat->status = $cat->status ? "0" : "1";
        $cat->update();
    }

    public function changeFeatured($id)
    {
        $cat = Product::find($id);
        $cat->featured = $cat->featured ? "0" : "1";
        $cat->update();
    }
    public function render()
    {
        $products = Product::paginate(10);
        return view('livewire.admin.product.admin-product', compact('products'))->layout("layouts.admin");
    }
}
