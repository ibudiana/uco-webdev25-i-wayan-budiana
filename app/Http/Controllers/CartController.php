<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();
        $cartData = $request->input('cart', []);

        // if (empty($cartData)) {
        //     return response()->json(['message' => 'Cart is empty'], 400);
        // }

        // Cek apakah user sudah punya cart aktif
        $cart = Cart::firstOrCreate(
            ['user_id' => $user->id, 'is_active' => true]
        );
        // Hapus item lama
        $cart->items()->delete();

        // Simpan item baru
        foreach ($cartData as $item) {
            $cart->items()->create([
                'product_id' => $item['id'],
                'quantity' => $item['qty'],
                'item_price' => $item['price'],
            ]);
        }

        return response()->json(['message' => 'Cart saved to database']);
    }

    public function fetch()
    {
        $cart = Cart::with('items.product')
            ->where('user_id', Auth::id())
            ->where('is_active', true)
            ->first();

        if (!$cart) {
            return response()->json([]);
        }

        $cartItems = $cart->items->map(function ($item) {
            return [
                'id' => $item->product->id,
                'name' => $item->product->name,
                'price' => $item->product->price,
                'qty' => $item->quantity,
            ];
        });

        return response()->json($cartItems);
    }
}
