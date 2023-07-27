@extends('layouts/admin')

@section('title')
    Sửa Sản Phẩm
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
            'key' => 'Edit',
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
                                <input type="text" name="name" class="form-control" placeholder="Nhập tên sản phẩm" value="{{ $product['name'] }}">
                            </div>

                            <div class="form-group">
                                <label>Giá sản phẩm</label>
                                <input type="text" name="price" class="form-control" placeholder="Nhập giá sản phẩm" value="{{ $product['price'] }}">
                            </div>

                            <div class="form-group">
                                <label>Hình ảnh đại diện</label>
                                <input type="file" name="feature_image_path" class="form-control-file" >
                                <div class="col-md-4 feature_image_container">
                                    <div class="row">
                                        <img class="" src="{{ $product['feature_image_path'] }}" alt="">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Hình ảnh chi tiết</label>
                                <input type="file" multiple name="image_path[]" class="form-control-file">
                                <div class="col-md-12 feature_image_detail">
                                    <div class="row">
                                        @foreach ($product->productImages as $productImageItem)
                                            <div class="col-md-3">
                                                <img class="image_detail_product" src="{{ $productImageItem['image_path'] }}" alt="">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
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
                                    @foreach ($product->tags as $tagItem)
                                        <option value="{{ $tagItem->id }}"selected>{{ $tagItem->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Nội dung sản phẩm</label>
                                <textarea class="form-control tinymce_editor_init" id="exampleFormControlTextarea1" name="content" rows="3" >{{ $product['content'] }}</textarea>
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
