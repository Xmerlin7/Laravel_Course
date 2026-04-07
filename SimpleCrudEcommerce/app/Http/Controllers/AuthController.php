<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // public function login(LoginRequest $request): RedirectResponse
    // {
    //     $credentials = $request->validated();

    //     if (!Auth::attempt($credentials)) {
    //         return back()
    //             ->withErrors(['email' => 'Invalid email or password.'])
    //             ->onlyInput('email');
    //     }

    //     $request->session()->regenerate();

    //     return Auth::user()?->role === 'admin'
    //         ? redirect('/users')
    //         : redirect('/products');
    // }

    // public function logout(Request $request): RedirectResponse
    // {
    //     Auth::logout();

    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();

    //     return redirect()->route('login');
    // }
    protected $authService;
    public function __construct(AuthService $authService){
        $this->authService = $authService;
    }
    public function register(Request $request){
        $userData = $request->validate([
            'name'=> 'required | string | min:3',
            'email' => " required | email | string | unique:users",
            'password' => 'required|string|min:6',
        ]);
        $result = $this->authService->register($userData);
        return response()->json($result, 201);
    }
}
