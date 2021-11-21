@extends('layouts.app')

@section('content')  
    <div class="container">
        <div class="mt-5">
            <h5> Order List</h5>
            <div class="product-container col-6 mt-5">
            </div>
            <div class="col-6">
                @foreach($orders as $v)

                    <div class="card mt-5" style="width: 50rem;">
                        <div class="p-2">
                            <div class="row">                            
                                <div class="col-sm-6">
                                    <b>Order number: {{$v->id}}</b>
                                </div>
                                <div class="col-sm-6">
                                    <p class="text-end">Date : {{date('Y-m-d',strtotime($v->created_at))}}</p>
                                </div>
                            </div>                           
                          
                        </div>
                        <div class="row">                            
                            <div class="col-sm-4">
                                <a href="storage/app/uploads/products/{{$v->productImage}}"  target="blank">
                                    <img src="storage/app/uploads/products/{{$v->productImage}}" width="200">
                                </a>
                                <div class="card-body">
                                    <h5 class="card-title">{{$v->productName}}</h5>
                                    <p class="card-text">$ {{ number_format($v->productPrice, 2)}}</p>
                                    
                                </div>
                            </div>
                            <div class="col-sm-8">
                                 <h5 class="card-title">Ship to:</h5>
                                 <p class="card-title">{{$v->customerName}}</p>
                                 <p class="card-title">{{$v->mobile}}</p>
                                 <p class="card-title">{{$v->address}}</p>
                                 <p class="card-title"> Mode of payment: {{$v->modeOfPayment}}</p>
                            </div>
                        </div>
                       
                    </div>
                @endforeach
            </div>
        </div>
    </div>
   
    <script>
        $(function(){

           
        })
    </script>
@endsection