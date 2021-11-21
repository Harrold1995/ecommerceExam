<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [ProductController::class, 'home']);
Route::get('add-product', [ProductController::class, 'addproduct']);
Route::post('submit-product', [ProductController::class, 'submitproduct']);
Route::post('update-product', [ProductController::class, 'updateProduct']);
Route::get('my-cart', [ProductController::class, 'myCart']);
Route::get('delete/{id}', [ProductController::class, 'delete']);
Route::get('place-to-order', [ProductController::class, 'placeToOrder']);
Route::post('place-order', [ProductController::class, 'placeOrder']);
Route::get('order-list', [ProductController::class, 'orderList']);
Route::get('storage/app/{path}/{products}/{filename}',function ($path, $products, $filename){

    $path = storage_path('app/' . $path . '/'. $products . '/'. $filename);
        $file = File::get($path);
        $type = File::mimeType($path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
    return $response;
});
