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

            <div class="col-4 border">

            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
        
    </div>
    <!-- container-fluid -->

</div>
<script>
    // Fungsi untuk mendapatkan data produk dari server
    function fetchData() {
        fetch('/get-products') // Ganti dengan URL endpoint yang sesuai
            .then(response => response.json())
            .then(data => {
                // Setiap produk dalam data
                data.forEach(product => {
                    // Buat elemen untuk menampilkan produk
                    const productElement = document.createElement('div');
                    productElement.classList.add('product');
                    productElement.innerHTML = `
                        <h3>${product.name}</h3>
                        <p>$${product.price}</p>
                        <a href="#" class="btn btn-primary waves-effect waves-light add-to-cart">Add to Cart</a>
                    `;
                    
                    // Tambahkan event listener untuk tombol "Add to Cart"
                    const addToCartButton = productElement.querySelector('.add-to-cart');
                    addToCartButton.addEventListener('click', () => {
                        addToCart(product);
                    });

                    // Tambahkan produk ke dalam kolom produk
                    document.getElementById('product-column').appendChild(productElement);
                });
            })
            .catch(error => console.error('Error fetching data:', error));
    }

    // Fungsi untuk menambahkan produk ke dalam keranjang belanja
    function addToCart(product) {
        // Buat elemen baru untuk produk yang ditambahkan ke keranjang
        const cartItem = document.createElement('div');
        cartItem.innerHTML = `${product.name} - $${product.price}`;

        // Tambahkan produk ke dalam kolom keranjang belanja
        document.getElementById('cart-column').appendChild(cartItem);
    }

    // Panggil fungsi fetchData saat halaman dimuat
    window.onload = function() {
        fetchData();
    };
</script>
@stop