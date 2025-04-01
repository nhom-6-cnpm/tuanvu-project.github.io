@extends('admin.main')


@section('content')
@yield('content')
<form action="" method="POST">
  <div class="card-body">
        <div class="row">
          <div class="col-md-6">
              <div class="form-group">
                  <label for="">Tiêu Đề</label>
                  <input type="text" name="name" value="{{ $slider->name }}"
                    class="form-control">
              </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
                <label for="">Đường Dẫn</label>
                <input type="text" name="url" value="{{ $slider->url }}" 
                  class="form-control">
            </div>
        </div>
      </div>

      <div class="form-group">
        <label for="">Ảnh Sản Phẩm</label>
        <div class="input-group">
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="upload">
                <label class="custom-file-label" >Chọn file</label>
            </div>
        </div>
        <br>
        <div class="form-group">
          <div id="image_show">
            <a href="{{ $slider->thumb }}">
                <img src="{{ $slider->thumb }}" width="100px">
            </a>
          </div>
          <input type="hidden" name="thumb" value="{{ $slider->thumb }}"  id="thumb">
          <hr>
        </div>
      </div>

      <div class="form-group">
        <label for="">Sắp Xếp</label>
        <input type="number" name="sort_by" value="{{ $slider->sort_by }}"
          class="form-control">
    </div>

      <div class="col-sm-6">
            <label>Kích Hoạt</label>
            <!-- radio -->
            <div class="form-group">
              <div class="custom-control custom-radio">
                <input class="custom-control-input"
                    value="1" type="radio" id="active" name="active" 
                    {{ $slider->active == 1 ? 'checked' : '' }}>
                <label for="active" class="custom-control-label">Có</label>
              </div>
              <div class="custom-control custom-radio">
                <input class="custom-control-input"
                    value="0" type="radio" id="no_active" name="active" 
                    {{ $slider->active == 0 ? 'checked' : '' }}>    
                <label for="no_active" class="custom-control-label">Không</label>
              </div>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Cập Nhật Slider</button>
  </div>
  @csrf
</form>
@endsection

