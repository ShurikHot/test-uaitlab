<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request): RedirectResponse
    {
        $data = $request->validated();
        if (Auth::attempt($data)) {
            if (Auth::user()->is_admin) {
                return redirect()->route('users.index');
            }
            return redirect()->route('warranty.index');
        } else {
            return redirect()->back()->with('error', 'Неправильний логін чи пароль');
        }
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
