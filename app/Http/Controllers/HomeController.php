<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //show the home page view
        $products = Product::query()
            ->with(['category', 'brand'])
            ->latest()
            ->take(10)
            ->get();

        $posts = BlogPost::query()
            ->with('author')
            ->latest()
            ->take(5)
            ->get();

        return view('welcome', compact('products', 'posts'));
    }

    public function dashboard()
    {
        if (Auth::check() && Auth::user()->hasRole('admin')) {
            // jumlah user
            $userCount = User::count();
            // jumlah produk
            $productCount = Product::count();
            // jumlah transaksi
            $transactionCount = Transaction::count();
            // jumlah blog post
            $blogPostCount = BlogPost::count();

            // Get user comment and post
            $userComments = Comment::with('user', 'post')->latest()->take(5)->get();
            return view('dashboard', compact('userCount', 'productCount', 'transactionCount', 'blogPostCount', 'userComments'));
        }

        return redirect()->route('transaction.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
