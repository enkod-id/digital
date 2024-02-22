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
            <div class="col-8">
                <div class="row">
                    @foreach($products as $product)
                    <div class="col-2">
                        <div class="card">
                            <img class="card-img-top img-fluid" src="assets/images/small/img-1.jpg" alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title font-16 mt-0"> {{ Str::limit($product->name, 10) }}</h4>
                                <p class="card-text">{{ Str::limit($product->name, 10) }}</p>
                                <a href="#" class="btn btn-primary waves-effect waves-light">Add to Cart</a>
                            </div>
                        </div>

                    </div>
                    @endforeach
                </div>
                
               
               
               
            </div>    

            <div class="col-4">

            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
        
    </div>
    <!-- container-fluid -->

</div>

@stop