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

        // Hapus item lama yang ada di cart
        $cart->items()->delete();

        // Simpan item baru di table cart_items
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
        // $cart = Cart::with('items.product')
        //     ->where('user_id', Auth::id())
        //     ->where('is_active', true)
        //     ->first();

        $cart = Cart::with('items', 'items.product')
            ->whereHas('items', function ($query) {
                $query->where('user_id', Auth::id());
            })->first();

        if (!$cart) {
            return response()->json([]);
        }

        $cartItems = $cart->items->map(function ($item) {
            return [
                'id' => $item->product->id,
                'name' => $item->product->name,
                'price' => $item->product->price,
                'qty' => $item->quantity,
                'stock' => $item->product->stock,
            ];
        });

        return response()->json($cartItems);
    }
}
