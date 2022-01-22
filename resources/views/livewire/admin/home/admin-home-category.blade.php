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
  </div>
  <div class="row">
    <div class="col-sm-6 offset-sm-3">
      @if (Session::has('success_msg'))
        <div class="alert alert-success alert-dismissable">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
          {{ Session::get('success_msg') }}
        </div>
      @endif
      <form wire:submit.prevent="updateHomeCategory">
        <div class="form-group" wire:ignore>
          <label for="exampleInputEmail1">Chọn danh mục trang chủ</label>
          <select class="sel_categories form-control" name="categories[]" multiple="multiple"
            wire:model="sel_categories">
            @foreach ($categories as $cat)
              <option value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach
          </select>
        </div>

        <button type="submit" class="btn btn-primary">Thêm</button>
      </form>
    </div>
  </div>
</div>

@push('scripts')
  <script>
    $(document).ready(function() {
      $('.sel_categories').select2();
      $('.sel_categories').on('change', function(e) {
        @this.set('sel_categories', $(this).val());
      })
      Livewire.on('updateHomeCategory', () => {
        $('.sel_categories').select2();
        $('.sel_categories').on('change', function(e) {
          @this.set('sel_categories', $(this).val());
        })
      })
    });
  </script>
@endpush
