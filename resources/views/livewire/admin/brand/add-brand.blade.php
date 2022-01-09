<div class="container-fluid">
  <div class="row bg-light align-items-center">
    <div class="col-6">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Thêm thương hiệu sản phẩm</li>
        </ol>
      </nav>
    </div>
    <div class="col-6">
      <a href="{{ route('admin.brands') }}" class="btn btn-success pull-right ">Thương hiệu sản phẩm</a>
    </div>
  </div>
  <div class="col-md-6 offset-3 my-5">
    <form wire:submit.prevent="addBrand">
      @if (Session::has('success_msg'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <strong>{{ Session::get('success_msg') }}</strong>
        </div>
      @endif

      <div class="form-group">
        <label for="name">Tên thương hiệu</label>
        <input type="text" id="name" name="name" wire:model="name" class="form-control"
          placeholder="Nhập tên thương hiệu">
        @error('name')<small class="form-text text-danger">{{ $message }}</small> @enderror
      </div>
      {{-- <div class="form-group">
      <label for="slug">Tên danh mục</label>
      <input type="text" id="slug" name="slug" class="form-control" placeholder="Nhập tên danh mục">
      <small class="form-text text-danger">eror</small>
    </div> --}}

      <button type="submit" class="btn btn-primary">Thêm</button>
    </form>

  </div>
</div>
