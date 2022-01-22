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
      <a href="{{ route('admin.coupons') }}" class="btn btn-success pull-right ">Mã giảm giá</a>
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
      <form wire:submit.prevent="addCoupon">
        <div class="form-group">
          <label for="code">Mã</label>
          <input type="text" name="code" wire:model="code" class="form-control">
          @error('code')<small class="form-text text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="form-group">
          <label for="type">Loại mã</label>
          <select name="type" class="custom-select" wire:model="type">
            <option value="percent" selected>Phần trăm</option>
            <option value="fixed">Trừ thẳng</option>
          </select>
          @error('type')<small class="form-text text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="form-group">
          <label for="value">Giá trị</label>
          <input type="text" name="value" wire:model="value" class="form-control">
          @error('value')<small class="form-text text-danger">{{ $message }}</small> @enderror

        </div>
        <div class="form-group">
          <label for="max_value">Giảm tối đa</label>
          <input type="text" name="max_value" wire:model="max_value" class="form-control">
          @error('max_value')<small class="form-text text-danger">{{ $message }}</small> @enderror

        </div>
        <div class="form-group">
          <label for="exp_date">Ngày hết hạn</label>
          <input type="text" id='exp_date' name="exp_date" wire:model="exp_date" class="form-control"
            autocomplete="off">
          @error('exp_date')<small class="form-text text-danger">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Thêm</button>
      </form>
    </div>
  </div>
</div>

@push('scripts')
  <script type="text/javascript">
    $(function() {
      $("#exp_date").flatpickr({
        enableTime: true,
        dateFormat: "Y-m-d H:i:ss",
        onChange: function(selectedDates, dateStr, instance) {
          @this.exp_date = dateStr;
          console.log(dateStr)
        },
      });
    });
  </script>
@endpush
