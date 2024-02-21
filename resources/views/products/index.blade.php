@extends('home')
@section('content')
<div class="content">

    <div class="container-fluid">
        <div class="page-title-box">

            <div class="row align-items-center ">
                <div class="col-md-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Dashboard</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Product</li>
                        </ol>
                    </div>
                </div>

               
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-3">
                @include('modals.product_create')
            </div>
        </div>
      
       
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Stock</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                
                                @foreach($products as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ optional($product->category)->name }}</td> <!-- Menggunakan optional() untuk menghindari kesalahan jika kategori null -->
                                    <td>{{ number_format($product->price, 0, ',', '.') }}</td>
                                    <td>{{ $product->status }}</td>
                                   <td>{{ $product->stock }}</td>
                                    
                                   <td>
                                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary" style="display: inline-block;">Detail</a>

                                    @include('modals.product_edit')

                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                                </tr>
                            @endforeach
                               
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
        
    </div>
    <!-- container-fluid -->

</div>

@stop