<div>
  <section>

    <div class="container">
      <div class="row">
        <div class="col-sm-12 padding-right">
          <div class="product-details">
            <!--product-details-->
            <div class="col-sm-4">
              <div class="view-product">
                <img src="{{ asset('assets/images/products/' . $product->image) }}" alt="" />
                <h3>ZOOM</h3>
              </div>
              <div id="similar-product" class="carousel slide" data-ride="carousel">

                <!-- Wrapper for slides -->
                <div class="carousel-inner1">
                  <div class="gallery_images owl-carousel owl-theme">
                    @foreach (explode('|', $product->images) as $image)
                      <img src="{{ asset('assets/images/products/' . $image) }}" alt="" width="100" height="100">
                    @endforeach
                  </div>
                </div>
              </div>

            </div>
            <div class="col-sm-7">
              <div class="product-information">
                <!--/product-information-->
                {{-- <img src="{{ asset('assets/images/product-details/new.jpg') }}" class="newarrival" alt="" /> --}}
                <h2>{{ $product->name }}</h2>
                <p>Mã sản phẩm: {{ $product->id }}</p>
                {{-- <img style="display:block;" src="{{ asset('assets/images/product-details/rating.png') }}" alt="" /> --}}
                <span>
                  <span>{{ number_format($product->price, 0, ',', '.') }} đ</span>
                  <label>Số lượng:</label>
                  <input type="number" min="1" wire:model="quantity" />
                  <button type="button" class="btn btn-fefault cart"
                    wire:click.prevent="storeCart({{ $product->id }},'{{ $product->name }}',{{ $product->price }})">
                    <i class="fa fa-shopping-cart"></i>
                    Thêm giỏ hàng
                  </button>
                </span>
                <p><b>Kho:</b> {{ $product->quantity > 0 ? $product->quantity : 'Hết hàng' }}</p>
                <p><b>Tình trạng:</b> New</p>
                <p><b>Danh mục:</b> {{ $product->category->name }}</p>
                <p><b>Thương hiệu:</b> {{ $product->brand->name }}</p>

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

                <div class="star-rating">
                  <span style="width: {{ $avg_rating * 20 }}%;top:-18px"></span>
                </div>
                <span>({{ $avg_rating }} trên 5)</span>



                {{-- <a href=""><img src="{{ asset('assets/images/product-details/share.png') }}" --}}

              </div>
              <!--/product-information-->
            </div>
          </div>
          <!--/product-details-->

          <div class="category-tab shop-details-tab">
            <!--category-tab-->
            <div class="col-sm-12">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#details" data-toggle="tab">Tổng quan</a></li>
                <li><a href="#companyprofile" data-toggle="tab">Chi tiết</a></li>
                <li><a href="#reviews" data-toggle="tab">Đánh giá
                    ({{ $product->orderItems->where('r_status', 1)->count() }})</a></li>
              </ul>
            </div>
            <div class="tab-content">
              <div class="tab-pane fade active in" id="details">
                <div class="col-sm-12">
                  <p>{!! $product->desc !!}</p>
                </div>

              </div>

              <div class="tab-pane fade" id="companyprofile">
                <div class="col-sm-12">
                  <p>{!! $product->content !!}</p>
                </div>

              </div>

              <div class="tab-pane fade" id="reviews">
                <div class="col-sm-12">
                  <div class="wrap-review-form">

                    <div id="comments">

                      <ol class="commentlist">
                        @foreach ($product->orderItems->where('r_status', 1) as $orderItem)
                          <li class="comment byuser comment-author-admin bypostauthor even thread-even depth-1"
                            id="li-comment-20">
                            <div id="comment-20" class="comment_container">
                              <img alt="" src="{{ asset('assets/images/users/avatar_1.jpg') }}" height="80"
                                width="80">
                              <div class="comment-text">
                                <div class="star-rating">
                                  <span class="width-{{ $orderItem->review->rating * 20 }}-percent">Đánh giá <strong
                                      class="rating">{{ $orderItem->review->rating }}</strong> trên
                                    5</span>
                                </div>
                                <p class="meta">
                                  <strong
                                    class="woocommerce-review__author">{{ $orderItem->order->user->name }}</strong>
                                  <span class="woocommerce-review__dash">–</span>
                                  <time class="woocommerce-review__published-date"
                                    datetime="2008-02-14 20:00">{{ Carbon\Carbon::parse($orderItem->review->created_at)->format('H:i:s - d/m/Y') }}</time>
                                </p>
                                <div class="description">
                                  <p>{{ $orderItem->review->comment }}</p>
                                </div>
                              </div>
                            </div>
                          </li>
                        @endforeach

                      </ol>
                    </div><!-- #comments -->



                  </div>
                </div>
              </div>

            </div>
          </div>
          <!--/category-tab-->



        </div>
      </div>
    </div>
  </section>
</div>
@push('scripts')
  <script>
    $(document).ready(function() {
      $('.gallery_images').owlCarousel({
        items: 3,
        margin: 10,
        stagePadding: 5,
        nav: true,
        loop: true,
        dots: false,
        navText: [
          "<a class='left recommended-item-control' data-slide='prev'><i class='fa fa-angle-left'></i></a>",
          "<a class='right recommended-item-control' data-slide='next'><i class='fa fa-angle-right'></i></a>"
        ],

      })
    })
  </script>
@endpush
