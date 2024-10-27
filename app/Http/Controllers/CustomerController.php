<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request,$id,$name){
        $data=[
            'name'=>$request->username,
            'email'=>$request->useremail
        ];
        echo $id ;
        echo $name;
        return $data;
    }
}
