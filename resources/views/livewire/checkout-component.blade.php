 <div>
   <section id="cart_items">
     <div class="container">
       <form action="" wire:submit.prevent="placeOrder" style="padding-bottom: 2rem">

         <div class="breadcrumbs">
           <ol class="breadcrumb">
             <li><a href="#">Home</a></li>
             <li class="active">Thanh toán</li>
           </ol>
         </div>
         <!--/breadcrums-->


         <!--/checkout-options-->

         <div class="register-req">
           <p>Điền đầy đủ thông tin để tiến hành thanh toán</p>
         </div>
         <!--/register-req-->

         <div class="shopper-informations">
           <div class="row">
             <div class="col-sm-6 clearfix">
               <div class="bill-to">
                 <p>Địa chỉ thanh toán</p>
                 <div class="form-one" style="width: 100%">
                   <input type="text" wire:model="name" placeholder="Họ và tên *">
                   <input type="text" wire:model="phone" placeholder="Số điện thoại *">
                   <input type="text" wire:model="email" placeholder="Email">
                   <input type="text" wire:model="line" placeholder="Số nhà, thôn, xã *">
                   <input type="text" wire:model="city" placeholder="Huyện, thành phố *">
                   <input type="text" wire:model="province" placeholder="Tỉnh *">
                 </div>
               </div>
             </div>
             <div class="col-sm-6">
               <div class="order-message">
                 <p>Ghi chú</p>
                 <textarea name="message" placeholder="Thêm ghi chú cho đơn hàng" rows="16" style="height:290px;"
                   wire:model="note"></textarea>
               </div>
             </div>
           </div>
         </div>


         {{-- <div class="review-payment">
           <h2>Phương thức thanh toán</h2>
         </div> --}}

         {{-- <div class="payment-options"
           style="margin-top: 2rem;display: flex;justify-content: space-between;align-items: center;">
           <div>
             <span>
               <label><input disabled type="radio" name="payment-method" value="bank" wire:model="method"> Chuyển
                 khoản</label>
             </span>
             <span>
               <label><input disabled type="radio" name="payment-method" value="cod" wire:model="method"> Ship
                 Cod</label>
             </span>
             <span>
               <label><input selected type="radio" name="payment-method" value="money" wire:model="method"> Thanh toán
                 khi nhận
                 hàng</label>
             </span>
           </div>
          </div> --}}
         <button class="btn btn-lg btn-primary">Đặt hàng</button>
       </form>

     </div>
   </section>
 </div>
