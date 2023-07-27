@extends('layouts/admin')

@section('title')
    Product
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('admins/product/index/list.css') }}">
@endsection

@section('js')
    
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
        @include('components.content-header',[
            'name' => 'Product',
            'key' => 'List'
        ])
      <!-- /.content-header -->
  
      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <a href="{{ route('products.create') }}" class="btn btn-success float-right m-2">Add</a>
            </div>
            <div class="col-md-12">
              <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">Index</th>
                    <th scope="col">Tên sản phẩm</th>
                    <th scope="col">Giá</th>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Danh mục</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                @foreach ($products as $product)
                <tbody>
                  <tr>
                    <th>{{ $product['id'] }}</th>
                    <td>{{ $product['name'] }}</td>
                    <td>{{ number_format($product['price']) }}</td>
                    <td><img class="product_image_150_100" src="{{ $product['feature_image_path'] }}" alt=""></td>
                    <td>{{ optional($product->category)->name }}</td>
                    <td>
                      <a href="{{ route('products.edit',['id' => $product['id']]) }}" class="btn btn-warning">Edit</a>
                      <a href="{{ route('products.delete',['id' => $product['id']]) }}" class="btn btn-danger">Delete</a>
                      
                    </td>
                  </tr>
                </tbody>
                @endforeach
                
              </table>
            </div>
            <div class="col-md-12">
              {{ $products->links() }}
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

    