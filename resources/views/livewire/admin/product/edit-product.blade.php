<div class="container-fluid">
  <div class="row bg-light align-items-center">
    <div class="col-6">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Sửa sản phẩm</li>
        </ol>
      </nav>
    </div>
    <div class="col-6">
      <a href="{{ route('admin.products') }}" class="btn btn-success pull-right ">Sản phẩm</a>
    </div>
  </div>
  <div class="col-md-6 offset-3 my-5">
    @if (Session::has('success_msg'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <strong>{{ Session::get('success_msg') }}</strong>
      </div>
    @endif
    <form wire:submit.prevent="updateProduct">
      <div class="form-group">
        <label for="name">Tên sản phẩm</label>
        <input type="text" name="name" wire:model="name" class="form-control" placeholder="Nhập tên sản phẩm">
        @error('name')<small class="form-text text-danger">{{ $message }}</small> @enderror
      </div>
      <div class="form-group">
        <label for="desc">Mô tả sản phẩm</label>
        <input type="text" name="desc" wire:model="desc" class="form-control" placeholder="Nhập mô tả">
        @error('desc')<small class="form-text text-danger">{{ $message }}</small> @enderror
      </div>
      <div class="form-group">
        <label for="content">Nội dung sản phẩm</label>
        <input type="text" name="content" wire:model="content" class="form-control" placeholder="Nhập mô tả">
        @error('content')<small class="form-text text-danger">{{ $message }}</small> @enderror
      </div>
      <div class="form-group">
        <label for="price">Giá gốc</label>
        <input type="number" name="price" wire:model="price" class="form-control" placeholder="Nhập mô tả">
        @error('price')<small class="form-text text-danger">{{ $message }}</small> @enderror
      </div>
      <div class="form-group">
        <label for="sale_price">Giá khuyến mãi</label>
        <input type="number" name="sale_price" wire:model="sale_price" class="form-control" placeholder="Nhập mô tả">
        @error('sale_price')<small class="form-text text-danger">{{ $message }}</small> @enderror
      </div>
      <div class="form-group">
        <label for="newImage">Hình ảnh</label>
        <input type="file" name="newImage" wire:model="newImage" class="form-control">
        @if ($newImage)
          <div class="flex-center my-3">
            <img src="{{ $newImage->temporaryUrl() }}" width="150">
          </div>
        @else
          <img src="{{ asset('assets/images/products/' . $image) }}" width="150">
        @endif
        @error('newImage')<small class="form-text text-danger">{{ $message }}</small> @enderror
      </div>

      <div class="form-group">
        <label for="category_id">Danh mục</label>
        <select name="category_id" class="custom-select" wire:model="category_id">
          <option disabled>=== Chọn danh mục ===</option>
          @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
          @endforeach
        </select>
        @error('category_id')<small class="form-text text-danger">{{ $message }}</small> @enderror
      </div>
      <div class="form-group">
        <label for="brand_id">Thương hiệu</label>
        <select name="brand_id" class="custom-select" wire:model="brand_id">
          <option disabled>=== Chọn thương hiệu ===</option>
          @foreach ($brands as $brand)
            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
          @endforeach
        </select>
        @error('brand_id')<small class="form-text text-danger">{{ $message }}</small> @enderror
      </div>
      <div class="form-group">
        <label for="quantity">Số lượng</label>
        <input type="number" name="quantity" wire:model="quantity" class="form-control" placeholder="Nhập số lượng">
        @error('quantity')<small class="form-text text-danger">{{ $message }}</small> @enderror
      </div>
      <div class="form-group">
        <label for="featured">Nổi bật</label>
        <select name="featured" class="custom-select" wire:model="featured">
          <option value="0">Ẩn</option>
          <option value="1">Hiện</option>
        </select>
        @error('featured')<small class="form-text text-danger">{{ $message }}</small> @enderror
      </div>
      <div class="form-group">
        <label for="status">Trạng thái</label>
        <select name="status" class="custom-select" wire:model="status">
          <option disabled>=== Trạng thái ===</option>
          <option value="0">Ẩn</option>
          <option value="1">Hiện</option>
        </select>
        @error('status')<small class="form-text text-danger">{{ $message }}</small> @enderror
      </div>

      <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>

  </div>
</div>
