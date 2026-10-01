<?php

namespace App\Cms;

class F
{
    public static function text(string $key, string $label, string $default = '', string $hint = ''): array
    {
        return compact('key', 'label', 'default', 'hint') + ['type' => 'text'];
    }

    public static function area(string $key, string $label, string $default = '', string $hint = ''): array
    {
        return compact('key', 'label', 'default', 'hint') + ['type' => 'textarea'];
    }

    public static function html(string $key, string $label, string $default = '', string $hint = ''): array
    {
        return compact('key', 'label', 'default', 'hint') + ['type' => 'html'];
    }

    public static function image(string $key, string $label, string $default = '', string $hint = ''): array
    {
        return compact('key', 'label', 'default', 'hint') + ['type' => 'image'];
    }

    public static function video(string $key, string $label, string $default = '', string $hint = ''): array
    {
        return compact('key', 'label', 'default', 'hint') + ['type' => 'video'];
    }

    public static function check(string $key, string $label, bool $default = false, string $hint = ''): array
    {
        return compact('key', 'label', 'default', 'hint') + ['type' => 'check'];
    }

    public static function select(string $key, string $label, array $options, string $default, string $hint = ''): array
    {
        return compact('key', 'label', 'options', 'default', 'hint') + ['type' => 'select'];
    }

    public static function note(string $label): array
    {
        return ['key' => '', 'label' => $label, 'type' => 'note', 'default' => '', 'hint' => ''];
    }

    public static function group(string $key, string $name, string $item, array $fields, array $default = [], array $groups = [], string $hint = ''): array
    {
        return compact('key', 'name', 'item', 'fields', 'default', 'groups', 'hint');
    }

    public static function section(string $key, string $name, string $help, array $fields = [], array $groups = []): array
    {
        return compact('key', 'name', 'help', 'fields', 'groups');
    }

    public static function defaults(array $section): array
    {
        $data = [];

        foreach ($section['fields'] as $field) {
            if ($field['type'] === 'note') {
                continue;
            }
            $data[$field['key']] = $field['default'] ?? '';
        }

        foreach ($section['groups'] as $group) {
            $data[$group['key']] = $group['default'];
        }

        return $data;
    }
}
