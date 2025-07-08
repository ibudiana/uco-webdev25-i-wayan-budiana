<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\ShippingAddress;
use App\Models\PaymentMethod;
use App\Models\Cart;

use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $query = Transaction::with(['user', 'items.product', 'paymentMethod']);

        // Dapatkan user yang sedang login.
        $user = Auth::user();

        // Jika pengguna yang login bukan admin, filter transaksi berdasarkan user_id.
        if (!$user->hasRole('admin')) {
            $query->where('user_id', $user->id);
        }

        $transactions = $query->orderBy('transaction_date', 'desc')->get();

        return view('admin.orders.index', compact('transactions'));
    }

    public function show($id)
    {
        $user = Auth::user();

        if ($user->hasRole('admin')) {
            // Admin can view any transaction
            $transaction = Transaction::with(['items.product', 'paymentMethod', 'shippingAddress'])
                ->findOrFail($id);
        } else {
            // Regular user can only view their own transactions
            $transaction = Transaction::with(['items.product', 'paymentMethod', 'shippingAddress'])
                ->where('user_id', $user->id)
                ->findOrFail($id);
        }

        return view('admin.orders.show', compact('transaction'));
    }

    public function updateStatus(Request $request, Transaction $transaction)
    {

        if (!Auth::user()->can('manage-transactions')) {
            abort(403, 'Unauthorized action.');
        }

        $transaction->update(['status' => 'completed']);

        return back()->with('success', 'Transaction status has been updated successfully!');
    }



    public function showCheckoutForm()
    {
        $paymentMethods = PaymentMethod::pluck('type', 'id');
        $shippingAddresses = Auth::user()->shippingAddresses()->get();

        return view('user.transaction.checkout', compact('paymentMethods', 'shippingAddresses'));
    }

    public function processCheckout(Request $request)
    {
        $request->validate([
            'cart_data'        => 'required|json',
            'payment_method'   => 'required|exists:payment_methods,id',
        ]);

        $user = Auth::user();
        $cart = json_decode($request->input('cart_data'), true);

        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['qty']);

        if ($request->shipping_address_id === 'new') {

            $request->validate([
                'name'             => 'required|string|max:255',
                'phone'            => ['required', 'string', 'max:20', 'regex:/^(\+62|0)[0-9]{8,15}$/'],
                'address_line1'    => 'required|string|max:255',
                'address_line2'    => 'nullable|string|max:255',
                'city'             => 'required|string|max:100',
                'state'            => 'required|string|max:100',
                'postal_code'      => 'required|string|max:20',
                'country'          => 'required|string|max:100',
            ]);

            // Simpan Alamat
            $shippingAddress = ShippingAddress::create([
                'user_id' => $user->id,
                'name' => $request->name,
                'phone' => $request->phone,
                'address_line1' => $request->address_line1,
                'address_line2' => $request->address_line2,
                'city' => $request->city,
                'state' => $request->state,
                'postal_code' => $request->postal_code,
                'country' => $request->country,
                'is_default' => true,
            ]);
        } else {
            // Ambil Alamat yang sudah ada
            $shippingAddress = ShippingAddress::where('id', $request->shipping_address_id)
                ->where('user_id', Auth::id())
                ->firstOrFail();
        }

        // Simpan transaksi
        $transaction = Transaction::create([
            'user_id' => $user->id,
            'payment_method_id' => $request->payment_method,
            'amount' => $total,
            'status' => 'pending',
            'shipping_address_id' => $shippingAddress->id,
            'description' => 'Checkout via form',
            'transaction_date' => now(),
        ]);

        // Simpan item transaksi
        foreach ($cart as $item) {
            TransactionItem::create([
                'transaction_id' => $transaction->id,
                'product_id' => $item['id'],
                'quantity' => $item['qty'],
                'item_price' => $item['price'],
            ]);
        }

        // Hapus cart user di database
        // Ambil cart aktif user beserta itemsnya
        $cart = $user->cart;

        if ($cart) {
            $cart->items()->delete();
        }

        session(['checkout_done' => true]);

        return redirect()->route('transaction.complete')->with('status', 'Checkout berhasil!');
    }


    public function checkoutSuccess(Request $request)
    {
        if (!$request->session()->pull('checkout_done')) {
            return redirect()->route('transaction.checkout')->with('error', 'Selesaikan pesanan terlebih dahulu.');
        }

        return view('user.transaction.complete');
    }

    public function confirm(Request $request)
    {

        $request->validate([
            'transaction_id' => 'required|exists:transactions,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $transaction = Transaction::findOrFail($request->transaction_id);

        // Simpan bukti pembayaran
        $imagePath = $request->file('image')->store('upload/payments', 'public');
        $transaction->update(['payment_proof' => $imagePath, 'status' => 'waiting_for_confirmation']);

        // Kurangi Stock Product
        foreach ($transaction->items as $item) {
            $item->product->decrement('stock', $item->quantity);
        }

        return redirect()->route('transaction.show', $transaction->id)->with('success', 'Bukti pembayaran berhasil diunggah.');
    }
}
