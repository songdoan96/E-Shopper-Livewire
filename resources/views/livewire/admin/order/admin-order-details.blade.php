<div>
  <div class="container-fluid">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-6">
            <ol class="breadcrumb bg-light m-0 p-0 align-items-center">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Chi tiết đơn hàng</li>
            </ol>
          </div>
          <div class="col-6">
            <a href="{{ route('admin.orders') }}" class="btn btn-success pull-right ">Đơn hàng</a>
          </div>
        </div>

      </div>
      <div class="card-body">
        <div class="table-responsive ">
          <table class="table table-striped table-bordered">
            <tr>
              <th>ID</th>
              <td>{{ $order->id }}</td>
              <th>Ngày mua</th>
              <td>{{ $order->created_at }}</td>
              <th>Trạng thái</th>
              <td>
                @if ($order->status == 'ordered')
                  Đang chờ xử lý
                @elseif($order->status == 'delivered')
                  Thành công
                @else
                  Đã hủy
                @endif
              </td>
              @if ($order->status == 'delivered')
                <th>Ngày giao</th>
                <td>{{ $order->delivered_date }}</td>
              @elseif($order->status == 'canceled')
                <th>Ngày hủy</th>
                <td>{{ $order->canceled_date }}</td>
              @endif

            </tr>
          </table>
        </div>
      </div>
    </div>



    <div class="row my-5">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h5>Sản phẩm</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive ">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr class="cart_menu">
                    <td>Hình ảnh</td>
                    <td class="image">Sản phẩm</td>
                    <td class="price">Giá</td>
                    <td class="quantity">Số lượng</td>
                    <td class="total">Thành tiền</td>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($order->orderItems as $item)
                    <tr>
                      <td class="cart_product">
                        <img src="{{ asset('assets/images/products/' . $item->product->image) }}"
                          alt="{{ $item->product->name }}" width="50">
                      </td>
                      <td class="cart_description">
                        <h4>{{ $item->product->name }}
                        </h4>
                      </td>
                      <td class="cart_price">
                        <p>{{ $item->product->price }}</p>
                      </td>
                      <td class="cart_quantity">
                        <div class="cart_quantity_button">

                          <p>{{ $item->quantity }}</p>
                        </div>
                      </td>
                      <td class="cart_total">
                        <p class="cart_total_price">{{ $item->price * $item->quantity }}</p>
                      </td>

                    </tr>
                  @endforeach

                </tbody>
              </table>

            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row my-5">

      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h5>Thành tiền</h5>
          </div>
          <div class="card-body">
            <ul class="list-group">
              <li class="list-group-item d-flex justify-content-between align-items-center">Giỏ hàng
                <span>{{ $order->cart_subtotal }}</span>
              </li>
              @if ($order->cart_subtotal != $order->subtotal)
                <li class="list-group-item d-flex justify-content-between align-items-center">Áp mã
                  ({{ $order->coupon_code }})
                  <span>{{ $order->subtotal }}</span>
                </li>
              @endif
              <li class="list-group-item d-flex justify-content-between align-items-center">Thuế
                <span>{{ $order->tax }}</span>
              </li>
              {{-- <li class="list-group-item d-flex justify-content-between align-items-center">Phí ship <span>Free</span>
              </li> --}}
              <li class="list-group-item d-flex justify-content-between align-items-center">Tổng cộng
                <span>{{ $order->total }}</span>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="row my-5">

      <div class="col-12">
        <div class="card">

          <div class="card-header">
            <h5>Địa chỉ giao hàng</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive ">
              <table class="table table-striped table-bordered">
                <tr>
                  <th>Họ tên</th>
                  <td>{{ $order->shipping->name }}</td>
                  <th>Email</th>
                  <td>{{ $order->shipping->email }}</td>
                </tr>
                <tr>
                  <th>SĐT</th>
                  <td>{{ $order->shipping->phone }}</td>
                  <th>Xã</th>
                  <td>{{ $order->shipping->line }}</td>
                </tr>
                <tr>
                  <th>Huyện</th>
                  <td>{{ $order->shipping->city }}</td>
                  <th>Tỉnh</th>
                  <td>{{ $order->shipping->province }}</td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
