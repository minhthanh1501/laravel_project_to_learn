@extends('layouts/admin')

@section('title')
    Trang Chủ
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
        @include('components.content-header',[
            'name' => 'Menu',
            'key' => 'List'
        ])
      <!-- /.content-header -->
  
      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <a href="{{ route('menus.create') }}" class="btn btn-success float-right m-2">Add</a>
            </div>
            <div class="col-md-12">
              <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">Index</th>
                    <th scope="col">Tên danh mục</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                @foreach ($menus as $menu)
                <tbody>
                  <tr>
                    <th>{{ $menu['id'] }}</th>
                    <td>{{ $menu['name'] }}</td>
                    <td>
                      <a href="{{ route('menus.edit',['id' => $menu['id']]) }}" class="btn btn-warning">Edit</a>
                      <a href="{{ route('menus.delete',['id' => $menu['id']]) }}" class="btn btn-danger">Delete</a>
                      
                    </td>
                  </tr>
                </tbody>
                @endforeach
                
              </table>
            </div>
            <div class="col-md-12">
              {{ $menus->links() }}
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

    