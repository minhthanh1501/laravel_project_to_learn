@extends('layouts/admin')

@section('title')
    Slider
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('admins/product/index/list.css') }}">
@endsection

@section('js')
    <script src="{{ asset('vendors/sweetAlert2/sweetalert2@11.js') }}"></script>
    <script src="{{ asset('admins/product/index/list.js') }}"></script>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('components.content-header', [
            'name' => 'Slider',
            'key' => 'List',
        ])
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ route('sliders.create') }}" class="btn btn-success float-right m-2">Add</a>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Index</th>
                                    <th scope="col">Tên Slider</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Hình ảnh</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            @foreach ($sliders as $slider)
                                <tbody>
                                    <tr>
                                        <th>{{ $slider['id'] }}</th>
                                        <td>{{ $slider['name'] }}</td>
                                        <td>{{ $slider['description'] }}</td>
                                        <td><img class="product_image_150_100" src="{{ $slider['image_path'] }}"
                                                alt=""></td>
                                        <td>
                                            <a href="{{ route('sliders.edit', ['id' => $slider['id']]) }}"
                                                class="btn btn-warning">Edit</a>
                                            <a href="" 
                                                data-url="{{ route('sliders.delete',['id' => $slider['id']]) }}"
                                                class="btn btn-danger action_delete">Delete</a>

                                        </td>
                                    </tr>
                                </tbody>
                            @endforeach

                        </table>
                    </div>
                    <div class="col-md-12">
                        {{ $sliders->links() }}
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
