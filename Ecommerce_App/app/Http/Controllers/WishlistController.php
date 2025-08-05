<?php

// app/Http/Controllers/WishlistController.php
namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $items = Wishlist::where('user_id', Auth::id())->with('product')->get();
        return view('user.wishlist.index', compact('items'));
    }

    public function store(Request $request)
    {
        $product_id = $request->input('product_id');

        $exists = Wishlist::where('user_id', auth()->id())
            ->where('product_id', $product_id)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('info', 'This product is already in your wishlist.');
        }

        Wishlist::create([
            'user_id' => auth()->id(),
            'product_id' => $product_id,
        ]);

        return redirect()->back()->with('success', 'Product added to wishlist!');
    }

    public function destroy($id)
    {
        Wishlist::where('id', $id)->where('user_id', Auth::id())->delete();
        return redirect()->back()->with('success', 'Removed from wishlist.');
    }
    public function addToCartAndRemove(Wishlist $wishlistItem)
    {
        $user = auth()->user();
        $product = $wishlistItem->product;

        // Check if already in cart
        $existingCartItem = CartItem::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->first();

        if ($existingCartItem) {
            $existingCartItem->increment('quantity');
        } else {
            CartItem::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'quantity' => 1,
            ]);
        }

        // Remove from wishlist
        $wishlistItem->delete();

        return redirect()->back()->with('success', 'Product added to cart and removed from wishlist.');
    }


}
