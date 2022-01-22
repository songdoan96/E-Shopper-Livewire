<div>
  <div class="container-fluid">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-6">
            <ol class="breadcrumb bg-light m-0 p-0 align-items-center">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Đơn hàng</li>
            </ol>
          </div>
        </div>

      </div>
      <div class="card-body">
        <div class="table-responsive ">
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>STT</th>
                <th>Họ tên</th>
                <th>Email</th>
                <th>SĐT</th>
                <th>Tỉnh</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Ngày mua</th>
                <th>Ghi chú</th>
                <th>Chi tiết</th>
                <th>Trạng thái</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($orders as $key => $order)
                <tr>
                  <td>{{ ++$key }}</td>
                  <td>{{ $order->shipping->name }}</td>
                  <td>{{ $order->shipping->email }}</td>
                  <td>{{ $order->shipping->phone }}</td>
                  <td>{{ $order->shipping->province }}</td>
                  <td>{{ $order->total }}</td>
                  <td>
                    @if ($order->status == 'ordered')
                      Yêu cầu
                    @elseif($order->status == 'delivered')
                      Thành công
                    @else
                      Hủy
                    @endif
                  </td>
                  <td>
                    @if ($order->status == 'ordered')
                      {{ $order->created_at }}
                    @elseif($order->status == 'delivered')
                      {{ $order->delivered_date }}
                    @else
                      {{ $order->canceled_date }}
                    @endif
                  </td>

                  <td>{{ $order->shipping->note }}</td>
                  <td>
                    <a class="btn btn-info btn-sm"
                      href="{{ route('admin.orders_details', ['order_id' => $order->id]) }}">Chi
                      tiết</a>
                  </td>
                  <td>
                    <div class="dropdown">
                      <button class="btn btn-secondary dropdown-toggle" type="button" id="order_actions"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Trạng thái
                      </button>
                      <div class="dropdown-menu" aria-labelledby="order_actions">
                        <a class="dropdown-item" href="#"
                          wire:click.prevent="changeStatusOrder({{ $order->id }},'delivered')">Thành công</a>
                        <a class="dropdown-item" href="#"
                          wire:click.prevent="changeStatusOrder({{ $order->id }},'canceled')">Hủy</a>
                      </div>
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          <style>
            nav svg {
              height: 25px;
              width: 25px;
            }

          </style>
          {{ $orders->links() }}

        </div>
      </div>
    </div>




  </div>
</div>
