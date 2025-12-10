<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Storage; // Used to handle files in storage (images, documents, etc.)

class UserController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        $orders = Order::with('orderDetails.product')
            ->where('user_id', $user->id)
            ->orderBy('purchase_date', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        return view('user.profile', compact('orders'));
    }

    public function updateProfile(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:100',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
        ]);

        $user->name = $request->name;

        if ($request->hasFile('photo')) {
            // Delete the old photo if it exists
            if ($user->photo && Storage::disk('public')->exists('avatars/' . $user->photo)) {
                Storage::disk('public')->delete('avatars/' . $user->photo);
            }

            // Save the new photo
            $photoName = time() . '.' . $request->photo->extension();
            $request->photo->storeAs('avatars', $photoName, 'public');
            $user->photo = $photoName;

            // Update manually if not using automatic timestamps
            $user->updated_at = now();
        }

        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
