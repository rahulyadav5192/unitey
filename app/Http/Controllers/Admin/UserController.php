<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        return view('admin.users.index', [
            'users' => User::query()->with('role')->orderBy('name')->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.users.form', [
            'account' => new User,
            'roles' => Role::query()->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:160', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'max:120'],
            'role_id' => ['required', 'integer', Rule::exists('roles', 'id')],
        ]);

        User::query()->create($data);

        return redirect()->route('admin.users.index')->with('status', 'User added.');
    }

    public function edit(User $user): View
    {
        return view('admin.users.form', [
            'account' => $user,
            'roles' => Role::query()->orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:160', Rule::unique('users', 'email')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:8', 'max:120'],
            'role_id' => ['required', 'integer', Rule::exists('roles', 'id')],
        ]);

        if ($this->locksOutLastAdministrator($user, (int) $data['role_id'])) {
            return back()->withErrors([
                'role_id' => 'Keep at least one Administrator. Add another before changing this role.',
            ])->withInput();
        }

        if (blank($data['password'])) {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('status', 'User saved.');
    }

    public function destroy(Request $request, User $user): RedirectResponse
    {
        if ($request->user()->is($user)) {
            return back()->withErrors([
                'user' => 'You cannot delete the account you are signed in with.',
            ]);
        }

        if ($this->locksOutLastAdministrator($user, null)) {
            return back()->withErrors([
                'user' => 'Keep at least one Administrator. Add another before deleting this account.',
            ]);
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('status', 'User deleted.');
    }

    private function locksOutLastAdministrator(User $user, ?int $nextRoleId): bool
    {
        $administratorId = Role::query()->where('slug', 'administrator')->value('id');

        if (! $administratorId || (int) $user->role_id !== (int) $administratorId) {
            return false;
        }

        if ($nextRoleId === (int) $administratorId) {
            return false;
        }

        return User::query()->where('role_id', $administratorId)->count() === 1;
    }
}
