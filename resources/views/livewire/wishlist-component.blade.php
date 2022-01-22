<div class="container">
  <div class="breadcrumbs">
    <ol class="breadcrumb">
      <li><a href="/">Home</a></li>
      <li class="active">Danh sách yêu thích</li>
    </ol>
  </div>
  <div class="row">
    @foreach (Cart::instance('wishlist')->content() as $row)
      <div class="col-sm-3">
        <div class="product-image-wrapper">
          <div class="single-products">
            <div class="productinfo text-center">
              <a href="{{ route('product.details', ['product_slug' => $row->model->slug]) }}">
                <img src="{{ asset('assets/images/products/' . $row->model->image) }}" alt="{{ $row->name }}"
                  height="200">
              </a>
              <h2>{{ number_format($row->price, 0, ',', '.') }}</h2>
              <p style="height:60px;">
                {{ $row->name }}
              </p>
              <a href="#" wire:click.prevent="moveToCart('{{ $row->rowId }}')" class="btn btn-default add-to-cart">
                <i class="fa fa-shopping-cart"></i>Di chuyển tới giỏ
              </a>
            </div>
          </div>
        </div>
      </div>
    @endforeach

  </div>
</div>
