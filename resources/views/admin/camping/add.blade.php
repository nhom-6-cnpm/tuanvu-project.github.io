@extends('admin.main')


@section('content')
@yield('content')
<form action="" method="POST">
  <div class="card-body">
        <div class="row">
          <div class="col-md-6">
              <div class="form-group">
                  <label for="">Tên Camping</label>
                  <input type="text" name="name" value="{{ old('name') }}"
                    class="form-control" placeholder="Nhập tên camping">
              </div>
          </div>
          <div class="col-md-6">
              <div class="form-group">
                  <label for="parent_id">Danh Mục</label>
                  <select class="form-control" name="menu_id">
                    @foreach ($menus as $menu)
                      <option value="{{$menu->id}}"> {{$menu->name}} </option>
                    @endforeach
                  </select>
              </div>
          </div>
        </div>

        <div class="form-group">
          <label for="">Giá</label>
          <input type="number" name="price" value="{{ old('price') }}" class="form-control">
      </div>

      <div class="form-group">
        <label >Mô Tả</label>
        <textarea name="description" class="form-control">{{ old('description') }}</textarea>
      </div>

      <div class="form-group">
        <label >Địa Chỉ</label>
        <textarea name="address" id="content" class="form-control">{{ old('address') }}</textarea>
      </div>

      <div class="form-group">
        <label for="">Ảnh Camping</label>
        <div class="input-group">
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="upload">
                <label class="custom-file-label" >Chọn file</label>
            </div>
        </div>
        <br>
        <div class="form-group">
          <div id="image_show">

          </div>
          <input type="hidden" name="thumb" id="thumb">
          <hr>
        </div>
      </div>

      <div class="col-sm-6">
            <label>Kích Hoạt</label>
            <!-- radio -->
            <div class="form-group">
              <div class="custom-control custom-radio">
                <input class="custom-control-input" value="1" type="radio" id="active" name="active" checked="">
                <label for="active" class="custom-control-label">Có</label>
              </div>
              <div class="custom-control custom-radio">
                <input class="custom-control-input" value="0" type="radio" id="no_active" name="active" >
                <label for="no_active" class="custom-control-label">Không</label>
              </div>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Thêm Camping</button>
  </div>
  @csrf
</form>
@endsection

