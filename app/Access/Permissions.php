<?php

namespace App\Access;

use App\Cms\Catalog;
use App\Models\Permission;
use App\Models\Role;

class Permissions
{
    /**
     * @return array<int, array{key: string, label: string, group: string}>
     */
    public static function all(): array
    {
        $items = [
            ['key' => 'overview', 'label' => 'Overview', 'group' => 'General'],
        ];

        foreach (Catalog::publicPages() as $page) {
            $items[] = [
                'key' => 'page.'.$page['slug'],
                'label' => $page['name'],
                'group' => 'Pages',
            ];
        }

        return [
            ...$items,
            ['key' => 'messages', 'label' => 'Messages', 'group' => 'Inbox'],
            ['key' => 'subscribers', 'label' => 'Subscribers', 'group' => 'Inbox'],
            ['key' => 'users', 'label' => 'Users', 'group' => 'Access'],
            ['key' => 'roles', 'label' => 'Roles', 'group' => 'Access'],
        ];
    }

    /**
     * @return array<string, array<int, array{key: string, label: string, group: string}>>
     */
    public static function grouped(): array
    {
        $groups = [];

        foreach (self::all() as $item) {
            $groups[$item['group']][] = $item;
        }

        return $groups;
    }

    public static function sync(): void
    {
        $keys = [];

        foreach (self::all() as $item) {
            Permission::query()->updateOrCreate(
                ['key' => $item['key']],
                ['label' => $item['label'], 'group' => $item['group']],
            );
            $keys[] = $item['key'];
        }

        Permission::query()->whereNotIn('key', $keys)->delete();

        $administrator = Role::query()->firstOrCreate(
            ['slug' => 'administrator'],
            [
                'name' => 'Administrator',
                'description' => 'Full access to every part of the admin.',
                'is_system' => true,
            ],
        );
        $administrator->forceFill(['is_system' => true])->save();
        $administrator->permissions()->sync(Permission::query()->pluck('id'));

        $pageKeys = array_values(array_filter(
            $keys,
            fn (string $key) => $key === 'overview' || str_starts_with($key, 'page.'),
        ));

        $editor = Role::query()->firstOrCreate(
            ['slug' => 'editor'],
            [
                'name' => 'Editor',
                'description' => 'Can edit site pages. Cannot open the inbox or manage people.',
                'is_system' => false,
            ],
        );
        if ($editor->wasRecentlyCreated) {
            $editor->permissions()->sync(
                Permission::query()->whereIn('key', $pageKeys)->pluck('id'),
            );
        }

        $inbox = Role::query()->firstOrCreate(
            ['slug' => 'inbox'],
            [
                'name' => 'Inbox',
                'description' => 'Can read messages and newsletter sign-ups.',
                'is_system' => false,
            ],
        );
        if ($inbox->wasRecentlyCreated) {
            $inbox->permissions()->sync(
                Permission::query()->whereIn('key', ['overview', 'messages', 'subscribers'])->pluck('id'),
            );
        }
    }
}
