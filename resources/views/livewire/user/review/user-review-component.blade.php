<div>
  <div class="container" id="reviews">
    <div class="col-sm-12">
      <div id="review">
        <div class="wrap-review-form">
          <div id="comments">
            <h2 class="woocommerce-Reviews-title">Đánh giá sản phẩm: </h2>
            <ol class="commentlist">
              <li class="comment byuser comment-author-admin bypostauthor even thread-even depth-1" id="li-comment-20">
                <div id="comment-20" class="comment_container">
                  <img alt="" src="{{ asset('assets/images/products/' . $orderItem->product->image) }}" height="200"
                    width="200">
                  <div class="comment-text">
                    <div class="description">
                      <p style="font-size: 2rem">Tên sản phẩm: <strong>{{ $orderItem->product->name }}</strong></p>
                    </div>
                    <p class="meta" style="font-size: 1.6rem">
                      <strong class="woocommerce-review__author">Giá: {{ $orderItem->price }} đ</strong>
                    </p>
                  </div>
                </div>
              </li>
            </ol>
          </div><!-- #comments -->

          <div id="review_form_wrapper">
            <div id="review_form">
              <div id="respond" class="comment-respond">

                <form id="commentform" class="comment-form" novalidate="" wire:submit.prevent="addReview">

                  <div class="comment-form-rating">
                    <span>Đánh giá</span>
                    <p class="stars" style="padding: 2rem 0;">
                      <label for="rated-1"></label>
                      <input type="radio" id="rated-1" name="rating" wire:model="rating" value="1">
                      <label for="rated-2"></label>
                      <input type="radio" id="rated-2" name="rating" wire:model="rating" value="2">
                      <label for="rated-3"></label>
                      <input type="radio" id="rated-3" name="rating" wire:model="rating" value="3">
                      <label for="rated-4"></label>
                      <input type="radio" id="rated-4" name="rating" wire:model="rating" value="4">
                      <label for="rated-5"></label>
                      <input type="radio" id="rated-5" name="rating" wire:model="rating" value="5" checked="checked">
                    </p>
                  </div>
                  <p class="comment-form-comment">
                    <label for="comment">Bình luận sản phẩm<span class="required">*</span>
                    </label>
                    <textarea id="comment" name="comment" wire:model="comment" cols="45" rows="8"></textarea>
                  </p>
                  <p class="form-submit">
                    <input name="submit" type="submit" id="submit" class="submit" value="Gửi bình luận">
                  </p>
                </form>

              </div><!-- .comment-respond-->
            </div><!-- #review_form -->
          </div><!-- #review_form_wrapper -->

        </div>
      </div>
    </div>
  </div>
</div>
