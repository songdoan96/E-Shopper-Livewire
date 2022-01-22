<footer id="footer">
  <!--Footer-->

  @if ($settings)
    <div class="footer-widget">
      <div class="container">
        <div class="row">
          <div class="col-sm-2">
            <div class="single-widget">
              <h2>Thông tin liên hệ</h2>
              <ul class="nav nav-pills nav-stacked">
                <li>
                  <i class="fa fa-map-marker"> Địa chỉ:</i>
                  <p>{{ $settings->address }}</p>
                </li>
                <li>
                  <i class="fa fa-phone"> Điện thoại:</i>
                  <p>{{ $settings->phone }}</p>
                </li>
                <li>
                  <i class="fa fa-phone"> Điện thoại:</i>
                  <p>{{ $settings->phone2 }}</p>
                </li>
                <li>
                  <i class="fa fa-envelope"> Email:</i>
                  <p>{{ $settings->email }}</p>
                </li>

              </ul>
            </div>
          </div>
          <div class="col-sm-2">
            <div class="single-widget">
              <h2>Shop</h2>
              <ul class="nav nav-pills nav-stacked">
                <li><a href="">Link 2</a></li>
                <li><a href="">Link 2</a></li>
                <li><a href="">Link 2</a></li>
                <li><a href="">Link 2</a></li>
                <li><a href="">Link 2</a></li>
              </ul>
            </div>
          </div>
          <div class="col-sm-2">
            <div class="single-widget">
              <h2>Điều khoản</h2>
              <ul class="nav nav-pills nav-stacked">
                <li><a href="">Link 3</a></li>
                <li><a href="">Link 3</a></li>
                <li><a href="">Link 3</a></li>
                <li><a href="">Link 3</a></li>
                <li><a href="">Link 3</a></li>
              </ul>
            </div>
          </div>
          <div class="col-sm-2">
            <div class="single-widget">
              <h2>Về chúng tôi</h2>
              <ul class="nav nav-pills nav-stacked">
                <li><a href="">Link 4</a></li>
                <li><a href="">Link 4</a></li>
                <li><a href="">Link 4</a></li>
                <li><a href="">Link 4</a></li>
                <li><a href="">Link 4</a></li>
              </ul>
            </div>
          </div>
          <div class="col-sm-3 col-sm-offset-1">
            <div class="single-widget">
              <h2>Đăng ký nhận tin</h2>
              <form action="#" class="searchform">
                <input type="text" placeholder="Địa chỉ mail" />
                <button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
                <p>Đăng ký để nhận thông tin khuyến mãi sớm nhất</p>
              </form>
            </div>
          </div>

        </div>
      </div>
    </div>
  @endif


  <div class="footer-bottom">
    <div class="container">
      <div class="row">
        <p class="text-center">Copyright 2022</p>
      </div>
    </div>
  </div>

</footer>
