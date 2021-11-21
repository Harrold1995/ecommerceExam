<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use App\Models\product;
use App\Models\order;
use App\Models\customer;
class ProductController extends Controller
{
    public function home(){

      $product = new product;

      $data['products'] = $product::get();

      return view('welcome', $data);
    }
    public function myCart(){
      return view('cart.cartlist');
    }

    public function addproduct(){
      return view('addproducts.addproducts');
    }
    public function submitproduct(Request $request){
      $file_name = "";
        if($request->file('file_upload')){
            $file = $request->file('file_upload');
            $destinationPath = storage_path('app/uploads/products/');
            if(!is_dir($destinationPath)){
                Storage::makeDirectory('uploads/products/', 0755, true);
            }
            $file->move($destinationPath, date('Ymd').'_'.date('His').'_'.$file->getClientOriginalName());
            $file_name =  date('Ymd').'_'.date('His').'_'.$file->getClientOriginalName();
        }

        $product = new product;
        $product->productImage = $file_name;
        $product->productName = $request->productName;
        $product->productPrice = $request->productPrice;
        $product->productDesc = $request->productDesc;
        $product->save();
        
        $request->session()->flash('message', 'Product successfully added');

       return redirect()->back();

    }
    public function updateProduct(Request $request){
     
        $product = new product;
        $product= $product::find($request->id);
        $product->productName = $request->productName;
        $product->productPrice = $request->productPrice;
        $product->productDesc = $request->productDesc;
        $product->save();
        
        $request->session()->flash('message', 'Product successfully updated');

       return redirect()->back();

    }

    public function delete($id){
        $product = new product;
        $product::where('id', $id)->delete();

        return redirect()->back();
    }

    public function placeToOrder(){

        return view('orders.placetoorder');
    }

    public function placeOrder(Request $request){
    
        $customer = new customer;
        $customer->customerName = $request->customerName;
        $customer->email = $request->email;
        $customer->mobile = $request->mobile;
        $customer->address = $request->address;
        $customer->modeOfPayment = $request->modeOfPayment;
        $customer->save();

        $orderItem =  json_decode($request->orderData);
        // echo @$orderItem[0]->productPrice;
        // dd($request->all());
        $count = count($orderItem);
        for($i = 0;  $count > $i; $i++){
          $order = new order;
          $order->customerID = $customer->id;
          $order->productImage = @$orderItem[$i]->productImage;
          $order->productName =  @$orderItem[$i]->productName;
          $order->productPrice = @$orderItem[$i]->productPrice;
          $order->productDesc = @$orderItem[$i]->productDesc;
          $order->save();
        }       

        return redirect()->back();

    }

    public function orderList(){


      $customer = new customer;

      $data['orders'] = $customer::leftJoin('orders', 'orders.customerID', '=', 'customers.id')
      ->orderBy('customers.created_at', 'DESC')
      ->get();
      return view('orders.orderlist', $data);

    }
}
