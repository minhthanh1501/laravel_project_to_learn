@extends('layouts/admin')

@section('title')
    Thêm Permission
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('components.content-header',[
          'name' => 'Permission',
          'key' => 'Add'
        ])
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <form method="post" action="{{ route('menus.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Chọn module</label>
                                <select name="parent_id" class="form-control">
                                    <option value="0">chọn tên module</option>
                                    @foreach (config('permissions.table_module') as $moduleItem)
                                    <option value="{{ $moduleItem }}">{{ $moduleItem }}</option>
                                    @endforeach
                                </select>
                               
                                
                            </div>

                            <div class="form-group">
                                <div class="row">

                                    @foreach (config('permissions.module_childrent') as $moduleItemChildrent)
                                    <div class="col-md-3">
                                        <label for="">
                                            <input type="checkbox" name="{{ $moduleItemChildrent }}" id="" value="{{ $moduleItemChildrent }}">
                                            {{ $moduleItemChildrent }}
                                        </label>
                                    </div>
                                    @endforeach

                                </div>
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
