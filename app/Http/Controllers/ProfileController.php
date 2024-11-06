<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Address;
use App\Models\Phone;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        
        $validated = $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'birthDate' => 'required|date',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'profilePicture' => 'nullable|image|max:1024',
        ]);

        if ($request->hasFile('profilePicture')) {
            if ($user->profilePicture) {
                Storage::delete($user->profilePicture);
            }
            $path = $request->file('profilePicture')->store('profile-pictures');
            $user->profilePicture = $path;
        }

        $user->update($validated);

        return response()->json(['message' => 'Profile updated successfully']);
    }

    public function addAddress(Request $request)
    {
        $validated = $request->validate([
            'address' => 'required|string|max:255'
        ]);

        $address = auth()->user()->addresses()->create($validated);

        return response()->json($address);
    }

    public function deleteAddress($id)
    {
        $address = Address::findOrFail($id);
        $address->delete();

        return response()->json(['message' => 'Address deleted successfully']);
    }

    public function addPhone(Request $request)
    {
        $validated = $request->validate([
            'phone_number' => 'required|string|max:20'
        ]);

        $phone = auth()->user()->phones()->create($validated);

        return response()->json($phone);
    }

    public function deletePhone($id)
    {
        $phone = Phone::findOrFail($id);
        $phone->delete();

        return response()->json(['message' => 'Phone deleted successfully']);
    }
}