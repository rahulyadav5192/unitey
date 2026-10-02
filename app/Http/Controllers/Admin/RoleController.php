<?php

namespace App\Http\Controllers\Admin;

use App\Access\Permissions;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class RoleController extends Controller
{
    public function index(): View
    {
        Permissions::sync();

        return view('admin.roles.index', [
            'roles' => Role::query()->withCount(['permissions', 'users'])->orderBy('name')->get(),
        ]);
    }

    public function create(): View
    {
        Permissions::sync();

        return view('admin.roles.form', [
            'role' => new Role,
            'groups' => Permissions::grouped(),
            'selected' => old('permissions', []),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateRole($request);
        $role = Role::query()->create([
            'name' => $data['name'],
            'slug' => $this->slug($data['name']),
            'description' => $data['description'] ?? null,
            'is_system' => false,
        ]);
        $this->syncPermissions($role, $data['permissions'] ?? []);

        return redirect()->route('admin.roles.index')->with('status', 'Role added.');
    }

    public function edit(Role $role): View
    {
        Permissions::sync();
        $role->load('permissions');

        return view('admin.roles.form', [
            'role' => $role,
            'groups' => Permissions::grouped(),
            'selected' => old('permissions', $role->is_system
                ? array_column(Permissions::all(), 'key')
                : $role->permissions->pluck('key')->all()),
        ]);
    }

    public function update(Request $request, Role $role): RedirectResponse
    {
        $data = $this->validateRole($request, $role);
        $role->update([
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
        ]);
        $this->syncPermissions($role, $data['permissions'] ?? []);

        return redirect()->route('admin.roles.index')->with('status', 'Role saved.');
    }

    public function destroy(Role $role): RedirectResponse
    {
        if ($role->is_system) {
            return back()->withErrors([
                'role' => 'The Administrator role stays in place so someone always has full access.',
            ]);
        }

        if ($role->users()->exists()) {
            return back()->withErrors([
                'role' => 'Move people off this role before deleting it.',
            ]);
        }

        $role->delete();

        return redirect()->route('admin.roles.index')->with('status', 'Role deleted.');
    }

    /**
     * @return array{name: string, description: ?string, permissions?: array<int, string>}
     */
    private function validateRole(Request $request, ?Role $role = null): array
    {
        $keys = array_column(Permissions::all(), 'key');

        return $request->validate([
            'name' => ['required', 'string', 'max:80', Rule::unique('roles', 'name')->ignore($role?->id)],
            'description' => ['nullable', 'string', 'max:240'],
            'permissions' => ['array'],
            'permissions.*' => ['string', Rule::in($keys)],
        ]);
    }

    /**
     * @param  array<int, string>  $keys
     */
    private function syncPermissions(Role $role, array $keys): void
    {
        if ($role->is_system) {
            $keys = array_column(Permissions::all(), 'key');
        }

        $role->permissions()->sync(
            Permission::query()->whereIn('key', $keys)->pluck('id'),
        );
    }

    private function slug(string $name): string
    {
        $base = Str::slug($name) ?: 'role';
        $slug = $base;
        $suffix = 2;

        while (Role::query()->where('slug', $slug)->exists()) {
            $slug = $base.'-'.$suffix;
            $suffix++;
        }

        return $slug;
    }
}
