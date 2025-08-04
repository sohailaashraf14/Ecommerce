<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
class AdminController extends Controller
{
  public function dashboard(){
      $ProductCount=Product::count();
      $products=Product::all();
      return view('admin.dashboard',compact('ProductCount','products'));
  }

}
