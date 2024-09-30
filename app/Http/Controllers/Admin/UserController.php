<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Mail\UserRegistrationMessage;
use App\Mail\UserUpdateMessage;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        $customTitle = ' :: Список користувачів';
        $users = User::query()->paginate(10);

        return view('admin.users.index', compact('users', 'customTitle'));
    }

    public function create()
    {
        $customTitle = ' :: Додати нового користувача';

        return view('admin.users.create', compact('customTitle'));
    }

    public function edit(User $user)
    {
        $customTitle = ' :: Редагування користувача';

        return view('admin.users.edit', compact('customTitle', 'user'));
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['password'] = Str::random(10);

        Mail::to($data['email'])->send(new UserRegistrationMessage($data));

        $data['password'] = Hash::make($data['password']);

        User::query()->firstOrCreate($data);

        return redirect()->route('users.index')->with('success', 'Користувача додано');
    }

    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $data = $request->validated();

        $data['password'] = Str::random(10);

        Mail::to($data['email'])->send(new UserUpdateMessage($data));

        $data['password'] = Hash::make($data['password']);

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'Данні користувача оновлено');
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Користувача видалено');
    }
}
