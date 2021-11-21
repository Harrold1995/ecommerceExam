@extends('layouts.app')

@section('content')  
    <div class="container">
        <div class="mt-5">
            <h5> My Cart</h5>
            <div class="product-container col-6 mt-5">
            </div>
            <div class="col-6">
                <a href="place-to-order">
                    <button class="btn btn-primary place-order float-end">
                        Place to Order
                    </button>
                </a>                
            </div>
        </div>
    </div>
   
    <script>
        $(function(){

            function item(){
                let products = [];
                if(localStorage.getItem('products') != null && localStorage.getItem('products') != "null"){
                    products = JSON.parse(localStorage.getItem('products'));
                    var tr = "";
                    for(var i=0; products.length > i; i++){
                        tr += "<tr><td id='"+i+"'>"+
                            ' <img src="storage/app/uploads/products/'+products[i].productImage+'" width="150">'+

                        "</td>"+
                        "<td><b>"+products[i].productName+ "</b><br>"+
                            products[i].productDesc+
                        "</td>"+
                        "<td align='right'> $"+products[i].productPrice.toFixed(2)+
                        "<br> <span class='text-danger cursor-pointer remove-from-cart' data-id='"+i+"'>Remove</span>"+
                        "</td>"+
                        "</tr>";
                    }
                    var table = "<table class='table'>"+tr+"</table>";

                    $('.product-container').html(table);

                } 

                if(localStorage.getItem('products') != null && localStorage.getItem('products') != "null"){
                    $('.place-order').prop('disabled', false);
                }else{
                    $('.place-order').prop('disabled', true);
                }
            }
            item();
            

            $(document).on('click', '.remove-from-cart', function(){
                var id = $(this).attr('data-id');
                var products = JSON.parse(localStorage.getItem('products'));

                var array = [];
                for(var i=0; products.length > i; i++){
                    if(i != id){
                        array.push(products[i]);
                    }
                }
                localStorage.setItem('products', JSON.stringify(array));    
                
                $.toast({
                    heading: 'Item removed',
                    hideAfter: false,
                    icon: 'success'
                });
                item();
                
            });
        })
    </script>
@endsection