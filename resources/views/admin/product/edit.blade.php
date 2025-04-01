@extends('admin.main')


@section('content')
@yield('content')
<form action="" method="POST">
  <div class="card-body">
        <div class="row">
          <div class="col-md-6">
              <div class="form-group">
                  <label for="">Tên Sản Phẩm</label>
                  <input type="text" name="name" value="{{ $product->name }}"
                    class="form-control" placeholder="Nhập tên sản phẩm">
              </div>
          </div>
          <div class="col-md-6">
              <div class="form-group">
                  <label for="parent_id">Danh Mục</label>
                  <select class="form-control" name="menu_id">
                    @foreach ($menus as $menu)
                    <option value="{{$menu->id}}"
                        {{ $product->menu_id == $menu->id ? 'selected' : '' }}
                        > {{$menu->name}} </option>
                @endforeach
                  </select>
              </div>
          </div>
      </div>

        <div class="row">
          <div class="col-md-6">
              <div class="form-group">
                  <label for="">Giá</label>
                  <input type="number" name="price" value="{{ $product->price }}" class="form-control">
              </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="">Ưu Đãi</label>
              <input type="number" name="price_sale" value="{{ $product->price_sale }}"
                class="form-control">
          </div>
          </div>
      </div>

      <div class="form-group">
        <label >Mô Tả</label>
        <textarea name="description" class="form-control">{{ $product->description }}</textarea>
      </div>

      <div class="form-group">
        <label >Mô Tả Chi Tiết</label>
        <textarea name="content" id="content" class="form-control">{{ $product->content }}</textarea>
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
                <a href="{{ $product->thumb }}" target="_blank">
                    <img src="{{ $product->thumb }}" width="100px">
                </a>
          </div>
          <input type="hidden" value="{{ $product->thumb }}" name="thumb" id="thumb">
          <hr>
        </div>
      </div>

      <div class="col-sm-6">
            <label>Kích Hoạt</label>
            <!-- radio -->
            <div class="form-group">
              <div class="custom-control custom-radio">
                <input class="custom-control-input"
                    value="1" type="radio" id="active" name="active" 
                    {{ $product->active == 1 ? 'checked=""' : '' }}>
                <label for="active" class="custom-control-label">Có</label>
              </div>
              <div class="custom-control custom-radio">
                <input class="custom-control-input" 
                    value="0" type="radio" id="no_active" name="active" 
                    {{ $product->active == 0 ? 'checked=""' : '' }}>
                <label for="no_active" class="custom-control-label">Không</label>
              </div>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Cập Nhật Sản Phẩm</button>
  </div>
  @csrf
</form>
@endsection

