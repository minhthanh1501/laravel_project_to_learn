@extends('layouts/admin')

@section('title')
    Thêm Role
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('admins/role/add/add.css') }}">
@endsection

@section('js')
    <script src="{{ asset('admins/role/add/add.js') }}"></script>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('components.content-header', [
            'name' => 'Role',
            'key' => 'Add',
        ])
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <form method="post" action="{{ route('roles.store') }}" enctype="multipart/form-data" style="width: 100%">
                        <div class="col-md-12">

                            @csrf
                            <div class="form-group">
                                <label>Tên slider</label>
                                <input type="text" name="name" class="form-control " placeholder="Nhập tên vai trò"
                                    value="{{ old('name') }}">
                            </div>

                            <div class="form-group">
                                <label>Mô tả vai trò</label>
                                <Textarea name="display_name" class="form-control  ">{{ old('display_name') }}</Textarea>
                            </div>

                        </div>

                        <div class="col-md-12">
                            <div class="row">
                                @foreach ($permissionsParent as $permissionsParentItem)
                                    <div class="card border-primary mb-3 col-md-12">

                                        <div class="card-header">
                                            <label for="">
                                                <input type="checkbox" name="" value="" class="checkbox_wrapper">
                                            </label>
                                            Module {{ $permissionsParentItem['name'] }}
                                        </div>

                                        <div class="row">
                                            @foreach ($permissionsParentItem->permissionsChildrent as $permissionsChildrent)
                                                <div class="card-body text-primary col-md-3">
                                                    <h5 class="card-title">
                                                        <label for="">
                                                            <input type="checkbox" class="checkbox_childrent" name="permission_id[]" value="{{ $permissionsChildrent['id'] }}">
                                                        </label>
                                                        {{ $permissionsChildrent['name'] }}
                                                    </h5>
                                                </div>
                                            @endforeach
                                        </div>

                                    </div>
                                @endforeach



                            </div>



                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>

        <!-- /.content-wrapper -->
    </div>
@endsection
