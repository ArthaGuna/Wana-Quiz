<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'role' => ['required', 'string', 'in:mahasiswa,dosen'],
            'password' => [
                'required',
                'confirmed',
                Rules\Password::min(8)          // minimal 8 karakter
                    ->letters()                 // harus ada huruf
                    ->mixedCase()               // harus ada huruf kapital
                    ->numbers()                 // harus ada angka
            ],
        ], [
            'password.letters' => 'Password harus memiliki setidaknya satu huruf.',
            'password.mixed' => 'Password harus memiliki huruf kapital.',
            'password.numbers' => 'Password harus memiliki setidaknya satu angka.',
            'password.min' => 'Password harus minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        // Generate kode verifikasi
        if (in_array($user->role, ['mahasiswa', 'dosen'])) {
            $code = random_int(100000, 999999); // 6 digit
            $user->update([
                'verification_code' => $code,
                'code_expires_at' => now()->addMinutes(10),
            ]);

            // Kirim email verifikasi sederhana
            Mail::send('emails.verify-code', ['user' => $user, 'code' => $code], function ($message) use ($user) {
                $message->to($user->email)
                    ->subject('Kode Verifikasi Email');
            });

            // Redirect ke halaman verifikasi
            return redirect()
                ->route('verification.form')
                ->with('email', $user->email)
                ->with('success', 'Registrasi berhasil! Kode verifikasi telah dikirim ke email kamu.');
        }

        // Jika role bukan mahasiswa/dosen (misal admin dev)
        return redirect()->route('login')->with('success', 'Registrasi berhasil, silakan login!');
    }
}
