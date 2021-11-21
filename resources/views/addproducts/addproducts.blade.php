@extends('layouts.app')

@section('content')  
    <div class="container">
        <div class="mt-5">
            <h3> Add Product</h3>
            <form class="mt-5" action="submit-product" method="post" enctype="multipart/form-data">  
                @if(Session::has('message'))
                <p id="message" class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message') }}</p>
                @endif
                @csrf <!-- {{ csrf_field() }} -->       
                <div class="row g-3 align-items-center">
                    <div class="col-auto">
                        <label for="file_upload" class="col-form-label">Product Image:</label>
                    </div>
                    <div class="col-auto">
                          <input type="file" name="file_upload"  accept="image/*" required>
                    </div>
                </div>
                <div class="row g-3 align-items-center mt-1">
                    <div class="col-auto">
                        <label for="productName" class="col-form-label">Product Name:</label>
                    </div>
                    <div class="col-5">
                           <input type="text" name="productName" class="form-control" id="productName" required>
                    </div>
                </div>
                <div class="row g-4 align-items-center mt-1">
                    <div class="col-auto">
                        <label for="productPrice" class="col-form-label">Product Price:</label>
                    </div>
                    <div class="col-3">
                           <input type="number" name="productPrice" class="form-control" id="productPrice" required>
                    </div>
                </div>
                <div class="mt-4 col-6">
                    <label for="productDesc" class="form-label">Product description</label>
                    <textarea rows="" class="form-control" name="productDesc" cols="" required></textarea>
                </div>
                <div class="mt-3">
                    <button class="btn btn-primary">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(function(){
            setTimeout(function(){
              $('#message').hide();
            }, 3000);
        })
    </script>
@endsection