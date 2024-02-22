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
                            <li class="breadcrumb-item active">Category</li>
                        </ol>
                    </div>
                </div>

               
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-3">
               
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
                                    <th>Description</th>
                                   
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                
                                @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->description }}</td>
                                   
                                    
                                   <td>
                                    

                                    <a href="{{ route('category.edit', $category->id) }}" class="btn btn-warning" style="display: inline-block;">Edit</a>

                                    <form action="{{ route('category.destroy', $category->id) }}" method="POST" style="display: inline-block;">
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