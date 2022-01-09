<div class="container-fluid">
  <div class="row bg-light align-items-center">
    <div class="col-6">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Sửa danh mục sản phẩm</li>
        </ol>
      </nav>
    </div>
    <div class="col-6">
      <a href="{{ route('admin.categories') }}" class="btn btn-success pull-right ">Danh mục sản phẩm</a>
    </div>
  </div>
  <div class="col-md-6 offset-3 my-5">
    <form wire:submit.prevent="updateCategory">
      @if (Session::has('success_msg'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <strong>{{ Session::get('success_msg') }}</strong>
        </div>
      @endif

      <div class="form-group">
        <label for="name">Tên danh mục</label>
        <input type="text" id="name" wire:model="name" class="form-control" placeholder="Nhập tên danh mục">
        @error('name')<small class="form-text text-danger">{{ $message }}</small> @enderror
      </div>

      <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>

  </div>
</div>
