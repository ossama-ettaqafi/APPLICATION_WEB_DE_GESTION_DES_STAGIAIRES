<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('pages.register');
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'fullname' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'fullname.required' => 'Le champ Nom complet est obligatoire.',
            'email.required' => 'Le champ Email est obligatoire.',
            'email.email' => 'Veuillez fournir une adresse email valide.',
            'email.unique' => 'Cet email est déjà utilisé.',
            'password.required' => 'Le champ Mot de passe est obligatoire.',
            'password.min' => 'Le mot de passe doit comporter au moins 6 caractères.',
            'image.required' => 'Le champ Image est obligatoire.',
            'image.image' => 'Le fichier doit être une image.',
            'image.mimes' => 'Les types de fichiers autorisés sont: jpeg, png, jpg, gif.',
            'image.max' => 'La taille maximale du fichier est de 2MB.',
        ]);

        // Save the uploaded image
        $imagePath = $request->file('image')->store('public/images');
        $imagePath = 'storage' . substr($imagePath, 6);

        // Create a new user
        $user = new User();
        $user->fullname = $validatedData['fullname'];
        $user->email = $validatedData['email'];
        $user->password = bcrypt($validatedData['password']);
        $user->image = $imagePath;
        $user->save();

        // Log in the user
        Auth::login($user);

        // Redirect or return a response
        return redirect()->route('dashboard.main');
    }
}
