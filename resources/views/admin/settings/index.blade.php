@extends('layouts/admin')

@section('title')
    Setting
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('admins/setting/index/list.css') }}">
@endsection

@section('js')
    <script src="{{ asset('vendors/sweetAlert2/sweetalert2@11.js') }}"></script>
    <script src="{{ asset('admins/slider/index/list.js') }}"></script>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('components.content-header', [
            'name' => 'Setting',
            'key' => 'List',
        ])
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-11">
                        <div class="btn-group float-right">
                            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                Add Setting
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('settings.create') . '?type=Text' }}">Text</a></li>
                                <li><a href="{{ route('settings.create') . '?type=Textarea' }}">Textarea</a></li>
                            </ul>
                        </div>
                        {{-- <a href="{{ route('settings.create') }}" class="btn btn-success float-right m-2">Add</a> --}}
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Index</th>
                                    <th scope="col">Config_key</th>
                                    <th scope="col">Config_value</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            @foreach ($settings as $setting)
                                <tbody>
                                    <tr>
                                        <th>{{ $setting['id'] }}</th>
                                        <td>{{ $setting['config_key'] }}</td>
                                        <td>{{ $setting['config_value'] }}</td>
                                        <td>
                                            <a href="{{ route('settings.edit', ['id' => $setting['id']]) . '?type=' . $setting['type'] }}"
                                                class="btn btn-warning">Edit</a>
                                            <a href=""
                                                data-url="{{ route('settings.delete', ['id' => $setting['id']]) }}"
                                                class="btn btn-danger action_delete">Delete</a>

                                        </td>
                                    </tr>
                                </tbody>
                            @endforeach

                        </table>
                    </div>
                    <div class="col-md-12">
                        {{ $settings->links() }}
                    </div>

                    <!-- /.col-md-6 -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
