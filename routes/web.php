<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Middleware\RoleAccess;
use App\Livewire\QuizLogin;
use App\Livewire\QuizPage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/about', function () {
    return view('about');
});

Route::get('/siswa', function () {
    return view('livewire.siswa');
});

require __DIR__ . '/auth.php';

// Verifikasi Email 
Route::get('/verify-email', [VerificationController::class, 'showVerificationForm'])->name('verification.form');
Route::post('/verify-email', [VerificationController::class, 'verify'])->name('custom.verification.verify');
Route::post('/resend-code', [VerificationController::class, 'resendCode'])->name('verification.resend');

Route::middleware(['auth', RoleAccess::class])->group(function () {

    // Users


    // Halaman Kuis
    Route::get('/quiz-login', QuizLogin::class)->name('quiz.login');
    Route::get('/quiz', QuizPage::class)->name('quiz.page');

    // Profile (dari Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// Logout Filament 
Route::post('/admin/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('filament.admin.auth.logout');
