<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;

class NewsletterSubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all subscribers
        $subscribers = Subscriber::latest()
            ->paginate(10)
            ->withQueryString();

        // Return the view with subscribers data
        return view('admin.subscriber.index', compact('subscribers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Return the view to create a new subscriber
        return view('admin.subscriber.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email|unique:subscribers,email',
        ]);

        if ($request->has('name')) {
            $request->validate([
                'name' => 'required|string|max:255',
            ]);
        }

        // Create a new subscriber
        Subscriber::create([
            'email' => $request->input('email'),
            'name' => $request->input('name', null),
        ]);

        // Redirect back with success message
        return back()->with('success', 'Thank you for subscribing to our newsletter!');
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
        // Find the subscriber by ID
        $subscriber = Subscriber::findOrFail($id);


        // Return the view to edit the subscriber
        return view('admin.subscriber.edit', compact('subscriber'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email|unique:subscribers,email,' . $id,
        ]);

        if ($request->has('name')) {
            $request->validate([
                'name' => 'required|string|max:255',
            ]);
        }

        // Find the subscriber by ID and update
        $subscriber = Subscriber::findOrFail($id);
        $subscriber->update([
            'email' => $request->input('email'),
            'name' => $request->input('name', null),
        ]);

        // Redirect back with success message
        return back()->with('success', 'Update successful!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the subscriber by ID
        $subscriber = Subscriber::findOrFail($id);

        // Delete the subscriber
        $subscriber->delete();

        // Redirect back with success message
        return back()->with('success', 'Subscriber deleted successfully!');
    }
}
