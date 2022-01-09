<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class EditProduct extends Component
{
    use WithFileUploads;

    public $product_id;

    public $name;
    public $desc;
    public $content;
    public $price;
    public $sale_price;
    public $image;
    public $newImage;
    public $category_id;
    public $brand_id;
    public $status;
    public $featured;
    public $quantity;

    protected $messages = [
        'name.required' => 'Vui lòng nhập tên sản phẩm',
        'name.unique' => 'Tên sản phẩm đã tồn tại',
        'price.required' => 'Vui lòng nhập giá sản phẩm',
        'price.required' => 'Vui lòng nhập giá sản phẩm',
        'sale_price.lte' => 'Giá khuyến mãi phải nhỏ hơn',
        'image.required' => 'Vui lòng chọn hình ảnh',
        'category_id.required' => 'Vui lòng chọn danh mục',
        'brand_id.required' => 'Vui lòng chọn thương hiệu',
        'status.required' => 'Vui lòng chọn trạng thái',
    ];
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required',
            'price' => 'required|numeric',
            'sale_price' => 'numeric|lte:price',
            'category_id' => 'required',
            'brand_id' => 'required',
            'status' => 'required',
        ]);
    }

    public function mount($product_id)
    {
        $product = Product::find($product_id);
        if ($product) {
            $this->product_id = $product->id;
            $this->name = $product->name;
            $this->desc = $product->desc;
            $this->content = $product->content;
            $this->price = $product->price;
            $this->sale_price = $product->sale_price;
            $this->image = $product->image;
            $this->status = $product->status;
            $this->category_id = $product->category_id;
            $this->brand_id = $product->brand_id;
            $this->quantity = $product->quantity;
            $this->featured = $product->featured;
        } else {
            return redirect()->route('admin.products');
        }
    }
    public function updateProduct()
    {
        $this->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'sale_price' => 'numeric|lte:price',
            'category_id' => 'required',
            'brand_id' => 'required',
            'status' => 'required',
        ]);
        $product = Product::find($this->product_id);
        $product->name = $this->name;
        $product->desc = $this->desc;
        $product->content = $this->content;
        $product->price = $this->price;
        if ($this->sale_price) {
            $product->sale_price = $this->sale_price;
        }

        if ($this->newImage) {
            $imageName = "digital_" . Carbon::now()->timestamp . '.' . $this->newImage->extension();
            $this->newImage->storeAs('products', $imageName);
            $product->image = $imageName;
        }

        $product->category_id = $this->category_id;
        $product->brand_id = $this->brand_id;
        $product->status = $this->status;
        $product->quantity = $this->quantity;
        $product->featured = $this->featured;
        $product->update();
        session()->flash('success_msg', 'Cập nhật thành công');
    }
    public function generateSlug($name)
    {
        return Str::slug($name);
    }


    public function render()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('livewire.admin.product.edit-product', compact('categories', 'brands'))->layout("layouts.admin");
    }
}
