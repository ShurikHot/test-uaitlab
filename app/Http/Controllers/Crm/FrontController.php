<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\RedirectResponse;

class FrontController extends Controller
{
    public function loginForm()
    {
        return view('front.auth.login');
    }

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
}
