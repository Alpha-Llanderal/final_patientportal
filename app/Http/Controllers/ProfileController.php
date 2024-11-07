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
            'profilePicture' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('profilePicture')) {
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            $path = $request->file('profilePicture')->store('profile-pictures', 'public');
            $user->profile_picture = $path;
        }

        $user->update($validated);

        return response()->json(['message' => 'Profile updated successfully']);
    }

    public function uploadProfilePicture(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            if ($request->hasFile('profile_picture')) {
                $path = $this->updateProfilePicture($request->file('profile_picture'));

                return response()->json([
                    'success' => true,
                    'message' => 'Profile picture uploaded successfully',
                    'path' => Storage::url($path)
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'No image file provided'
            ], 400);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error uploading profile picture: ' . $e->getMessage()
            ], 500);
        }
    }

    protected function updateProfilePicture($file)
    {
        if ($this->user->profile_picture) {
            Storage::disk('public')->delete($this->user->profile_picture);
        }

        $path = $file->store('profile-pictures', 'public');
        $this->user->update(['profile_picture' => $path]);

        return $path;
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