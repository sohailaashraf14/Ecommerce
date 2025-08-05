<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $categoryId = request('category');

        $products = Product::query();

        if ($categoryId) {
            $products->where('category_id', $categoryId);
        }

        $products = $products->latest()->get();

        return view('user.home', compact('products', 'categories'));
    }


public function show(Product $product)
{
    return view('user.products.show', compact('product'));

}
}
