@extends('layouts/admin')

@section('title')
    Thêm Setting
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('components.content-header', [
            'name' => 'Setting',
            'key' => 'Add',
        ])
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <form method="post" action="{{ route('settings.store') . '?type=' .request()->type  }}">
                            @csrf
                            <div class="form-group">
                                <label>Config Key </label>
                                <input type="text" name="config_key"
                                    class="form-control @error('config_value') is-invalid @enderror"
                                    placeholder="Nhập config key" value="{{ old('config_key') }}">
                                @error('config_value')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            @if (request()->type === 'Text')
                                <div class="form-group">
                                    <label>Config Value </label>
                                    <input type="text" name="config_value"
                                        class="form-control @error('config_value') is-invalid @enderror"
                                        placeholder="Nhập config value" value="{{ old('config_value') }}">
                                    @error('config_value')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            @elseif(request()->type === 'Textarea')
                                <div class="form-group">
                                    <label>Config Value </label>
                                    <textarea name="config_value"  class="form-control @error('config_value') is-invalid @enderror">{{ old('config_value') }}</textarea>
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
