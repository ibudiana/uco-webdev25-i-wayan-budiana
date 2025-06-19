<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
            'paymentMethods' => $request->user()->paymentMethods,
            'shippingAddresses' => $request->user()->shippingAddresses,
        ]);
    }

    /**
     * Display the user's payment methods.
     */

    public function storePaymentMethod(Request $request): RedirectResponse
    {
        $request->validate([
            'type' => ['required', 'string'],
            'is_default' => 'nullable|boolean',
        ]);

        $paymentMethod = $request->user()->paymentMethods()->create([
            'type' => $request->input('type'),
            'is_default' => $request->boolean('is_default'),
        ]);

        $paymentMethod->makeDefaultPaymentMethod($request->boolean('is_default'));

        return Redirect::route('profile.edit')->with('status', 'payment-method-added');
    }

    public function deletePaymentMethod(Request $request, $id): RedirectResponse
    {
        $paymentMethod = $request->user()->paymentMethods()->findOrFail($id);
        $paymentMethod->delete();

        return Redirect::route('profile.edit')->with('status', 'payment-method-deleted');
    }

    /**
     * Display the user's shipping addresses.
     */
    public function storeShippingAddress(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address_line1' => 'required|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'postal_code' => 'required|string|max:20',
            'country' => 'required|string|max:100',
            'is_default' => 'nullable|boolean',
        ]);

        if ($request->boolean('is_default')) {
            // Remove existing default
            $request->user()->shippingAddresses()->update(['is_default' => false]);
        }

        $request->user()->shippingAddresses()->create($request->all());

        return Redirect::route('profile.edit')->with('status', 'shipping-address-added');
    }

    public function deleteShippingAddress(Request $request, $id): RedirectResponse
    {
        $address = $request->user()->shippingAddresses()->findOrFail($id);
        $address->delete();

        return Redirect::route('profile.edit')->with('status', 'shipping-address-deleted');
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
