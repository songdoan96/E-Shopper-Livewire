<div>
  <div id="contact-page" class="container">
    <div class="bg">
      <div class="row">
        <div class="col-sm-12">
          <h2 class="title text-center">Liên hệ</strong></h2>
          <div id="gmap" class="contact-map">
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d875.5532591804163!2d107.15781144339238!3d16.817554150808654!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3140e437016c4351%3A0xbe8cc3a310224508!2zMTbCsDQ5JzAzLjQiTiAxMDfCsDA5JzI3LjIiRQ!5e0!3m2!1svi!2s!4v1642690008033!5m2!1svi!2s"
              style="border:0;width: 100%; height: 100%" allowfullscreen="true" loading="lazy"></iframe>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <div class="contact-form">
            <h2 class="title text-center">Thông tin liên lạc</h2>
            <div class="status alert alert-success" style="display: none"></div>
            <form id="main-contact-form" class="contact-form row" name="contact-form" wire:submit.prevent="sendMessage">
              @if (Session::has('success_msg'))
                <div class="alert alert-success alert-dismissable">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                  {{ Session::get('success_msg') }}
                </div>
              @endif
              <div class="form-group col-md-12">
                <input wire:model="name" type="text" name="name" class="form-control" required="required"
                  placeholder="Họ tên">
                @error('name')<small class="form-text text-danger">{{ $message }}</small> @enderror

              </div>
              <div class="form-group col-md-12">
                <input wire:model="email" type="email" name="email" class="form-control" required="required"
                  placeholder="Email">
                @error('email')<small class="form-text text-danger">{{ $message }}</small> @enderror

              </div>
              <div class="form-group col-md-12">
                <input wire:model="phone" type="text" name="phone" class="form-control" required="required"
                  placeholder="SĐT">
                @error('phone')<small class="form-text text-danger">{{ $message }}</small> @enderror

              </div>
              <div class="form-group col-md-12">
                <textarea wire:model="comment" name="comment" id="message" required="required" class="form-control"
                  rows="8" placeholder="Bạn cần liên lạc gì với chúng tôi ?"></textarea>
                @error('comment')<small class="form-text text-danger">{{ $message }}</small> @enderror

              </div>
              <div class="form-group col-md-12">
                <input type="submit" name="submit" class="btn btn-primary pull-right" value="Gửi phản hồi">
              </div>
            </form>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="contact-info">
            <h2 class="title text-center">Về chúng tôi</h2>
            <address>
              <p>Triệu Thuận, Triệu Phong, Quảng Trị</p>
              <p>ĐT: 0962324571</p>
              <p>Email: songdoan96@.com</p>
            </address>
            <div class="social-networks">
              <h2 class="title text-center">Mạng xã hội</h2>
              <ul>
                <li>
                  <a href="#"><i class="fa fa-facebook"></i></a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-twitter"></i></a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-google-plus"></i></a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-youtube"></i></a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
