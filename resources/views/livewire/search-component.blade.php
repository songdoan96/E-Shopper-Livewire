<div>

  <section>
    <div class="container">
      <div class="row">
        <div class="col-sm-12 padding-right">

          <div class="features_items">
            <!--features_items-->
            <div class="wrap-shop-control">
              <div class="breadcrumbs">
                <ol class="breadcrumb" style="margin:0;">
                  <li><a href="/">Home</a></li>
                  <li class="active">Cửa hàng</li>
                </ol>
              </div>
              <div class="wrap-filter">

                <div class="sorting filter">
                  <label for="">Sắp xếp</label>
                  <select class="form-control" wire:model="sorting">
                    <option value="default">Mặc định</option>
                    <option value="date">Mới nhất</option>
                    <option value="price_asc">Giá tăng dần</option>
                    <option value="price_desc">Giá giảm dần</option>
                  </select>
                </div>
                <div class="pagesize filter">
                  <label for="">Số sản phẩm</label>
                  <select class="form-control" wire:model="pagesize">
                    <option value="8">8 sản phẩm</option>
                    <option value="12">12 sản phẩm</option>
                    <option value="16">16 sản phẩm</option>
                    <option value="18">18 sản phẩm</option>
                    <option value="20">20 sản phẩm</option>
                    <option value="24">24 sản phẩm</option>
                    <option value="32">32 sản phẩm</option>
                  </select>
                </div>
              </div>

            </div>
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
                        alt="{{ $product->name }}">
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
          <div class="text-center">
            {{ $products->links('livewire.pagination') }}
          </div>
        </div>
      </div>
    </div>
  </section>

</div>
