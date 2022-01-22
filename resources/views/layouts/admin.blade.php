<!doctype html>
<html lang="en">

<head>
  <title>Admin</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <script src="{{ asset('admin/js/ckeditor.js') }}"></script>

  <style>
    * {
      padding: 0;
      margin: 0;
      box-sizing: border-box;
      list-style: none;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
      margin: 0;
    }

    ul,
    ol {
      margin: 0;
    }

  </style>

  @livewireStyles

</head>

<body>



  <div class="app">
    <div class="container d-flex justify-content-between align-items-center py-2">
      <h3><a href="/">HOME</a></h3>
      <ul class="info d-flex justify-content-between align-items-center">
        <li class="px-2">
          <span>{{ Auth::user()->name }}</span>
        </li>
        <li class="px-2">
          <a href="{{ route('logout') }}" onclick="event.preventDefault();$('#logout_form').submit()"><i
              class="fa fa-sign-out"></i>Logout</a>
        </li>
        <form id="logout_form" action="{{ route('logout') }}" method="POST">@csrf</form>
      </ul>
    </div>
    <div class="container-fluid">
      <div class="row">
        <div class="left col-2 shadow-lg p-3">
          <nav class="navbar navbar-expand-sm navbar-dark">
            <div class="collapse navbar-collapse" id="collapsibleNavId">
              <ul class="navbar-nav mr-auto mt-2 mt-lg-0  flex-column text-dark">
                <li class="nav-item">
                  <a class="nav-link text-dark" href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-dark" href="{{ route('admin.categories') }}">Danh mục sản phẩm</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-dark" href="{{ route('admin.brands') }}">Thương hiệu</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-dark" href="{{ route('admin.products') }}">Sản phẩm</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-dark" href="{{ route('admin.home_categories') }}">Danh mục trang chủ</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-dark" href="{{ route('admin.home_sliders') }}">Slider trang chủ</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-dark" href="{{ route('admin.coupons') }}">Mã giảm giá</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-dark" href="{{ route('admin.orders') }}">Đơn hàng</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-dark" href="{{ route('admin.contacts') }}">Liên hệ</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-dark" href="{{ route('admin.settings') }}">Cài đặt</a>
                </li>
                {{-- <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">Danh mục sản phẩm</a>
                  <div class="dropdown-menu" aria-labelledby="dropdownId">
                    <a class="dropdown-item" href="{{ route('admin.categories') }}">Tất cả danh mục</a>
                    <a class="dropdown-item" href="{{ route('admin.add_category') }}">Thêm danh mục</a>
                  </div>
                </li> --}}
              </ul>

            </div>
          </nav>
        </div>
        <div class="right col-10">
          {{ $slot }}
        </div>
      </div>
    </div>
  </div>




  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdn.staticfile.org/jquery/2.2.4/jquery.min.js"></script>
  <script src="https://cdn.staticfile.org/moment.js/2.9.0/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  {{-- <script src="{{ asset('admin/js/ckeditor.js') }}"></script> --}}
  <script src='https://cdn.tiny.cloud/1/r2x614wq444nhjp96hcybcj4txrazg9tv299azbhyqtf3628/tinymce/5/tinymce.min.js'>
  </script>

  <script>
    $(".alert").alert();
  </script>
  @stack('scripts')
  @livewireScripts
</body>

</html>
