@extends('layouts.app')

@section('content')  
    <div class="container">
        <div class="mt-5">
            <h5> Shipping Option </h5>
            <form class="mt-5"  action="place-order" method="post" onsubmit="submitForm();">  
                <div class="product-container col-6 mt-5">            
                    @if(Session::has('message'))
                    <p id="message" class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message') }}</p>
                    @endif
                    @csrf <!-- {{ csrf_field() }} -->       
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Customer Name:</label>
                        <input type="hidden" name="orderData" class="form-control orderData" id="orderData" required>
                        <input type="text" name="customerName" class="form-control" id="customerName" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address:</label>
                        <input type="email" name="email" class="form-control" id="email" required>
                    </div>
                    <div class="mb-3 col-5">
                        <label for="mobile" class="form-label">Mobile Number:</label>
                        <input type="number"  name="mobile" class="form-control" id="mobile" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address:</label>
                        <input type="text" name="address" class="form-control" id="address" required>
                    </div>                
                </div>                
                <h5 class="mt-5"> Payment Option </h5>
                <div class="product-container col-6 mt-5">
                <div class="mb-3">
                        <label for="address" class="form-label">Mode of payment:</label>
                        <select name="modeOfPayment" class="form-control">
                            <option value="COD" required>
                                Cash on delivery (COD)
                            </option>
                        </select>
                    </div>
                </div>
                <div class="mt-5">
                    <button class="btn btn-primary">
                        Submit
                    </button>
                </div>
            </form>
        
        </div>
    </div>
   
    <script>
        function submitForm(){
            localStorage.removeItem("products");
            return false;  
        }
        $(function(){
            var products = JSON.parse(localStorage.getItem('products'));
            $('.orderData').val(JSON.stringify(products));
            
        })
    </script>
@endsection