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
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:student,lecturer'],
        ], [
            'role.required' => 'Silakan pilih peran Anda (Mahasiswa atau Dosen).',
            'role.in' => 'Peran yang dipilih tidak valid.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        event(new Registered($user));

        Auth::login($user);

        // Redirect based on role with welcome message
        if ($user->isLecturer()) {
            return redirect(route('dashboard', absolute: false))
                ->with('success', 'Selamat datang! Anda telah terdaftar sebagai dosen. Anda dapat memverifikasi materi yang diunggah mahasiswa.');
        } else {
            return redirect(route('dashboard', absolute: false))
                ->with('success', 'Selamat datang! Anda telah terdaftar sebagai mahasiswa. Mulai jelajahi dan unduh materi kuliah.');
        }
    }
}