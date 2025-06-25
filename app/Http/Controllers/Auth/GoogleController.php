<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    /**
     * Redirect to Google OAuth
     */
    public function redirectToGoogle()
    {
        try {
            // Check if Google OAuth is configured
            if (empty(config('services.google.client_id')) || empty(config('services.google.client_secret'))) {
                return redirect('/login')->with('error', 'Google OAuth belum dikonfigurasi. Silakan hubungi administrator.');
            }

            return Socialite::driver('google')
                ->scopes(['openid', 'profile', 'email'])
                ->redirect();
        } catch (\Exception $e) {
            \Log::error('Google OAuth redirect error: ' . $e->getMessage());
            return redirect('/login')->with('error', 'Tidak dapat menghubungkan ke Google. Silakan coba lagi.');
        }
    }

    /**
     * Handle Google OAuth callback
     */
    public function handleGoogleCallback()
    {
        try {
            // Handle OAuth errors from Google
            if (request()->has('error')) {
                $error = request()->get('error');
                $errorDescription = request()->get('error_description', 'Unknown error');
                
                \Log::warning('Google OAuth error: ' . $error . ' - ' . $errorDescription);
                
                if ($error === 'access_denied') {
                    return redirect('/login')->with('error', 'Akses ditolak. Anda perlu memberikan izin untuk melanjutkan.');
                }
                
                return redirect('/login')->with('error', 'Terjadi kesalahan otorisasi: ' . $errorDescription);
            }

            $googleUser = Socialite::driver('google')->user();
            
            // Validate required data from Google
            if (empty($googleUser->email) || empty($googleUser->name)) {
                return redirect('/login')->with('error', 'Data profil Google tidak lengkap. Silakan coba lagi.');
            }
            
            // Check if user already exists with this Google ID
            $user = User::where('google_id', $googleUser->id)->first();
            
            if ($user) {
                // Update user data from Google
                $user->update([
                    'name' => $googleUser->name,
                    'avatar' => $googleUser->avatar,
                ]);
                
                Auth::login($user);
                return redirect()->intended('/dashboard');
            }
            
            // Check if user exists with this email
            $existingUser = User::where('email', $googleUser->email)->first();
            
            if ($existingUser) {
                // Update existing user with Google ID
                $existingUser->update([
                    'google_id' => $googleUser->id,
                    'name' => $googleUser->name,
                    'avatar' => $googleUser->avatar,
                ]);
                
                Auth::login($existingUser);
                return redirect()->intended('/dashboard');
            }
            
            // Create new user
            $newUser = User::create([
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'google_id' => $googleUser->id,
                'avatar' => $googleUser->avatar,
                'role' => 'student', // Default role
                'email_verified_at' => now(),
                'password' => bcrypt(Str::random(16)), // Random password since they'll use Google
            ]);
            
            Auth::login($newUser);
            return redirect()->intended('/dashboard');
            
        } catch (\Laravel\Socialite\Two\InvalidStateException $e) {
            \Log::error('Google OAuth invalid state: ' . $e->getMessage());
            return redirect('/login')->with('error', 'Sesi login telah kedaluwarsa. Silakan coba lagi.');
        } catch (\Exception $e) {
            \Log::error('Google OAuth callback error: ' . $e->getMessage());
            return redirect('/login')->with('error', 'Terjadi kesalahan saat login dengan Google: ' . $e->getMessage());
        }
    }
}