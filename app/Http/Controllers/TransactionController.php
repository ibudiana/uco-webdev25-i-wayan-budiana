<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\ShippingAddress;
use App\Models\PaymentMethod;

use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::with(['items.product', 'paymentMethod'])
            ->where('user_id', Auth::id())
            ->orderBy('transaction_date', 'desc')
            ->get();

        return view('user.transaction.index', compact('transactions'));

        // return response()->json($transactions);
    }

    public function show($id)
    {
        $transaction = Transaction::with(['items.product', 'paymentMethod'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('user.transaction.show', compact('transaction'));
    }

    public function updateStatus(Request $request, $id)
    {
        $transaction = Transaction::where('user_id', Auth::id())->findOrFail($id);

        $transaction->status = 'completed';
        $transaction->save();

        return redirect()->back()->with('success', 'Transaction marked as complete.');
    }



    public function showCheckoutForm()
    {
        $paymentMethods = PaymentMethod::pluck('type', 'id');

        return view('user.transaction.checkout', compact('paymentMethods'));
    }

    public function processCheckout(Request $request)
    {
        $request->validate([
            'cart_data'        => 'required|json',
            'name'             => 'required|string|max:255',
            'phone'            => ['required', 'string', 'max:20', 'regex:/^(\+62|0)[0-9]{8,15}$/'],
            'address_line1'    => 'required|string|max:255',
            'address_line2'    => 'nullable|string|max:255',
            'city'             => 'required|string|max:100',
            'state'            => 'required|string|max:100',
            'postal_code'      => 'required|string|max:20',
            'country'          => 'required|string|max:100',
            'payment_method'   => 'required|exists:payment_methods,id',
        ]);

        $user = Auth::user();
        $cart = json_decode($request->input('cart_data'), true);

        // dd($request->payment_method);

        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['qty']);

        // Simpan transaksi
        $transaction = Transaction::create([
            'user_id' => $user->id,
            'payment_method_id' => $request->payment_method,
            'amount' => $total,
            'status' => 'pending',
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

        // Simpan Alamat
        ShippingAddress::create([
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
}
