<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\CartItem;
use App\Models\Order;

class PaymentController extends Controller
{
    public function pay(Request $request)
    {
        $user = Auth::user();

        // 1. Auth token
        $auth = Http::withOptions(['verify' => false])->post(
            'https://accept.paymob.com/api/auth/tokens',
            ['api_key' => env('PAYMOB_API_KEY')]
        );

        if (!isset($auth['token'])) {
            return back()->with('error', 'Failed to authenticate with Paymob.');
        }

        $token = $auth['token'];

        // 2. Fetch cart
        $cartItems = CartItem::where('user_id', $user->id)->with('product')->get();
        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        // 3. Prepare items
        $items = $cartItems->map(function ($item) {
            return [
                "name"         => $item->product->title,
                "amount_cents" => intval($item->product->price * 100),
                "quantity"     => $item->quantity,
                "description"  => $item->product->description ?? 'Product',
            ];
        })->toArray();

        $totalCents = $cartItems->sum(fn($item) => $item->product->price * $item->quantity * 100);

        // 4. Create Paymob order
        $order = Http::withOptions(['verify' => false])->post(
            'https://accept.paymob.com/api/ecommerce/orders',
            [
                'auth_token'      => $token,
                'delivery_needed' => false,
                'amount_cents'    => $totalCents,
                'currency'        => 'EGP',
                'items'           => $items,
            ]
        );

        if (!isset($order['id'])) {
            return back()->with('error', 'Failed to create Paymob order.');
        }

        $orderId = $order['id'];

        $nameParts = explode(' ', $user->name, 2);
        $firstName = $nameParts[0];
        $lastName = $nameParts[1] ?? $nameParts[0];

        // 5. Generate payment key — with redirect_url
        $paymentKeyResp = Http::withOptions(['verify' => false])->post(
            'https://accept.paymob.com/api/acceptance/payment_keys',
            [
                'auth_token'     => $token,
                'amount_cents'   => $totalCents,
                'expiration'     => 3600,
                'order_id'       => $orderId,
                'currency'       => 'EGP',
                'integration_id' => env('PAYMOB_CARD_INTEGRATION_ID'),
                'redirect_url' => url('/payment/callback'),
                'billing_data'   => [
                    "apartment"       => "NA",
                    "email"           => $user->email,
                    "floor"           => "NA",
                    "first_name"      => $firstName,
                    "last_name"       => $lastName,
                    "street"          => "NA",
                    "building"        => "NA",
                    "phone_number"    => "0123456789",
                    "shipping_method" => "NA",
                    "postal_code"     => "NA",
                    "city"            => "Cairo",
                    "country"         => "EG",
                    "state"           => "NA"
                ]
            ]
        );

        if (!isset($paymentKeyResp['token'])) {
            return back()->with('error', 'Error generating payment key.');
        }

        $paymentToken = $paymentKeyResp['token'];

        return view('payment.test', [
            'iframe_url' => "https://accept.paymob.com/api/acceptance/iframes/" . env('PAYMOB_IFRAME_ID') . "?payment_token=$paymentToken"
        ]);
    }

    // ✅ Handles Paymob redirect after payment
    public function handleCallback(Request $request)
    {
        if ($request->has('success') && $request->success == 'true') {
            $user = Auth::user();

            $cartItems = CartItem::where('user_id', $user->id)->with('product')->get();
            if ($cartItems->isEmpty()) {
                return redirect('/cart')->with('error', 'No items in cart.');
            }

            $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

            // Create order
            $order = Order::create([
                'user_id' => $user->id,
                'amount_cents' => $total * 100,
                'is_paid' => true,
            ]);

            // Save ordered products (without 'price')
            foreach ($cartItems as $item) {
                $order->products()->attach($item->product_id, [
                    'quantity' => $item->quantity,
                ]);
            }

            // Clear cart
            CartItem::where('user_id', $user->id)->delete();

            return redirect()->route('thank.you')->with('success', 'Order completed successfully.');
        }

        return redirect('/user/cart')->with('error', 'Payment failed or canceled.');
    }

    public function thankYou()
    {
        return view('payment.thank-you');
    }
}
