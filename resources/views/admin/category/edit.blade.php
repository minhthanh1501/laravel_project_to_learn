@extends('layouts/admin')

@section('title')
    Cập Nhật Sản Phẩm
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('components.content-header',[
          'name' => 'Category',
          'key' => 'Edit'
        ])
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <form method="post" action="{{ route('categories.update',['id' => $category['id']]) }}">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label>Tên danh mục</label>
                                <input type="text" name="name" class="form-control" placeholder="Nhập tên danh mục" value="{{ $category['name'] }}">
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Chọn danh mục cha</label>
                                <select name="parent_id" class="form-control">
                                    <option value="">Chọn danh mục cha</option>
                                    {!! $htmlOption !!}
                                    
                                </select>
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
