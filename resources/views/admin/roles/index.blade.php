@extends('layouts/admin')

@section('title')
    Trang Chủ
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
        @include('components.content-header',[
            'name' => 'Role',
            'key' => 'List'
        ])
      <!-- /.content-header -->
  
      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <a href="{{ route('roles.create') }}" class="btn btn-success float-right m-2">Add</a>
            </div>
            <div class="col-md-12">
              <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">Index</th>
                    <th scope="col">Tên vai trò</th>
                    <th scope="col">Mô tả vai trò</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                @foreach ($roles as $role)
                <tbody>
                  <tr>
                    <th>{{ $role['id'] }}</th>
                    <td>{{ $role['name'] }}</td>
                    <td>{{ $role['display_name'] }}</td>
                    <td>
                      <a href="{{ route('roles.edit',['id' => $role['id']]) }}" class="btn btn-warning">Edit</a>
                      <a href="{{ route('roles.delete',['id' => $role['id']]) }}" class="btn btn-danger">Delete</a>
                      
                    </td>
                  </tr>
                </tbody>
                @endforeach
                
              </table>
            </div>
            <div class="col-md-12">
              {{ $roles->links() }}
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

    