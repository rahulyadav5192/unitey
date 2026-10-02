<?php

namespace App\Access;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Navigation
{
    /**
     * @return array<int, array{key: string, label: string, group: string, url: string, active: bool}>
     */
    public static function items(): array
    {
        $items = [];

        foreach (Permissions::all() as $item) {
            $items[] = [
                ...$item,
                'url' => self::url($item['key']),
                'active' => self::active($item['key']),
            ];
        }

        return $items;
    }

    /**
     * @return array<int, array{key: string, label: string, group: string, url: string, active: bool}>
     */
    public static function visible(?User $user = null): array
    {
        $user ??= Auth::user();

        return array_values(array_filter(
            self::items(),
            fn (array $item) => $user?->allows($item['key']) ?? false,
        ));
    }

    public static function firstUrl(?User $user = null): ?string
    {
        return self::visible($user)[0]['url'] ?? null;
    }

    private static function url(string $key): string
    {
        return match ($key) {
            'overview' => route('admin.home'),
            'messages' => route('admin.messages'),
            'subscribers' => route('admin.subscribers'),
            'users' => route('admin.users.index'),
            'roles' => route('admin.roles.index'),
            default => route('admin.edit', substr($key, 5)),
        };
    }

    private static function active(string $key): bool
    {
        return match ($key) {
            'overview' => request()->routeIs('admin.home'),
            'messages' => request()->routeIs('admin.messages', 'admin.messages.*'),
            'subscribers' => request()->routeIs('admin.subscribers', 'admin.subscribers.*'),
            'users' => request()->routeIs('admin.users.*'),
            'roles' => request()->routeIs('admin.roles.*'),
            default => request()->routeIs('admin.edit', 'admin.update', 'admin.restore')
                && request()->route('page') === substr($key, 5),
        };
    }
}
