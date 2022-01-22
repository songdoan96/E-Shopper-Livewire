<div>
  <div class="container">

    <div class="row">
      @if (Session::has('success_msg'))
        <div class="alert alert-success alert-dismissable">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
          {{ Session::get('success_msg') }}
        </div>
      @endif
      <div class="panel panel-default">
        <div class="panel-heading d-flex justify-content-between align-items-center">
          <ol class="breadcrumb m-0">
            <li><a href="#">Trang chủ</a></li>
            <li class="active">Chi tiết đơn hàng</li>
          </ol>
          <div class="">
            @if ($order->status == 'ordered')
              <a href="#" class="btn btn-warning mx-4" wire:click.prevent="cancelOrder">Hủy đơn</a>
            @endif
            <a href="{{ route('user.orders') }}" class="btn btn-success pull-right ">Đơn hàng</a>
          </div>
        </div>
        <div class="panel-body">
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
    </div>

    <div class="row">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h5>Sản phẩm</h5>
        </div>
        <div class="panel-body">
          <div class="table-responsive ">
            <table class="table table-striped table-bordered">
              <thead>
                <tr class="">
                  <td>Hình ảnh</td>
                  <td>Sản phẩm</td>
                  <td>Giá</td>
                  <td>Số lượng</td>
                  <td>Thành tiền</td>

                </tr>
              </thead>
              <tbody>
                @foreach ($order->orderItems as $item)
                  <tr>
                    <td>
                      <img src="{{ asset('assets/images/products/' . $item->product->image) }}"
                        alt="{{ $item->product->name }}" width="50">
                    </td>
                    <td>
                      <h4>{{ $item->product->name }}
                      </h4>
                    </td>
                    <td>
                      <p>{{ $item->product->price }}</p>
                    </td>
                    <td>
                      <div>

                        <p>{{ $item->quantity }}</p>
                      </div>
                    </td>
                    <td>
                      <p class="cart_total_price">{{ $item->price * $item->quantity }}</p>
                    </td>
                    @if ($order->status == 'delivered' && $item->r_status == 0)
                      <td>
                        <a href="{{ route('user.reviews', ['order_item_id' => $item->id]) }}"
                          class="btn btn-primary m-0">Đánh giá</a>
                      </td>
                    @endif

                  </tr>
                @endforeach

              </tbody>
            </table>

          </div>
        </div>

      </div>
    </div>

    <div class="row">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h5>Thành tiền</h5>
        </div>
        <div class="panel-body">
          <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center">Giỏ hàng
              <span>{{ $order->subtotal }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">Thuế
              <span>{{ $order->tax }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">Phí ship <span>Free</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">Tổng cộng
              <span>{{ $order->total }}</span>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h5>Địa chỉ giao hàng</h5>

        </div>
        <div class="panel-body">
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
