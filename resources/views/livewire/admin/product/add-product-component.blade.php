<div class="container-fluid">
  <div class="row bg-light align-items-center">
    <div class="col-6">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Thêm sản phẩm</li>
        </ol>
      </nav>
    </div>
    <div class="col-6">
      <a href="{{ route('admin.products') }}" class="btn btn-success pull-right ">Sản phẩm</a>
    </div>
  </div>
  <div class="col-md-6 offset-3 my-5">
    <form wire:submit.prevent="addProduct">
      @if (Session::has('success_msg'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <strong>{{ Session::get('success_msg') }}</strong>
        </div>
      @endif

      <div class="form-group">
        <label for="name">Tên sản phẩm</label>
        <input type="text" name="name" wire:model="name" class="form-control" placeholder="Nhập tên sản phẩm">
        @error('name')<small class="form-text text-danger">{{ $message }}</small> @enderror
      </div>
      <div class="form-group" wire:ignore>
        <label for="desc">Mô tả sản phẩm</label>
        <input type="text" id="desc" name="desc" wire:model="desc" class="form-control" placeholder="Nhập mô tả">
        @error('desc')<small class="form-text text-danger">{{ $message }}</small> @enderror
      </div>
      <div class="form-group" wire:ignore>
        <label for="content">Nội dung sản phẩm</label>
        <input type="text" id="content" name="content" wire:model="content" class="form-control"
          placeholder="Nhập mô tả">
        @error('content')<small class="form-text text-danger">{{ $message }}</small> @enderror
      </div>
      <div class="form-group">
        <label for="price">Giá</label>
        <input type="number" name="price" wire:model="price" class="form-control" placeholder="Nhập giá">
        @error('price')<small class="form-text text-danger">{{ $message }}</small> @enderror
      </div>
      <div class="form-group">
        <label for="sale_price">Giá trước khi khuyến mãi</label>
        <input wire:change="$emit('show_exp_date')" type="number" name="sale_price" wire:model="sale_price"
          class="form-control" placeholder="Nhập giá">
        @error('sale_price')<small class="form-text text-danger">{{ $message }}</small> @enderror
      </div>
      @if ($sale_price)
        <div class="form-group">
          <label for="sale_exp_date">Ngày hết hạn sale</label>
          <input type="text" id='sale_exp_date' name="sale_exp_date" wire:model="sale_exp_date" class="form-control"
            autocomplete="off">
          @error('sale_exp_date')<small class="form-text text-danger">{{ $message }}</small> @enderror
        </div>
      @endif

      <div class="form-group">
        <label for="image">Hình ảnh</label>
        <input type="file" name="image" wire:model="image" class="form-control">
        @if ($image)
          <img src="{{ $image->temporaryUrl() }}" width="150">
        @endif
        @error('image')<small class="form-text text-danger">{{ $message }}</small> @enderror
      </div>
      <div class="form-group">
        <label for="images">Hình ảnh</label>
        <input type="file" name="images" wire:model="images" class="form-control" multiple>
        @if ($images)
          @foreach ($images as $image)
            <img src="{{ $image->temporaryUrl() }}" width="150">
          @endforeach
        @endif
        @error('images')<small class="form-text text-danger">{{ $message }}</small> @enderror
      </div>

      <div class="form-group">
        <label for="category_id">Danh mục</label>
        <select name="category_id" class="custom-select" wire:model="category_id">
          <option value="">== Chọn ==</option>
          @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
          @endforeach
        </select>
        @error('category_id')<small class="form-text text-danger">{{ $message }}</small> @enderror
      </div>
      <div class="form-group">
        <label for="brand_id">Thương hiệu</label>
        <select name="brand_id" class="custom-select" wire:model="brand_id">
          <option value="">== Chọn ==</option>
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
          <option value="">== Chọn ==</option>
          <option value="0">Không</option>
          <option value="1">Có</option>
        </select>
        @error('featured')<small class="form-text text-danger">{{ $message }}</small> @enderror
      </div>
      <div class="form-group">
        <label for="status">Hiển thị</label>
        <select name="status" class="custom-select" wire:model="status">
          <option value="">== Chọn ==</option>
          <option value="0">Ẩn</option>
          <option value="1">Hiện</option>
        </select>
        @error('status')<small class="form-text text-danger">{{ $message }}</small> @enderror
      </div>


      <button type="submit" class="btn btn-primary">Thêm</button>
    </form>

  </div>
</div>


@push('scripts')
  <script>
    $(document).ready(function() {
      tinymce.init({
        selector: '#desc',
        toolbar: 'undo redo | forecolor backcolor | styleselect | fontselect fontsizeselect bold italic | alignleft aligncenter alignright alignjustify | outdent indent',
        setup: function(editor) {
          editor.on('change', function(e) {
            tinyMCE.triggerSave();
            let sd_data = $('#desc').val();
            @this.set("desc", sd_data);
          });
        }
      });
      tinymce.init({
        selector: '#content',
        toolbar: 'undo redo | forecolor backcolor | styleselect | fontselect fontsizeselect bold italic | alignleft aligncenter alignright alignjustify | outdent indent',
        setup: function(editor) {
          editor.on('change', function(e) {
            tinyMCE.triggerSave();
            let d_data = $('#content').val();
            @this.set("content", d_data);
          });
        }
      });



      $("#sale_exp_date").flatpickr({
        enableTime: true,
        dateFormat: "Y-m-d H:i:ss",
        onChange: function(selectedDates, dateStr, instance) {
          @this.sale_exp_date = dateStr;
        },
      });

      Livewire.on('show_exp_date', () => {
        $("#sale_exp_date").flatpickr({
          enableTime: true,
          dateFormat: "Y-m-d H:i:ss",
          onChange: function(selectedDates, dateStr, instance) {
            @this.sale_exp_date = dateStr;
          },
        });
      })


    })
  </script>

@endpush
