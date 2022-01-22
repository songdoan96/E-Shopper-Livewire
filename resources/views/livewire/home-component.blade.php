<div>

  @if (count($sliders) > 0)
    <section id="slider">
      <!--slider-->
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div id="slider-carousel" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                @foreach ($sliders as $key => $slider)
                  <li data-target="#slider-carousel" data-slide-to="{{ $key }}"
                    class="{{ $key == 0 ? 'active' : null }}"></li>
                @endforeach
              </ol>

              <div class="carousel-inner">
                @foreach ($sliders as $key => $slider)

                  <div class="item {{ $key == 0 ? 'active' : null }}">
                    <div class="col-sm-6">
                      <h1 style="height: 160px">{{ $slider->title }}</h1>
                      <h2>{{ $slider->sub_title }}</h2>
                      <p>{{ $slider->description }} </p>
                      <h2>{{ $slider->price }} đ</h2>
                      <a href="{{ $slider->link }}" class="btn btn-default get btn-lg">Chi tiết</a>
                    </div>
                    <div class="col-sm-6">
                      <img src="{{ asset('assets/images/sliders/' . $slider->image) }}" class="girl img-responsive"
                        alt="{{ $slider->title }}" style="object-fit:cover;" />
                    </div>
                  </div>
                @endforeach



              </div>

              <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                <i class="fa fa-angle-left"></i>
              </a>
              <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                <i class="fa fa-angle-right"></i>
              </a>
            </div>

          </div>
        </div>
      </div>
    </section>
  @endif

  <!--/slider-->


  <section>
    <div class="container">
      <div class="row">
        <div class="col-sm-3">
          <div class="left-sidebar">
            <h2>Danh mục sản phẩm</h2>
            <div class="panel-group category-products" id="accordian">
              <!--category-productsr-->
              @foreach ($categories as $category)
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h4 class="panel-title"><a href="#"
                        wire:click.prevent="showProducts({{ $category->id }},'category')">{{ $category->name }}</a>
                    </h4>
                  </div>
                </div>
              @endforeach
            </div>
            <!--/category-products-->

            <div class="brands_products">
              <!--brands_products-->
              <h2>Thương hiệu</h2>
              <div class="brands-name">
                <ul class="nav nav-pills nav-stacked">
                  @foreach ($brands as $brand)
                    <li>
                      <a href="#" wire:click.prevent="showProducts({{ $brand->id }},'brand')">
                        <span
                          class="pull-right">({{ count($brand->product->where('status', '1')) }})</span>{{ $brand->name }}</a>
                    </li>
                  @endforeach
                </ul>
              </div>
            </div>
            <!--/brands_products-->

            <div class="price-range">
              <!--price-range-->
              <h2>Lọc theo giá</h2>
              <div class="well text-center">
                <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="50000000"
                  data-slider-step="10000" data-slider-value="[1000000,10000000]" id="sl2"><br />
                <b class="pull-left">$ 0</b> <b class="pull-right">$ 50000000</b>
              </div>


            </div>
            <!--/price-range-->

            <div class="shipping text-center">
              <!--shipping-->
              <img src="{{ asset('assets/images/home/shipping.jpg') }}" alt="" />
            </div>
            <!--/shipping-->

          </div>
        </div>





        <div class="col-sm-9 padding-right">

          <div class="features_items">
            <!--features_items-->
            <h2 class="title text-center">Sản phẩm mới nhất</h2>

            @if (count($products))
              @foreach ($products as $product)
                @php
                  $w_items = Cart::instance('wishlist')
                      ->content()
                      ->pluck('id');
                @endphp
                <div class="col-sm-3">
                  <div class="new-item">

                    <div class="new-img">
                      <img class="main-img img-fluid" src="{{ asset('assets/images/products/' . $product->image) }}"
                        alt="{{ $product->name }}" height="150">
                      <div class="layer-box">
                        <a href="#" class="it-comp" data-toggle="tooltip" data-placement="left" title=""
                          data-original-title="Compare"><i class="fa fa-compress" aria-hidden="true"></i>So sánh</a>

                        @if ($w_items->contains($product->id))
                          <a href="#" wire:click.prevent="removeWishlistItem('{{ $product->id }}')"
                            class="it-fav active" data-toggle="tooltip" data-placement="left" title=""
                            data-original-title="Favourite"><i class="fa fa-heart" aria-hidden="true"></i>Yêu
                            thích</a>
                        @else
                          <a href="#"
                            wire:click.prevent="storeWishlist({{ $product->id }},'{{ $product->name }}',{{ $product->price }})"
                            class="it-fav" data-toggle="tooltip" data-placement="left" title=""
                            data-original-title="Favourite"><i class="fa fa-heart" aria-hidden="true"></i>Yêu
                            thích</a>

                        @endif

                      </div>
                    </div>
                    <div class="tab-heading">
                      <a
                        href="{{ route('product.details', ['product_slug' => $product->slug]) }}">{{ $product->name }}</a>
                    </div>
                    <div class="img-content d-flex justify-content-between">
                      <div>

                        <div class="star-rating">
                          @php
                            $sum_rating = 0;
                          @endphp
                          @foreach ($product->orderItems->where('r_status', 1) as $orderItem)
                            @php
                              $sum_rating += $orderItem->review->rating;
                            @endphp
                          @endforeach
                          @php
                            $count_rating = $product->orderItems->where('r_status', 1)->count();
                            $avg_rating = $count_rating ? $sum_rating / $count_rating : 0;
                            // $avg_rating = $sum_rating / $product->orderItems->where('r_status', 1)->count();
                          @endphp
                          <span style="width: {{ $avg_rating * 20 }}%;"></span>
                        </div>
                        <ul class="list-unstyled list-inline price">
                          <li class="list-inline-item">{{ number_format($product->price, 0, ',', '.') }} đ</li>

                          @if (!empty($product->sale_price))
                            <li class="list-inline-item underline">
                              {{ number_format($product->sale_price, 0, ',', '.') }} đ
                            </li>
                          @endif
                        </ul>
                      </div>
                      <div>
                        <a href="" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add to Cart"
                          wire:click.prevent="storeCart({{ $product->id }},'{{ $product->name }}',{{ $product->price }})"><i
                            class="fa fa-shopping-cart"></i></a>
                      </div>
                    </div>

                  </div>

                </div>
              @endforeach
            @else
              <div class="text-center" style="padding:5rem">
                <h6><i class="fa fa-ban text-danger fa-4x" aria-hidden="true"></i></h6>
                <h4>Không tìm thấy sản phẩm</h4>
              </div>
            @endif

          </div>
          <!--features_items-->

          @if (isset($sel_categories))
            <div class="category-tab">
              <!--category-tab-->
              <div class="col-sm-12">
                <ul class="nav nav-tabs">
                  @foreach ($sel_categories as $key => $sel_cat)
                    <li class="{{ $key == 0 ? 'active' : null }}"><a href="#cat-{{ $sel_cat->id }}"
                        data-toggle="tab">{{ $sel_cat->name }}</a></li>
                  @endforeach

                </ul>
              </div>
              <div class="tab-content" style="margin-top: 7rem;">

                @foreach ($sel_categories as $key => $sel_cat)
                  <div class="tab-pane fade {{ $key == 0 ? 'active in' : '' }}" id="cat-{{ $sel_cat->id }}">
                    <div class="owl-carousel owl-theme categories-tab-slider" wire:ignore>
                      @php
                        $products_of_cat = \App\Models\Product::where('category_id', $sel_cat->id)
                            // ->limit(4)
                            ->get();
                      @endphp

                      @if (count($products_of_cat) > 0)
                        @foreach ($products_of_cat as $pro_of_cat)
                          <div class="product-image-wrapper">
                            <div class="single-products">
                              <div class="productinfo text-center">
                                <a href="{{ route('product.details', ['product_slug' => $pro_of_cat->slug]) }}">
                                  <img src="{{ asset('assets/images/products/' . $pro_of_cat->image) }}" alt="" />
                                </a>
                                <h2>{{ number_format($pro_of_cat->price, 0, ',', '.') }} đ</h2>
                                <p>{{ $pro_of_cat->name }}</p>
                                <a href="#"
                                  wire:click.prevent="storeCart({{ $pro_of_cat->id }},'{{ $pro_of_cat->name }}',{{ $pro_of_cat->price }})"
                                  class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm
                                  vào
                                  giỏ</a>
                              </div>

                            </div>
                          </div>
                        @endforeach
                      @else
                        Không tìm thấy sản phẩm nào trong danh mục {{ $sel_cat->name }}
                      @endif




                    </div>
                  </div>
                @endforeach

              </div>
            </div>
          @endif






          <div class="featured_items">
            <!--recommended_items-->
            <h2 class="title text-center">Sản phẩm nổi bật</h2>
            <div class="owl-carousel owl-theme featured_carousel" wire:ignore>
              @foreach ($featured_products as $ft_product)
                <div class="product-image-wrapper">
                  <div class="single-products">
                    <div class="productinfo text-center">
                      <a href="{{ route('product.details', ['product_slug' => $ft_product->slug]) }}">
                        <img src="{{ asset('assets/images/products/' . $ft_product->image) }}"
                          alt="{{ $ft_product->name }}" height="200" />
                      </a>
                      <h2>{{ number_format($ft_product->price, 0, ',', '.') }} đ</h2>
                      <p style="height:60px;">
                        {{ $ft_product->name }}
                      </p>
                      <a href="#"
                        wire:click.prevent="storeCart({{ $ft_product->id }},'{{ $ft_product->name }}',{{ $ft_product->price }})"
                        class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào
                        giỏ</a>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>

</div>

@push('scripts')
  <script>
    $(document).ready(function() {

      $(".featured_carousel").owlCarousel({
        items: 3,
        margin: 20,
        stagePadding: 5,
        nav: true,
        loop: true,
        dots: false,
        navText: [
          "<a class='left recommended-item-control' data-slide='prev'><i class='fa fa-angle-left'></i></a>",
          "<a class='right recommended-item-control' data-slide='next'><i class='fa fa-angle-right'></i></a>"
        ],
        responsive: {
          0: {
            items: 1
          },
          600: {
            items: 3
          },
          1000: {
            items: 4
          }
        }

      })


      $(".categories-tab-slider").owlCarousel({
        items: 4,
        margin: 20,
        stagePadding: 5,
        loop: true,

        responsive: {
          0: {
            items: 2
          },
          600: {
            items: 3
          },
          1000: {
            items: 4
          }
        }

      })




    });
  </script>
@endpush
