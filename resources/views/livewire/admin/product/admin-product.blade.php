<div class="container-fluid">
  <div class="row bg-light align-items-center">
    <div class="col-6">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Sản phẩm</li>
        </ol>
      </nav>
    </div>
    <div class="col-6">
      <a href="{{ route('admin.add_product') }}" class="btn btn-success pull-right ">Thêm sản phẩm</a>
    </div>
  </div>
  <style>
    nav svg {
      height: 25px;
      width: 25px;
    }

  </style>
  <div class="col-12 my-5">
    <div class="table-responsive">

      <table class="table table-striped table-bordered table-sm">
        <thead class="thead-dark">
          <tr>
            <th>STT</th>
            <th>Tên sản phẩm</th>
            <th>Hình ảnh</th>
            <th>Giá</th>
            <th>Giá khuyến mãi</th>
            <th>Mô tả</th>
            <th>Nội dung</th>
            <th>Danh mục</th>
            <th>Thương hiệu</th>
            <th>Số lượng</th>
            <th>Sp nổi bật</th>
            <th>Trạng thái</th>
            <th>Tùy chọn</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($products as $key => $product)
            <tr>
              <td>{{ ++$key }}</td>
              <td>{{ $product->name }}</td>
              <td>
                <img src="{{ asset('assets/images/products/' . $product->image) }}" alt="{{ $product->name }}"
                  width="100">
              </td>
              <td>{{ number_format($product->price) }}</td>
              <td>{{ $product->sale_price }}</td>
              <td>{{ $product->desc }}</td>
              <td>{{ $product->content }}</td>
              <td>{{ $product->category->name }}</td>
              <td>{{ $product->brand->name }}</td>
              <td>{{ $product->quantity }}</td>
              <td>
                <a href="#" wire:click.prevent="changeFeatured({{ $product->id }})">
                  @if ($product->featured)
                    <i class="fa fa-check text-success" aria-hidden="true"></i>
                  @else
                    <i class="fa fa-ban text-danger" aria-hidden="true"></i>
                  @endif
                </a>
              </td>
              <td>
                <a href="#" wire:click.prevent="changeStatus({{ $product->id }})">
                  @if ($product->status == '1')
                    <i class="fa fa-eye text-success"></i>
                  @else
                    <i class="fa fa-eye-slash text-danger"></i>
                  @endif
                </a>
              </td>
              <td>
                <a href="{{ route('admin.edit_product', ['product_id' => $product->id]) }}"><i
                    class="fa fa-pencil-square-o fa-lg text-success mx-1" aria-hidden="true"></i></a>
                <a href="#" wire:click.prevent="deleteProduct({{ $product->id }})"
                  onclick="confirm('Bạn có muốn xóa không ?')|| event.stopImmediatePropagation()">
                  <i class="fa fa-ban text-danger mx-1" aria-hidden="true"></i>
                </a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    {{ $products->links() }}
  </div>
</div>
