<?php

namespace App\Http\Controllers\Mitra\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\MitraLoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('mitra.auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(MitraLoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('mitra.dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('mitra')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/mitra/login');
    }
}
