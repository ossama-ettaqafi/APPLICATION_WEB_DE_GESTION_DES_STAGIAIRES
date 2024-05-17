<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('pages.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Le champ Email est obligatoire.',
            'email.email' => 'Veuillez fournir une adresse email valide.',
            'password.required' => 'Le champ Mot de passe est obligatoire.',
        ]);

        if ($validator->fails()) {
            return redirect()->route('login')
                ->withErrors($validator)
                ->withInput($request->only('email'));
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Open the session for the authenticated user
            Auth::login(Auth::user());

            // Authentication successful
            return redirect()->route('dashboard.main');
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors([
                'password' => 'Les informations d\'identification fournies sont incorrectes.',
            ]);
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('accueil');
    }
}
