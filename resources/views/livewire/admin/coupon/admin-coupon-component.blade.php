<div class="container-fluid">
  <div class="row bg-light align-items-center">
    <div class="col-6">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Mã giảm giá</li>
        </ol>
      </nav>
    </div>
    <div class="col-6">
      <a href="{{ route('admin.add_coupon') }}" class="btn btn-success pull-right ">Thêm mã</a>

    </div>
  </div>
  <div class="col-12 my-5">
    <div class="table-responsive">
      @if (Session::has('success_msg'))
        <div class="alert alert-success alert-dismissable">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
          {{ Session::get('success_msg') }}
        </div>
      @endif
      <table class="table table-striped table-bordered table-sm">
        <thead class="thead-dark">
          <tr>
            <th>STT</th>
            <th>Mã</th>
            <th>Loại</th>
            <th>Giá trị</th>
            <th>Giảm tối đa</th>
            <th>Ngày hết hạn</th>
            <th>Tùy chọn</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($coupons as $key => $coupon)
            <tr>
              <td>{{ ++$key }}</td>
              <td>{{ $coupon->code }}</td>
              <td>{{ $coupon->type }}</td>
              <td>
                {{ $coupon->value }} {{ $coupon->type == 'percent' ? '%' : 'đ' }}
              </td>
              <td>
                {{ $coupon->max_value }}
              </td>
              <td>{{ $coupon->exp_date }}</td>
              <td>
                <a href="{{ route('admin.edit_coupon', ['coupon_id' => $coupon->id]) }}"><i
                    class="fa fa-pencil-square-o fa-lg text-success mx-1" aria-hidden="true"></i></a>
                <a href="#" wire:click.prevent="deleteCoupon({{ $coupon->id }})"
                  onclick="confirm('Bạn có muốn xóa không ?')|| event.stopImmediatePropagation()">
                  <i class="fa fa-ban text-danger mx-1" aria-hidden="true"></i>
                </a>
              </td>
            </tr>
          @endforeach

        </tbody>
      </table>
    </div>
  </div>
</div>
