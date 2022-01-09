<div class="container-fluid">
  <div class="row bg-light align-items-center">
    <div class="col-6">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Danh mục sản phẩm</li>
        </ol>
      </nav>
    </div>
    <div class="col-6">
      <a href="{{ route('admin.add_category') }}" class="btn btn-success pull-right ">Thêm danh mục sản phẩm</a>
    </div>
  </div>
  <div class="col-12 my-5">
    <div class="table-responsive">

      <table class="table table-striped table-bordered table-sm">
        <thead class="thead-dark">
          <tr>
            <th>STT</th>
            <th>Tên danh mục</th>
            <th>Tên ngắn</th>
            <th>Trạng thái</th>
            <th>Tùy chọn</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($categories as $key => $category)
            <tr>
              <td>{{ ++$key }}</td>
              <td>{{ $category->name }}</td>
              <td>{{ $category->slug }}</td>
              <td>
                <a href="#" wire:click.prevent="changeStatus({{ $category->id }})">
                  @if ($category->status == '1')
                    <i class="fa fa-eye text-success"></i>
                  @else
                    <i class="fa fa-eye-slash text-danger"></i>
                  @endif
                </a>
              </td>
              <td>
                <a href="{{ route('admin.edit_category', ['cat_id' => $category->id]) }}"><i
                    class="fa fa-pencil-square-o fa-lg text-success mx-1" aria-hidden="true"></i></a>
                <a href="#" wire:click.prevent="deleteCategory({{ $category->id }})"
                  onclick="confirm('Bạn có muốn xóa không ?')|| event.stopImmediatePropagation()">
                  <i class="fa fa-ban text-danger mx-1" aria-hidden="true"></i>
                </a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
