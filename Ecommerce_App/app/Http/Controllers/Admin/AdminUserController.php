<?php

namespace app\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;

class AdminUserController extends Controller
{
    public function dashboard(){
        $ProductCount=Product::count();
        $products=Product::latest()->get();
        return view('admin.dashboard',compact('products','ProductCount'));
    }

}
