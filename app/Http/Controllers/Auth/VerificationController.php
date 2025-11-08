<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class VerificationController extends Controller
{
    // Tampilkan halaman verifikasi
    public function showVerificationForm(Request $request)
    {
        return view('auth.verify-email');
    }

    // Proses input kode verifikasi
    public function verify(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'code' => 'required|digits:6'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan'])->with('email', $request->email);
        }

        if ($user->email_verified_at) {
            return redirect()->route('login')->with('success', 'Email sudah diverifikasi. Silakan login.');
        }

        // Cek kode verifikasi
        if ((string)$user->verification_code !== trim($request->code)) {
            return back()
                ->withErrors(['code' => 'Kode verifikasi salah'])
                ->with('email', $request->email);
        }

        // Cek masa berlaku kode
        if (Carbon::now()->greaterThan($user->code_expires_at)) {
            return back()
                ->withErrors(['code' => 'Kode sudah kedaluwarsa'])
                ->with('email', $request->email);
        }

        // Verifikasi sukses
        $user->update([
            'email_verified_at' => now(),
            'verification_code' => null,
            'code_expires_at' => null
        ]);

        return redirect()->route('login')->with('success', 'Verifikasi berhasil! Silakan login.');
    }

    // Kirim ulang kode
    public function resendCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan']);
        }

        if ($user->email_verified_at) {
            return redirect()->route('login')->with('success', 'Email sudah diverifikasi.');
        }

        // Batasi kirim ulang tiap 1 menit
        if ($user->code_expires_at && Carbon::now()->lt($user->code_expires_at->subMinutes(9))) {
            return back()->withErrors(['email' => 'Tunggu sebentar sebelum kirim ulang kode.']);
        }

        $code = random_int(100000, 999999);

        $user->update([
            'verification_code' => $code,
            'code_expires_at' => Carbon::now()->addMinutes(10)
        ]);

        Mail::raw("Kode verifikasi kamu adalah: {$code}", function ($message) use ($user) {
            $message->to($user->email)->subject('Kode Verifikasi Email');
        });

        return back()->with('success', 'Kode verifikasi telah dikirim ulang ke email.')->with('email', $user->email);
    }
}
