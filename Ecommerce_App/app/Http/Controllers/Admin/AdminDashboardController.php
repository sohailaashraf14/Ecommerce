<?php

// app/Http/Controllers/Admin/AdminDashboardController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;


class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }
        $productCount = $query->count();
        $products = $query->latest()->get();
        $categories = Category::all();

        return view('admin.dashboard', compact( 'productCount', 'products', 'categories'));
    }
}
