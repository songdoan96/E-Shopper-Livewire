 <div>
   @if (Cart::instance('cart')->count() > 0)
     <section id="cart_items">

       <div class="container">
         <div class="breadcrumbs">
           <ol class="breadcrumb">
             <li><a href="/">Home</a></li>
             <li class="active">Giỏ hàng</li>
           </ol>
         </div>
         <div class="table-responsive cart_info">

           <table class="table table-condensed">
             <thead>
               <tr class="cart_menu">
                 <td>Hình ảnh</td>
                 <td class="image">Sản phẩm</td>
                 <td class="price">Giá</td>
                 <td class="quantity">Số lượng</td>
                 <td class="total">Thành tiền</td>
                 <td></td>
               </tr>
             </thead>
             <tbody>
               @foreach (Cart::instance('cart')->content() as $row)
                 <tr>
                   <td class="cart_product">
                     <a href="{{ route('product.details', ['product_slug' => $row->model->slug]) }}"><img
                         src="{{ asset('assets/images/products/' . $row->model->image) }}" alt="{{ $row->name }}"
                         width="50"></a>
                   </td>
                   <td class="cart_description">
                     <h4><a
                         href="{{ route('product.details', ['product_slug' => $row->model->slug]) }}">{{ $row->name }}</a>
                     </h4>
                     <p>Mã SP: {{ $row->model->id }}</p>
                   </td>
                   <td class="cart_price">
                     <p>{{ number_format($row->price, 0, ',', '.') }} đ</p>
                   </td>
                   <td class="cart_quantity">
                     <div class="cart_quantity_button">
                       <a class="cart_quantity_up" href="#" wire:click.prevent="increaseQty('{{ $row->rowId }}')">
                         + </a>
                       <input class="cart_quantity_input" type="text" name="quantity" value="{{ $row->qty }}"
                         autocomplete="off" size="2" disabled>
                       <a class="cart_quantity_down" href="#" wire:click.prevent="decreaseQty('{{ $row->rowId }}')">
                         -
                       </a>
                     </div>
                   </td>
                   <td class="cart_total">
                     <p class="cart_total_price">{{ $row->subtotal() }}</p>
                   </td>
                   <td class="cart_delete">
                     <a href="#" wire:click.prevent='saveForLater("{{ $row->rowId }}")'><i
                         class="fa fa-save"></i></a>
                     <a class="cart_quantity_delete" href="#"
                       wire:click.prevent="removeCartItem('{{ $row->rowId }}')"><i class="fa fa-times"></i></a>
                   </td>
                 </tr>
               @endforeach
             </tbody>
           </table>

         </div>
       </div>
     </section>
     <!--cart_items-->

     <section id="do_action">
       <div class="container">
         <div class="heading">
           <h3>Chi tiết giỏ hàng</h3>
           <p>Áp dụng mã giảm giá (nếu có) để tiếp tục</p>
         </div>
         <div class="row">

           <div class="col-sm-12">
             <div class="total_area">
               <ul>
                 <li>Tổng tiền <span>{{ Cart::instance('cart')->subtotal() }}</span></li>
                 @if (Session::has('coupon'))
                   <li>Mã giảm ({{ Session::get('coupon')['code'] }})
                     <a href="#" wire:click.prevent="deleteCoupon"><i class="fa fa-times text-danger"
                         aria-hidden="true"></i></a>
                     <span>{{ $discount }}</span>
                   </li>
                   <li>Sau khi áp mã <span>{{ $subtotalAfterDiscount }}</span>
                   </li>
                   <li>Thuế <span>{{ $taxAfterDiscount }}</span>
                   </li>
                   <li>Tổng cộng <span>{{ $totalAfterDiscount }}</span>
                   </li>

                 @else
                   <li>Thuế <span>{{ Cart::instance('cart')->tax() }}</span></li>
                   {{-- <li>Phí ship <span>Free</span></li> --}}
                   <li>Tổng cộng <span>{{ Cart::instance('cart')->total() }}</span></li>
                 @endif

                 @if (!Session::has('coupon'))
                   <li>
                     <div class="row">
                       <div class="col-sm-2">
                         <input type="checkbox" name="haveCoupon" wire:model="haveCoupon">
                         <label for="haveCoupon">Mã giảm giá</label>
                       </div>
                       @if ($haveCoupon)
                         <div class="col-sm-3">
                           <form wire:submit.prevent="applyCouponCode">
                             <div class="form-group">
                               <input type="text" class="form-control" wire:model="code" placeholder="Nhập mã">
                             </div>
                             <button type="submit" class="btn btn-success">Áp dụng</button>
                           </form>
                         </div>
                       @endif
                       @if (Session::has('error_msg'))
                         <div class="col-sm-5">
                           <div class="alert alert-danger alert-dismissable">
                             <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                             {{ Session::get('error_msg') }}
                           </div>
                         </div>
                       @endif

                     </div>
                   </li>
                 @endif
               </ul>

               <a class="btn btn-default update" href="#" wire:click.prevent="checkout">Thanh toán</a>
             </div>

           </div>
         </div>
     </section>
     <!--/#do_action-->
   @else
     <div class="text-center" style="padding:150px 0 200px 0">
       <p><i class="fa fa-ban fa-3x text-danger" aria-hidden="true"></i></p>
       <h3 class="text-danger">Giỏ hàng trống</h3>
       <a href="/" class="btn btn-success">Thêm sản phẩm vào giỏ hàng</a>
     </div>
   @endif



   @if (Cart::instance('saveForLater')->count() > 0)
     <section id="cart_items">
       <div class="container">
         <h3>Sản phẩm đã lưu</h3>
         <div class="table-responsive cart_info">
           <table class="table table-condensed">
             <thead>
               <tr class="cart_menu">
                 <td>Hình ảnh</td>
                 <td class="image">Sản phẩm</td>
                 <td class="price">Giá</td>
                 <td></td>
                 <td></td>
               </tr>
             </thead>
             <tbody>
               @foreach (Cart::instance('saveForLater')->content() as $row)
                 <tr>
                   <td class="cart_product">
                     <a href="{{ route('product.details', ['product_slug' => $row->model->slug]) }}"><img
                         src="{{ asset('assets/images/products/' . $row->model->image) }}" alt="{{ $row->name }}"
                         width="50"></a>
                   </td>
                   <td class="cart_description">
                     <h4><a
                         href="{{ route('product.details', ['product_slug' => $row->model->slug]) }}">{{ $row->name }}</a>
                     </h4>
                     <p>Mã SP: {{ $row->model->id }}</p>
                   </td>
                   <td class="cart_price">
                     <p>{{ number_format($row->price, 0, ',', '.') }} đ</p>
                   </td>
                   <td class="">
                     <a href="#" class="btn btn-info" wire:click.prevent="moveToCart('{{ $row->rowId }}')">Thêm
                       vào giỏ hàng</a>
                   </td>
                   <td class="cart_delete">
                     <a class="cart_quantity_delete" href="#"
                       wire:click.prevent="removeItemSaveForLater('{{ $row->rowId }}')"><i
                         class="fa fa-times"></i></a>
                   </td>
                 </tr>
               @endforeach
             </tbody>
           </table>
         </div>
       </div>
     </section>
   @endif

 </div>
