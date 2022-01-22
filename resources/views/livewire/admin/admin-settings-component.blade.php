<div class="container-fluid">
  <div class="row bg-light align-items-center">
    <div class="col-6">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Cài đặt thông tin liên lạc</li>
        </ol>
      </nav>
    </div>

  </div>

  <div class="col-12">
    <table class="table">
      <tr>
        <th>Email</th>
        <td>{{ $settings->email }}</td>
        <th>Địa chỉ</th>
        <td>{{ $settings->address }}</td>
      </tr>
      <tr>
        <th>SĐT</th>
        <td>{{ $settings->phone }}</td>
        <th>SĐT 2</th>
        <td>{{ $settings->phone2 }}</td>
      </tr>
      <tr>
        <th>Facebook</th>
        <td>{{ $settings->facebook }}</td>
        <th>Youtube</th>
        <td>{{ $settings->youtube }}</td>
      </tr>
      <tr>
        <th>Map</th>
        <td>{{ $settings->map }}</td>
        <th>Twitter</th>
        <td>{{ $settings->twitter }}</td>
      </tr>
      <tr>
        <th>Instagram</th>
        <td>{{ $settings->instagram }}</td>
        <th></th>
        <td></td>
      </tr>

    </table>
  </div>
  <div class="col-md-6 offset-3 my-5">
    <form wire:submit.prevent="saveSettings">
      @if (Session::has('success_msg'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <strong>{{ Session::get('success_msg') }}</strong>
        </div>
      @endif

      <div class="form-group">
        <label for="email">Email</label>
        <input type="text" id="email" name="email" wire:model="email" class="form-control"
          placeholder="Nhập tên thương hiệu">
        @error('email')<small class="form-text text-danger">{{ $message }}</small> @enderror
      </div>
      <div class="form-group">
        <label for="phone">SĐT</label>
        <input type="text" id="phone" name="phone" wire:model="phone" class="form-control"
          placeholder="Nhập tên thương hiệu">
        @error('phone')<small class="form-text text-danger">{{ $message }}</small> @enderror
      </div>
      <div class="form-group">
        <label for="phone2">SĐT (khác nếu có)</label>
        <input type="text" id="phone2" name="phone2" wire:model="phone2" class="form-control"
          placeholder="Nhập tên thương hiệu">
        @error('phone2')<small class="form-text text-danger">{{ $message }}</small> @enderror
      </div>
      <div class="form-group">
        <label for="address">Địa chỉ</label>
        <input type="text" id="address" name="address" wire:model="address" class="form-control"
          placeholder="Nhập tên thương hiệu">
        @error('address')<small class="form-text text-danger">{{ $message }}</small> @enderror
      </div>
      <div class="form-group">
        <label for="facebook">Facebook</label>
        <input type="text" id="facebook" name="facebook" wire:model="facebook" class="form-control"
          placeholder="Nhập tên thương hiệu">
        @error('facebook')<small class="form-text text-danger">{{ $message }}</small> @enderror
      </div>
      <div class="form-group">
        <label for="youtube">Youtube</label>
        <input type="text" id="youtube" name="youtube" wire:model="youtube" class="form-control"
          placeholder="Nhập tên thương hiệu">
        @error('youtube')<small class="form-text text-danger">{{ $message }}</small> @enderror
      </div>
      <div class="form-group">
        <label for="map">Bản đồ</label>
        <input type="text" id="map" name="map" wire:model="map" class="form-control"
          placeholder="Nhập tên thương hiệu">
        @error('map')<small class="form-text text-danger">{{ $message }}</small> @enderror
      </div>
      <div class="form-group">
        <label for="twitter">Twitter</label>
        <input type="text" id="twitter" name="twitter" wire:model="twitter" class="form-control"
          placeholder="Nhập tên thương hiệu">
        @error('twitter')<small class="form-text text-danger">{{ $message }}</small> @enderror
      </div>
      <div class="form-group">
        <label for="instagram">Instagram</label>
        <input type="text" id="instagram" name="instagram" wire:model="instagram" class="form-control"
          placeholder="Nhập tên thương hiệu">
        @error('instagram')<small class="form-text text-danger">{{ $message }}</small> @enderror
      </div>

      <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>

  </div>
</div>
