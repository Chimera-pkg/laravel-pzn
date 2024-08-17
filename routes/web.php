<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pzn', function(){
    return "P INFO GAN";
});

Route::redirect('/youtube', '/pzn');

Route::fallback(function(){
    return "Halaman tidak ditemukan woi anjirlah";
});

Route::view('/hello', 'hello', ['name'=> 'YANTO']);

Route::get('/hello-again', function(){
    return view('hello', ['name' => 'YANTO awokwkpk']);
});

Route::get('/hello-world', function(){
    return view('hello.world', ['name' => 'YANTO awokwkpk']);
});

Route::get('/products/{id}', function($productId){
    return "Product  $productId";
});

Route::get('/products/{product}/items/{item}', function($productId, $itemId){
    return "Product $productId, Item $itemId";
});

Route::get('/categories/{id}', function ($categoryId){
    return "Category $categoryId";
})->where('id', 
'[0-9]+');

Route::get('/users/{id?}', function($userId = '404'){
    return "User $userId";
});