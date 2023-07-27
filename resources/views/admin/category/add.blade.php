@extends('layouts/admin')

@section('title')
    Thêm danh mục
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('components.content-header',[
          'name' => 'Category',
          'key' => 'Add'
        ])
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <form method="post" action="{{ route('categories.store') }}">
                            @csrf
                            <div class="form-group">
                                <label>Tên danh mục</label>
                                <input type="text" name="name" class="form-control" placeholder="Nhập tên danh mục">
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Chọn danh mục cha</label>
                                <select name="parent_id" class="form-control">
                                    <option value="0">Chọn danh mục cha</option>
                                    {{!! $htmlOption !!}}
                                    
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
