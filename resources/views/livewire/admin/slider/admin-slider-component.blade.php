<div class="container-fluid">
  <div class="row bg-light align-items-center">
    <div class="col-6">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Slider trang chủ</li>
        </ol>
      </nav>
    </div>
    <div class="col-6">
      <a href="{{ route('admin.add_home_sliders') }}" class="btn btn-success pull-right ">Thêm slider</a>

    </div>
  </div>
  <div class="col-12 my-5">
    <div class="table-responsive">
      <table class="table table-striped table-bordered table-sm">
        <thead class="thead-dark">
          <tr>
            <th>STT</th>
            <th>Tiêu đề</th>
            <th>Tiêu đề phụ</th>
            <th>Mô tả</th>
            <th>Hình ảnh</th>
            <th>Giá</th>
            <th>Trạng thái</th>
            <th>Tùy chọn</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($home_sliders as $key => $slider)
            <tr>
              <td>{{ ++$key }}</td>
              <td>{{ $slider->title }}</td>
              <td>{{ $slider->sub_title }}</td>
              <td>{{ $slider->description }}</td>
              <td>
                <img src="{{ asset('assets/images/sliders/' . $slider->image) }}" alt="{{ $slider->title }}"
                  width="50">
              </td>
              <td>{{ $slider->price }}</td>
              <td>
                <a href="#" wire:click.prevent="changeStatus({{ $slider->id }})">
                  @if ($slider->status == '1')
                    <i class="fa fa-eye text-success"></i>
                  @else
                    <i class="fa fa-eye-slash text-danger"></i>
                  @endif
                </a>
              </td>
              <td>
                <a href="{{ route('admin.edit_home_sliders', ['slider_id' => $slider->id]) }}"><i
                    class="fa fa-pencil-square-o fa-lg text-success mx-1" aria-hidden="true"></i></a>
                <a href="#" wire:click.prevent="deleteSlider({{ $slider->id }})"
                  onclick="confirm('Bạn có muốn xóa không ?')|| event.stopImmediatePropagation()">
                  <i class="fa fa-ban text-danger mx-1" aria-hidden="true"></i>
                </a>
              </td>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
