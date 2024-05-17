<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InternController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard.main');
    } else {
        return view('pages.accueil');
    }
})->name('accueil');

Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/about#contact', function () {
    return redirect()->route('about') . '#contact';
})->name('about.contact');

Route::get('/service', function () {
    return view('pages.service');
})->name('service');

// Redirect logged-in users from dashboard to dashboard.main
Route::middleware('auth')->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::view('/add-intern', 'pages.dashboard.add-intern')->name('add-intern');
    Route::view('/delete-intern', 'pages.dashboard.delete-intern')->name('delete-intern');
    Route::view('/edit-intern', 'pages.dashboard.edit-intern')->name('edit-intern');
    Route::view('/help', 'pages.dashboard.help')->name('help');
    Route::view('/main', 'pages.dashboard.main')->name('main');
    Route::view('/settings', 'pages.dashboard.settings')->name('settings');
});

// Login and register accessible to unauthenticated users
Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('pages.login');
    })->name('login');
    
    Route::post('/login', [LoginController::class, 'login']);
    
    Route::get('/register', function () {
        return view('pages.register');
    })->name('register');
    
    Route::post('/register', [RegisterController::class, 'register']);
});

// Logout
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Update profile
Route::middleware('auth')->post('/user/update-profile', [UserController::class, 'updateProfile'])
    ->name('user.updateProfile');

// Update password
Route::middleware('auth')->post('/user/update-password', [UserController::class, 'updatePassword'])
    ->name('user.updatePassword');

// Update notifications
Route::middleware('auth')->post('/user/update-notifications', [UserController::class, 'updateNotifications'])
    ->name('user.updateNotifications');

// Route for displaying the form to add a new intern
Route::post('dashboard/add-intern', [InternController::class, 'store'])->name('intern.store');

// Route for showing all existing interns on the database
Route::get('dashboard/add-intern', [InternController::class, 'showAddInternForm'])->name('dashboard.add-intern');

// Route for showing all existing interns on the database
Route::get('dashboard/edit-intern', [InternController::class, 'showInterns'])->name('dashboard.edit-intern');
Route::get('dashboard/delete-intern', [InternController::class, 'showInternsForDelete'])->name('dashboard.delete-intern');

// Route for editing an intern by id
Route::put('dashboard/edit-intern/{id}', [InternController::class, 'update'])->name('interns.update');

// Route for deleting interns by ID
Route::delete('/interns/delete-selected', [InternController::class, 'deleteSelected'])->name('interns.deleteSelected');

// Route for showing all the intern on the main dashboard page
Route::get('/dashboard/main', [InternController::class, 'showInternDetailsMain'])->name('dashboard.main');

Route::post('/dashboard/main/fast-add', [InternController::class, 'fastAdd'])->name('fastAdd');
Route::put('/dashboard/main/edit/{id}', [InternController::class, 'fastEdit'])->name('fastEdit');
Route::delete('/interns/{id}', [InternController::class, 'destroy'])->name('interns.destroy');

Route::get('/interns/export/excel', [InternController::class, 'exportToExcel'])->name('interns.export.excel');
Route::get('/interns/export/pdf', [InternController::class, 'exportToPDF'])->name('interns.export.pdf');
Route::get('/interns/{id}/attestation', [InternController::class, 'generateAttestation'])->name('interns.attestation');

Route::post('/contact', function (Request $request) {
    $data = $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'message' => 'required',
    ]);

    // Send the email
    Mail::send('emails.contact', ['data' => $data], function ($message) use ($data) {
        $message->to('ossamaett2002@gmail.com', 'Recipient Name')
                ->subject('New Contact Form Submission');
    });
    

    // Redirect or show a success message
    return redirect()->back()->with('success', 'Your message has been sent!');
})->name('contact.submit');