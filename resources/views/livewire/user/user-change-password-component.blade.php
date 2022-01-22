<div>
  <div class="container">
    <div class="panel panel-default">
      <div class="panel-heading">
        <div class="breadcrumbs">
          <ol class="breadcrumb" style="margin:0;">
            <li><a href="/">Home</a></li>
            <li class="active">Đổi mật khẩu</li>
          </ol>
        </div>
      </div>
      <div class="panel-body">
        @if (Session::has('error_msg'))
          <div class="col-sm-4 col-sm-offset-4 text-center alert alert-danger" role="alert">
            {{ Session::get('error_msg') }}
          </div>
        @endif
        @if (Session::has('success_msg'))
          <div class="col-sm-4 col-sm-offset-4 text-center alert alert-success" role="alert">
            {{ Session::get('success_msg') }}
          </div>
        @endif
        <div class="col-sm-6 col-sm-offset-2">
          <form class="form-horizontal" wire:submit.prevent="changePassword">
            <div class="form-group">
              <label for="current_password" class="col-sm-6 control-label">Mật khẩu cũ</label>
              <div class="col-sm-6">
                <input type="password" wire:model="current_password" class="form-control" id="current_password"
                  placeholder="Mật khẩu cũ">
                @error('current_password')<small class="form-text text-danger">{{ $message }}</small> @enderror
              </div>
            </div>
            <div class="form-group">
              <label for="password" class="col-sm-6 control-label">Mật khẩu mới</label>
              <div class="col-sm-6">
                <input type="password" wire:model="password" class="form-control" id="password"
                  placeholder="Mật khẩu mới">
                @error('password')<small class="form-text text-danger">{{ $message }}</small> @enderror
              </div>

            </div>
            <div class="form-group">
              <label for="confirm_password" class="col-sm-6 control-label">Nhập lại mật khẩu</label>
              <div class="col-sm-6">
                <input type="password" wire:model="confirm_password" class="form-control" id="confirm_password"
                  placeholder="Nhập lại mật khẩu">
                @error('confirm_password')<small class="form-text text-danger">{{ $message }}</small> @enderror
              </div>

            </div>

            <div class="form-group">
              <div class="col-sm-offset-6 col-sm-6">
                <button type="submit" class="btn btn-default">Đổi mật khẩu</button>
              </div>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>
</div>
