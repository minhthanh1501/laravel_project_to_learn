@extends('layouts/admin')

@section('title')
    Thêm Sản Phẩm
@endsection


@section('css')
    <link href="{{ asset('vendors/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admins/product/add/add.css') }}" rel="stylesheet" />
@endsection



@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('components.content-header', [
            'name' => 'Product',
            'key' => 'Add',
        ])
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <form method="post" action="{{ route('products.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Tên sản phẩm</label>
                                <input type="text" name="name" class="form-control" placeholder="Nhập tên sản phẩm">
                            </div>

                            <div class="form-group">
                                <label>Giá sản phẩm</label>
                                <input type="text" name="price" class="form-control" placeholder="Nhập giá sản phẩm">
                            </div>

                            <div class="form-group">
                                <label>Hình ảnh đại diện</label>
                                <input type="file" name="feature_image_path" class="form-control-file">
                            </div>

                            <div class="form-group">
                                <label>Hình ảnh chi tiết</label>
                                <input type="file" multiple name="image_path[]" class="form-control-file">
                            </div>

                            <div class="form-group">
                                <label>Chọn danh mục</label>
                                <select name="category_id" class="form-control select2_init">
                                    <option value="0">Chọn danh mục</option>
                                    {!! $htmlOption !!}

                                </select>
                            </div>
                            <div class="form-group">
                                <label>Nhập tags cho sản phẩm</label>
                                <select name="tags[]" class="form-control tags_select_choose" multiple="multiple">

                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Nội dung sản phẩm</label>
                                <textarea class="form-control tinymce_editor_init" id="exampleFormControlTextarea1" name="content" rows="3"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>

    <!-- /.content-wrapper -->
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.2.2/tinymce.min.js" referrerpolicy="origin"></script>

    <script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
    <script src="{{ asset('admins/product/add/add.js') }}"></script>
@endsection
