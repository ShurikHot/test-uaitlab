<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function registerForm()
    {
        return view('auth.create');
    }

    public function register(RegisterRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);

        $user = User::query()->create($data);
        Auth::login($user);
        return redirect()->route('admin.index');
    }

    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if (Auth::attempt($data)) {
            return redirect()->route('admin.index');
        } else {
            return redirect()->back()->with('error', 'Неправильний логін чи пароль');
        }
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        return redirect()->route('home');
    }

    public function getToken(LoginRequest $request): JsonResponse
    {
        $data = $request->validated();

        $user = User::query()->where('email', $data['email'])->first();
        if (!$user || !Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect'],
            ]);
        }
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);
    }
}
