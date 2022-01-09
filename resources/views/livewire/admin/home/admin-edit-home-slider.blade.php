<div class="container-fluid">
  <div class="row bg-light align-items-center">
    <div class="col-6">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Danh mục trang chủ</li>
        </ol>
      </nav>
    </div>
    <div class="col-6">
      <a href="{{ route('admin.home_sliders') }}" class="btn btn-success pull-right ">Slider trang chủ</a>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-6 offset-sm-3 my-5">
      @if (Session::has('success_msg'))
        <div class="alert alert-success alert-dismissable">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
          {{ Session::get('success_msg') }}
        </div>
      @endif
      <form wire:submit.prevent="updateHomeSlider">
        <div class="form-group" wire:ignore>
          <label for="title">Tiêu đề</label>
          <input type="text" name="title" wire:model="title" class="form-control">
          @error('title')<small class="form-text text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="form-group" wire:ignore>
          <label for="sub_title">Tiêu đề phụ</label>
          <input type="text" name="sub_title" wire:model="sub_title" class="form-control">
          @error('sub_title')<small class="form-text text-danger">{{ $message }}</small> @enderror

        </div>
        <div class="form-group" wire:ignore>
          <label for="description">Mô tả</label>
          <input type="text" name="description" wire:model="description" class="form-control">
          @error('description')<small class="form-text text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="form-group">
          <label for="newImage">Hình ảnh</label>
          <input type="file" name="newImage" wire:model="newImage" class="form-control" placeholder="Nhập mô tả">
          @if ($newImage)
            <img src="{{ $newImage->temporaryUrl() }}" width="150">
          @else
            <img src="{{ asset('assets/images/sliders/' . $image) }}" alt="{{ $title }}" width="150">
          @endif
          @error('image')<small class="form-text text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="form-group" wire:ignore>
          <label for="price">Giá</label>
          <input type="number" name="price" wire:model="price" class="form-control">
          @error('price')<small class="form-text text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="form-group" wire:ignore>
          <label for="link">Link</label>
          <input type="text" name="link" wire:model="link" class="form-control">
          @error('link')<small class="form-text text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="form-group">
          <label for="status">Trạng thái</label>
          <select name="status" class="custom-select" wire:model="status">
            <option value="0">Ẩn</option>
            <option value="1">Hiện</option>
          </select>
          @error('status')<small class="form-text text-danger">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
      </form>
    </div>
  </div>
</div>
