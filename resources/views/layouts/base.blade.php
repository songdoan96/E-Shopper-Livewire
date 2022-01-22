<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Ecommerce</title>
  <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/prettyPhoto.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/price-range.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/animate.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet">
  <!--[if lt IE 9]>
    <script src="{{ asset('assets/js/html5shiv.js') }}"></script>
    <script src="{{ asset('assets/js/respond.min.js') }}"></script>
    <![endif]-->
  <link rel="shortcut icon" href="{{ asset('assets/images/ico/favicon.ico') }}">
  <link rel="apple-touch-icon-precomposed" sizes="144x144"
    href="{{ asset('assets/images/ico/apple-touch-icon-144-precomposed.png') }}">
  <link rel="apple-touch-icon-precomposed" sizes="114x114"
    href="{{ asset('assets/images/ico/apple-touch-icon-114-precomposed.png') }}">
  <link rel="apple-touch-icon-precomposed" sizes="72x72"
    href="{{ asset('assets/images/ico/apple-touch-icon-72-precomposed.png') }}">
  <link rel="apple-touch-icon-precomposed"
    href="{{ asset('assets/images/ico/apple-touch-icon-57-precomposed.png') }}">

  {{-- owl carouse --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />
  {{-- owl carouse --}}

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.5.0/nouislider.min.css" />

  <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
  @stack('styles')
  @livewireStyles

</head>
<!--/head-->

<body>
  <header id="header">
    <!--header-->
    <div class="header_top">
      <!--header_top-->
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <div class="contactinfo">
              <ul class="nav nav-pills">
                <li><a href="#"><i class="fa fa-phone"></i> +84 962324571</a></li>
                <li><a href="#"><i class="fa fa-envelope"></i> songdoan96@gmail.com</a></li>
              </ul>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="social-icons pull-right shop-menu shop-menu-top">
              <ul class="nav navbar-nav">


                @if (Route::has('login'))
                  @auth
                    @if (Auth::user()->role === 'admin')
                      <li class="dropdown">
                        <a href="#" type="button" id="user_actions" data-toggle="dropdown" aria-haspopup="true"
                          aria-expanded="true">
                          <span><i class="fa fa-user"></i>
                            {{ Auth::user()->name }}</span>
                          <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="user_actions">
                          <li>
                            <a href="{{ route('admin.dashboard') }}">Trang Admin</a>
                          </li>
                          <li>
                            <a href="{{ route('logout') }}"
                              onclick="event.preventDefault();$('#logout_form').submit()"><i
                                class="fa fa-sign-out"></i>Đăng xuất</a>
                          </li>
                        </ul>
                      </li>
                    @else
                      <li class="dropdown">
                        <a href="#" type="button" id="user_actions" data-toggle="dropdown" aria-haspopup="true"
                          aria-expanded="true">
                          <span><i class="fa fa-user"></i>
                            {{ Auth::user()->name }}</span>
                          <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="user_actions">
                          <li>
                            <a href="{{ route('user.orders') }}">Đơn hàng của tôi</a>
                          </li>
                          <li>
                            <a href="{{ route('user.change_password') }}">Đổi mật khẩu</a>
                          </li>
                          <li>
                            <a href="{{ route('logout') }}"
                              onclick="event.preventDefault();$('#logout_form').submit()"><i
                                class="fa fa-sign-out"></i>Đăng xuất</a>
                          </li>
                        </ul>
                      </li>
                    @endif
                    <form id="logout_form" action="{{ route('logout') }}" method="POST">@csrf</form>
                  @else
                    <li><a href="/login"><i class="fa fa-sign-in"></i> Đăng nhập</a></li>
                    <li><a href="/register"><i class="fa fa-lock"></i> Đăng ký</a></li>
                  @endauth
                @endif
              </ul>

            </div>
          </div>
        </div>
      </div>
    </div>
    <!--/header_top-->

    <div class="header-middle">
      <!--header-middle-->
      <div class="container">
        <div class="row">
          <div class="col-sm-3">
            <div class="logo pull-left">
              <a href="/">S_<span>Shop</span></a>
            </div>

          </div>
          @livewire('header-search-component')
          <div class="col-sm-3">
            <div class="shop-menu shop-menu-navbar pull-right">
              <ul class="nav navbar-nav">
                <li class="wishlist"><a href="{{ route('wishlist') }}"><i class="fa fa-heart"></i>
                    @livewire('wishlist-count-component')</a></li>
                <li class="cart-nav"><a href="/cart"><i class="fa fa-shopping-cart"></i>
                    @livewire('cart-count-component') </a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--/header-middle-->

    <div class="header-bottom">
      <!--header-bottom-->
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            </div>
            <div class="mainmenu pull-left">
              <ul class="nav navbar-nav collapse navbar-collapse">
                <li><a href="/" class="active">Trang chủ</a></li>
                <li><a href="/shop">Cửa hàng</a></li>
                <li><a href="/checkout">Thanh toán</a></li>

                {{-- <li class="dropdown"><a href="/shop">Shop<i class="fa fa-angle-down"></i></a>
                  <ul role="menu" class="sub-menu">
                    <li><a href="/shop">Products</a></li>
                    <li><a href="product-details.html">Product Details</a></li>
                    <li><a href="/checkout">Checkout</a></li>
                    <li><a href="/cart">Cart</a></li>
                    <li><a href="/login">Login</a></li>
                  </ul>
                </li>
                <li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
                  <ul role="menu" class="sub-menu">
                    <li><a href="blog.html">Blog List</a></li>
                    <li><a href="blog-single.html">Blog Single</a></li>
                  </ul>
                </li>
                <li><a href="404.html">404</a></li> --}}
                <li><a href="/contact-us">Liên hệ</a></li>
              </ul>
            </div>
          </div>

        </div>
      </div>
    </div>
    <!--/header-bottom-->
  </header>
  <!--/header-->



  {{ $slot }}


  @livewire('footer-component')



  <script src="{{ asset('assets/js/jquery.js') }}"></script>
  <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/js/jquery.scrollUp.min.js') }}"></script>
  <script src="{{ asset('assets/js/price-range.js') }}"></script>
  <script src="{{ asset('assets/js/jquery.prettyPhoto.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.5.0/nouislider.min.js"></script>

  {{-- owl carouse js --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <script src="{{ asset('assets/js/main.js') }}"></script>

  @stack('scripts')
  @livewireScripts

</body>

</html>
