@extends('layouts.app')

@section('content')  
    <div class="container">
        <div class="mt-5">
            <h5> Home/ Products</h5>
            @if(Session::has('message'))
            <p id="message" class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message') }}</p>
            @endif
            <div class="row">
                @foreach($products as $v)
                    <div class="col-sm-3">
                         <div class="card mt-3" style="width: 17.3rem;">
                                <a href="storage/app/uploads/products/{{$v->productImage}}" target="blank">
                                    <img src="storage/app/uploads/products/{{$v->productImage}}" class="card-img-top" alt="...">
                               </a>
                               <div class="card-body">
                                <h5 class="card-title">{{$v->productName}}</h5>
                                <p class="card-text">{{$v->productDesc}}</p>
                                <p class="card-text">$ {{ number_format($v->productPrice, 2)}}</p>
                                <a href="#" class="btn btn-primary add-cart" data-product="{{json_encode($v)}}" data-id="{{$v->id}}">Add to cart</a>
                                <a href="#" class="btn btn-info edit" data-product="{{json_encode($v)}}" data-id="{{$v->id}}">Edit</a>
                                <a href="delete/{{$v->id}}" class="btn btn-danger edit">Delete</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form class="" action="update-product" method="post"> 
            <div class="modal-body">
            
                    @if(Session::has('message'))
                    <p id="message" class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message') }}</p>
                    @endif
                    @csrf <!-- {{ csrf_field() }} -->     
                    <!-- <div class="row g-3 align-items-center">
                        <div class="col-auto">
                            <label for="file_upload" class="col-form-label">Change Image:</label>
                        </div>
                        <div class="col-auto">
                          
                            <input type="file" class="file_upload" name="file_upload"  accept="image/*" required>
                        </div>
                    </div> -->
                    <input type="hidden" class="id" name="id">
                    <div class="row g-3 align-items-center mt-1">
                        <div class="col-auto">
                            <label for="productName" class="col-form-label">Product Name:</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" name="productName" class="form-control productName" id="productName" required>
                        </div>
                    </div>
                    <div class="row g-4 align-items-center mt-1">
                        <div class="col-auto">
                            <label for="productPrice" class="col-form-label">Product Price:</label>
                        </div>
                        <div class="col-auto">
                            <input type="number" name="productPrice" class="form-control productPrice" id="productPrice" required>
                        </div>
                    </div>
                    <div class="mt-4 col-auto">
                        <label for="productDesc" class="form-label">Product description</label>
                        <textarea rows="" class="form-control productDesc" name="productDesc" cols="" required></textarea>
                    </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
        </div>
    </div>
    </div>
    <script>
        $(function(){
            $('.edit').click(function(){
                var  product = $(this).attr('data-product');
                product = JSON.parse(product);

                $('.id').val(product.id);
                $('.file_upload').val(product.file_upload);
                $('.productName').val(product.productName);
                $('.productPrice').val(product.productPrice);
                $('.productDesc').val(product.productDesc);

                var myModal = new bootstrap.Modal(document.getElementById('editModal'), {
                keyboard: false
                });
                myModal.show();
            });
            $('.add-cart').click(function(){
                var product = $(this).attr('data-product');
                product = $.parseJSON(product);

                let products = [];
                if(localStorage.getItem('products') != null && localStorage.getItem('products') != "null"){
                    products = JSON.parse(localStorage.getItem('products'));
                }               
                
                products.push(product);
                localStorage.setItem('products', JSON.stringify(products));    
                $.toast({
                    heading: '1 item added to cart',
                    text: 'Check your <a href="cart">Cart</a>.',
                    hideAfter: false,
                    icon: 'success'
                })                          
            });
        })
    </script>
@endsection