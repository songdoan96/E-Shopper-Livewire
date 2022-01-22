 <div>
   <section id="cart_items">
     <div class="container">
       <div class="breadcrumbs">
         <ol class="breadcrumb">
           <li><a href="/">Home</a></li>
           <li class="active">Đơn hàng</li>
         </ol>
       </div>
       @if (count($orders) > 0)
         <div class="table-responsive cart_info">
           <table class="table table-condensed">
             <thead>
               <tr class="cart_menu">
                 <td>STT</td>
                 <td>Họ tên</td>
                 <td>Email</td>
                 <td>SĐT</td>
                 <td>Xã, phường</td>
                 <td>Thành phố</td>
                 <td>Tỉnh</td>
                 <td>Tổng tiền</td>
                 <td>Trạng thái</td>
                 <td>Ngày mua</td>
                 <td>Ghi chú</td>
                 <td></td>
               </tr>
             </thead>
             <tbody>
               @foreach ($orders as $key => $order)
                 <tr>
                   <td>{{ ++$key }}</td>
                   <td>{{ $order->shipping->name }}</td>
                   <td>{{ $order->shipping->email }}</td>
                   <td>{{ $order->shipping->phone }}</td>
                   <td>{{ $order->shipping->line }}</td>
                   <td>{{ $order->shipping->city }}</td>
                   <td>{{ $order->shipping->province }}</td>
                   <td>{{ $order->total }}</td>
                   <td>
                     @if ($order->status == 'ordered')
                       Đang xử lý
                     @elseif($order->status == 'delivered')
                       Thành công
                     @else
                       Hủy
                     @endif
                   </td>
                   <td>{{ $order->created_at }}</td>
                   <td>{{ $order->shipping->note }}</td>
                   <td><a class="btn btn-info"
                       href="{{ route('user.orders_details', ['order_id' => $order->id]) }}">Chi tiết</a></td>
                 </tr>
               @endforeach
             </tbody>
           </table>
           {{ $orders->links() }}
         </div>
       @else
         <div class="text-center" style="padding:0 0 50px">
           <p><i class="fa fa-ban fa-3x text-danger" aria-hidden="true"></i></p>
           <h3 class="text-danger">Không tìm thấy đơn hàng</h3>
           <a href="/shop" class="btn btn-success">Thêm sản phẩm vào giỏ hàng</a>
         </div>
       @endif
     </div>
   </section>
   <!--cart_items-->



 </div>
