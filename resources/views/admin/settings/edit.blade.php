@extends('layouts/admin')

@section('title')
    Cập Nhật setting
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('components.content-header', [
            'name' => 'Setting',
            'key' => 'Edit',
        ])
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <form method="post" action="{{ route('settings.update', ['id' => $setting['id']]) }}">
                            @csrf
                            {{-- @method('put') --}}
                            <div class="form-group">
                                <label>Config Key</label>
                                <input type="text" name="config_key" class="form-control" 
                                    value="{{ $setting['config_key'] }}">
                            </div>

                            @if (request()->type === 'Text')
                                <div class="form-group">
                                    <label>Config Value </label>
                                    <input type="text" name="config_value"
                                        class="form-control @error('config_value') is-invalid @enderror"
                                        placeholder="Nhập config value" value="{{ $setting['config_value'] }}">
                                    @error('config_value')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            @elseif(request()->type === 'Textarea')
                                <div class="form-group">
                                    <label>Config Value </label>
                                    <textarea name="config_value" class="form-control @error('config_value') is-invalid @enderror">{{ $setting['config_value'] }}</textarea>
                                    @error('config_value')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endif

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
