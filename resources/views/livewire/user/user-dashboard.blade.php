<div class="content">
  <style>
    .content {
      padding-top: 40px;
      padding-bottom: 40px;
    }

    .icon-stat {
      display: block;
      overflow: hidden;
      position: relative;
      padding: 15px;
      margin-bottom: 1em;
      background-color: #fff;
      border-radius: 4px;
      border: 1px solid #ddd;
    }

    .icon-stat-label {
      display: block;
      color: #999;
      font-size: 13px;
    }

    .icon-stat-value {
      display: block;
      font-size: 28px;
      font-weight: 600;
    }

    .icon-stat-visual {
      position: relative;
      top: 22px;
      display: inline-block;
      width: 32px;
      height: 32px;
      border-radius: 4px;
      text-align: center;
      font-size: 16px;
      line-height: 30px;
    }

    .bg-primary {
      color: #fff;
      background: #d74b4b;
    }

    .bg-secondary {
      color: #fff;
      background: #6685a4;
    }

    .icon-stat-footer {
      padding: 10px 0 0;
      margin-top: 10px;
      color: #aaa;
      font-size: 12px;
      border-top: 1px solid #eee;
    }

  </style>
  <div class="container">
    <div class="row">
      <div class="col-md-3 col-sm-6">
        <div class="icon-stat">
          <div class="row">
            <div class="col-xs-8 text-left">
              <span class="icon-stat-label">Đã mua</span>
              <span class="icon-stat-value">{{ $totalCost }}</span>
            </div>
            <div class="col-xs-4 text-center">
              <i class="fa fa-dollar icon-stat-visual bg-primary"></i>
            </div>
          </div>

        </div>
      </div>
      <div class="col-md-3 col-sm-6">
        <div class="icon-stat">
          <div class="row">
            <div class="col-xs-8 text-left">
              <span class="icon-stat-label">Số lần mua</span>
              <span class="icon-stat-value">{{ $totalPurchase }}</span>
            </div>
            <div class="col-xs-4 text-center">
              <i class="fa fa-gift icon-stat-visual bg-secondary"></i>
            </div>
          </div>

        </div>
      </div>
      <div class="col-md-3 col-sm-6">
        <div class="icon-stat">
          <div class="row">
            <div class="col-xs-8 text-left">
              <span class="icon-stat-label">Số đơn thành công</span>
              <span class="icon-stat-value">{{ $totalDelivered }}</span>
            </div>
            <div class="col-xs-4 text-center">
              <i class="fa fa-dollar icon-stat-visual bg-primary"></i>
            </div>
          </div>

        </div>
      </div>
      <div class="col-md-3 col-sm-6">
        <div class="icon-stat">
          <div class="row">
            <div class="col-xs-8 text-left">
              <span class="icon-stat-label">Số đơn đã hủy</span>
              <span class="icon-stat-value">{{ $totalCanceled }}</span>
            </div>
            <div class="col-xs-4 text-center">
              <i class="fa fa-gift icon-stat-visual bg-secondary"></i>
            </div>
          </div>

        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Đơn hàng mới nhất</h4>
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
                          href="{{ route('user.orders_details', ['order_id' => $order->id]) }}">Chi
                          tiết</a>
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
  </div>
</div>
