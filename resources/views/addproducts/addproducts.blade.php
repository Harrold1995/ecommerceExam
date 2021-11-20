@extends('layouts.app')

@section('content')  
    <div class="container">
        <div class="mt-5">
            <h3> Add Product</h3>
            <form class="mt-5" action="submit-product" method="post">      
                @csrf <!-- {{ csrf_field() }} -->       
                <div class="row g-3 align-items-center">
                    <div class="col-auto">
                        <label for="productImage" class="col-form-label">Product Image:</label>
                    </div>
                    <div class="col-auto">
                          <input type="file" name="productImage"  accept="image/*" required>
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
                        <label for="productName" class="col-form-label">Product Price:</label>
                    </div>
                    <div class="col-3">
                           <input type="text" name="productPrice" class="form-control" id="productPrice" required>
                    </div>
                </div>
                <div class="mt-4 col-6">
                    <label for="exampleInputEmail1" class="form-label">Product description</label>
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
@endsection