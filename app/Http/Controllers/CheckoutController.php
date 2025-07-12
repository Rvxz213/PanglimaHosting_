<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmation;

class CheckoutController extends Controller
{
    public function cart()
    {
        $cart = session()->get('cart', []);
        $products = Product::whereIn('id', array_keys($cart))->get();
        
        return view('checkout.cart', compact('cart', 'products'));
    }

    public function addToCart(Request $request)
    {
        $productId = $request->product_id;
        $quantity = $request->quantity ?? 1;
        
        $cart = session()->get('cart', []);
        
        if (isset($cart[$productId])) {
            $cart[$productId] += $quantity;
        } else {
            $cart[$productId] = $quantity;
        }
        
        session()->put('cart', $cart);
        
        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        
        return redirect()->back()->with('success', 'Produk berhasil dihapus dari keranjang!');
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Keranjang kosong!');
        }
        
        $products = Product::whereIn('id', array_keys($cart))->get();
        
        return view('checkout.checkout', compact('cart', 'products'));
    }

    public function processCheckout(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email'
        ]);

        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Keranjang kosong!');
        }

        $products = Product::whereIn('id', array_keys($cart))->get();
        $total = 0;
        
        // Calculate total
        foreach ($products as $product) {
            $total += $product->price * $cart[$product->id];
        }

        // For simplicity, we'll create one order per product
        // In a real application, you might want to create multiple orders or a single order with multiple items
        $firstProduct = $products->first();
        $firstProductQuantity = $cart[$firstProduct->id];

        // Create order
        $order = Order::create([
            'product_id' => $firstProduct->id,
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'quantity' => $firstProductQuantity,
            'total' => $total,
            'midtrans_order_id' => 'ORDER-' . time() . rand(1000, 9999)
        ]);

        // Create payment record
        Payment::create([
            'order_id' => $order->id,
            'payment_status' => 'pending'
        ]);

        // Clear cart
        session()->forget('cart');

        // Redirect to payment page (Midtrans)
        return $this->initiateMidtransPayment($order);
    }

    private function initiateMidtransPayment($order)
    {
        // Midtrans configuration
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        \Midtrans\Config::$isSanitized = config('midtrans.is_sanitized');
        \Midtrans\Config::$is3ds = config('midtrans.is_3ds');

        $params = [
            'transaction_details' => [
                'order_id' => $order->midtrans_order_id,
                'gross_amount' => $order->total,
            ],
            'customer_details' => [
                'first_name' => $order->customer_name,
                'email' => $order->customer_email,
            ],
            'item_details' => [
                [
                    'id' => $order->product->id,
                    'price' => $order->product->price,
                    'quantity' => $order->quantity,
                    'name' => $order->product->name,
                ]
            ],
        ];

        try {
            $snapToken = \Midtrans\Snap::getSnapToken($params);
            return view('checkout.payment', compact('snapToken', 'order'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memulai pembayaran: ' . $e->getMessage());
        }
    }

    public function paymentCallback(Request $request)
    {
        $orderId = $request->order_id;
        $order = Order::where('midtrans_order_id', $orderId)->firstOrFail();
        $payment = $order->payment;

        $payment->update([
            'midtrans_transaction_id' => $request->transaction_id,
            'payment_status' => $request->transaction_status,
            'payment_details' => $request->all()
        ]);

        if ($request->transaction_status === 'settlement') {
            $order->update(['status' => 'paid']);
            
            // Send email confirmation
            Mail::to($order->customer_email)->send(new OrderConfirmation($order));
        } elseif (in_array($request->transaction_status, ['deny', 'expire', 'failure'])) {
            $order->update(['status' => 'failed']);
        }

        return response()->json(['status' => 'success']);
    }

    public function paymentSuccess()
    {
        return view('checkout.success');
    }

    public function paymentFailed()
    {
        return view('checkout.failed');
    }
}
