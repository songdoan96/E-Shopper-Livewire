<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class AddProduct extends Component
{
    use WithFileUploads;
    public $name;
    public $desc;
    public $content;
    public $price;
    public $sale_price;
    public $image;
    public $category_id;
    public $brand_id;
    public $status;
    public $featured;
    public $quantity;

    public function generateSlug($name)
    {
        return Str::slug($name);
    }
    protected $messages = [
        'name.required' => 'Vui lòng nhập tên sản phẩm',
        'name.unique' => 'Tên sản phẩm đã tồn tại',
        'price.required' => 'Vui lòng nhập giá sản phẩm',
        'price.required' => 'Vui lòng nhập giá sản phẩm',
        'sale_price.lte' => 'Giá khuyến mãi phải nhỏ hơn',
        'image.required' => 'Vui lòng chọn hình ảnh',
        'category_id.required' => 'Vui lòng chọn danh mục',
        'category_id.numeric' => 'Vui lòng chọn danh mục',
        'brand_id.required' => 'Vui lòng chọn thương hiệu',
        'brand_id.numeric' => 'Vui lòng chọn thương hiệu',
        'status.required' => 'Vui lòng chọn trạng thái',
        'quantity.required' => 'Vui lòng nhập số lượng',
    ];
    public function updated($field)
    {
        $this->validateOnly($field, [
            'name' => 'required|unique:products',
            'price' => 'required|numeric',
            'sale_price' => 'numeric|lte:price',
            'image' => 'required',
            'category_id' => 'required|numeric',
            'brand_id' => 'required|numeric',
            'status' => 'required',
            'quantity' => 'required|numeric',
        ]);
    }

    public function addProduct()
    {
        $this->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'sale_price' => 'numeric|lte:price',
            'image' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',
            'status' => 'required',
            'quantity' => 'required|numeric',
        ]);
        $product = new Product();
        $product->name = $this->name;
        $product->slug = $this->generateSlug($this->name);
        $product->desc = $this->desc;
        $product->content = $this->content;
        $product->price = $this->price;
        $product->sale_price = $this->sale_price;
        $product->category_id = $this->category_id;
        $product->brand_id = $this->brand_id;
        $product->status = $this->status;
        $product->featured = $this->featured;
        $product->quantity = $this->quantity;
        $imageName = "digital_" . Carbon::now()->timestamp . '.' . $this->image->extension();
        $this->image->storeAs('products', $imageName);
        $product->image = $imageName;
        $product->save();
        session()->flash('success_msg', 'Thêm danh mục ' . $this->name . ' thành công');
    }

    public function render()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('livewire.admin.product.add-product', compact('categories', 'brands'))->layout("layouts.admin");
    }
}
