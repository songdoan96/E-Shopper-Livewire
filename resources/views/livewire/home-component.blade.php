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
                      <h1>{{ $slider->title }}</h1>
                      <h2>{{ $slider->sub_title }}</h2>
                      <p>{{ $slider->description }} </p>
                      <h2>{{ $slider->price }} đ</h2>
                      <a href="{{ $slider->link }}" class="btn btn-default get">Chi tiết</a>
                    </div>
                    <div class="col-sm-6">
                      <img src="{{ asset('assets/images/sliders/' . $slider->image) }}" class="girl img-responsive"
                        alt="{{ $slider->title }}" style="height:440px;object-fit:cover;" />
                      {{-- <img src="{{ asset('assets/images/home/pricing.png') }}" class="pricing" alt="" /> --}}
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
                      <a href="#" wire:click.prevent="showProducts({{ $brand->id }},'brand')"><span
                          class="pull-right">({{ count($brand->product) }})</span>{{ $brand->name }}</a>
                    </li>
                  @endforeach
                </ul>
              </div>
            </div>
            <!--/brands_products-->

            <div class="price-range">
              <!--price-range-->
              <h2>Price Range</h2>
              <div class="well text-center">
                <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600"
                  data-slider-step="5" data-slider-value="[250,450]" id="sl2"><br />
                <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
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
            @foreach ($products as $product)
              <div class="col-sm-4">
                <div class="product-image-wrapper">
                  <div class="single-products">
                    <div class="productinfo text-center">
                      <a href="{{ route('product.details', ['product_slug' => $product->slug]) }}">
                        <img src="{{ asset('assets/images/products/' . $product->image) }}"
                          alt="{{ $product->name }}" height="255" />
                      </a>
                      <h2>{{ number_format($product->price) }} đ</h2>
                      <p style="height: 40px">{{ $product->name }}</p>
                      <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào
                        giỏ</a>
                    </div>
                    {{-- <div class="product-overlay">
                      <div class="overlay-content">
                        <h2>{{ number_format($product->price) }} đ</h2>
                        <p>{{ $product->name }}</p>
                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ
                        </a>
                      </div>
                    </div> --}}
                  </div>
                  <div class="choose">
                    <ul class="nav nav-pills nav-justified">
                      <li><a href="#"><i class="fa fa-plus-square"></i>Yêu thích</a></li>
                      <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            @endforeach
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
              <div class="tab-content">
                @foreach ($sel_categories as $key => $sel_cat)
                  <div class="tab-pane fade {{ $key == 0 ? 'active in' : '' }}" id="cat-{{ $sel_cat->id }}">
                    @php
                      $products_of_cat = \App\Models\Product::where('category_id', $sel_cat->id)
                          ->limit(4)
                          ->get();
                    @endphp
                    @foreach ($products_of_cat as $pro_of_cat)
                      <div class="col-sm-3">
                        <div class="product-image-wrapper">
                          <div class="single-products">
                            <div class="productinfo text-center">
                              <a href="{{ route('product.details', ['product_slug' => $pro_of_cat->slug]) }}">
                                <img src="{{ asset('assets/images/products/' . $pro_of_cat->image) }}" alt="" />
                              </a>
                              <h2>{{ number_format($pro_of_cat->price) }} đ</h2>
                              <p>{{ $pro_of_cat->name }}</p>
                              <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm
                                vào
                                giỏ</a>
                            </div>

                          </div>
                        </div>
                      </div>
                    @endforeach

                  </div>
                @endforeach
              </div>
            </div>
          @endif



          {{-- hello --}}
          <div class="featured_items">
            <!--recommended_items-->
            <h2 class="title text-center">Sản phẩm nổi bật</h2>
            <div class="owl-carousel owl-theme featured_carousel">
              @foreach ($featured_products as $ft_product)

                <div class="product-image-wrapper">
                  <div class="single-products">
                    <div class="productinfo text-center">
                      <a href="{{ route('product.details', ['product_slug' => $ft_product->slug]) }}">
                        <img src="{{ asset('assets/images/products/' . $ft_product->image) }}"
                          alt="{{ $ft_product->name }}" height="200" />
                      </a>
                      <h2>{{ number_format($ft_product->price) }} đ</h2>
                      <p style="height:60px;">
                        {{ $ft_product->name }}
                      </p>
                      <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào
                        giỏ</a>
                    </div>
                  </div>
                </div>
              @endforeach


              {{-- <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                <i class="fa fa-angle-left"></i>
              </a>
              <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                <i class="fa fa-angle-right"></i>
              </a> --}}

            </div>

          </div>
          {{-- hello --}}


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
    });
  </script>
@endpush
