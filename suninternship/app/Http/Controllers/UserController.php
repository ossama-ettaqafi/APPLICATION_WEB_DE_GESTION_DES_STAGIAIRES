<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'profile_image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'name.required' => 'The name field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'profile_image.image' => 'The profile image must be an image file.',
            'profile_image.mimes' => 'The profile image must be a JPEG, PNG, or JPG file.',
            'profile_image.max' => 'The profile image size must not exceed 2048 KB.',
        ]);

        $user->fullname = $validatedData['name'];
        $user->email = $validatedData['email'];

        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $imagePath = $image->store('public/images');
            $imagePath = 'storage' . substr($imagePath, 6);
            $user->image = $imagePath;
        }

        $user->save();

        return redirect()->back()->with('success', 'Profil mis à jour avec succès.');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $validatedData = $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ], [
            'password.required' => 'The password field is required.',
            'password.string' => 'Please enter a valid password.',
            'password.min' => 'The password must be at least 6 characters.',
            'password.confirmed' => 'The password confirmation does not match.',
        ]);

        $user->password = bcrypt($validatedData['password']);
        $user->save();

        return redirect()->back()->with('password', 'Mot de passe mis à jour avec succès.');
    }

    public function updateNotifications(Request $request)
    {
        $user = Auth::user();

        $user->email_notifications = $request->has('email_notifications');
        $user->save();

        return redirect()->back()->with('notification', 'Paramètres de notification mis à jour avec succès.');
    }
}
