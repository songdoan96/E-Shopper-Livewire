<div class="col-sm-6">
  <form action="{{ route('product.search') }}" class="search-bar">
    <input type="text" name="search" value="{{ $search }}" placeholder="Tìm kiếm sản phẩm...">
    <button type="submit"><i class="fa fa-search"></i></button>
  </form>
</div>
