<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

// Route::get('/getData', function () {
//     $data=file_get_contents('https://fakestoreapi.com/products');
//     $json_data=json_decode($data);

    // foreach($json_data as $alldata){
    //     if($alldata->price>=100){
    //         echo $alldata->price ;
    //         echo "<br>";
    //     }
    // }
//     $result=array_filter($json_data,fn($i)=> $i->price <50);
//     dd($result);
// });

// Route::get('/getDatahttp',function(){
//     $data=Http::get('https://fakestoreapi.com/products');
//     $result=$data->json();
//     // $result=$data->object();
//     // $result=collect($data)->where("price","<",10)->toArray();
//     dd($result);
// });
// Route::post('/postTest/{id}/{name}',[CustomerController::class,'index'])->name('postTest');

// Route::view('/usr/register',"layouts.register");
Route::get('/',[PostController::class,"index"]);
Route::post('/',[PostController::class,"create"])->name('create');
Route::get('/customer/delete/{id}',[PostController::class,'delete'])->name('customer.delete');
Route::get('/customer/edit/{id}',[PostController::class,'edit'])->name('customer.edit');
Route::put('/customer/update/{id}',[PostController::class,'update'])->name('customer.update');


