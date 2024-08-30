<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;

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
        $data['password'] = '12345678';

        User::query()->firstOrCreate($data);

        return redirect()->route('users.index')->with('success', 'Користувача додано. Пароль: 12345678');
    }

    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $data = $request->validated();
        $data['password'] = '12345678';

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'Данні користувача оновлено. Пароль: 12345678');
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Користувача видалено');
    }
}
