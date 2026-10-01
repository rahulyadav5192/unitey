<?php

namespace App\Services;

use App\Cms\Catalog;
use App\Models\CmsBlock;
use Illuminate\Support\Facades\Schema;

class CmsStore
{
    public function page(string $slug): array
    {
        $definition = Catalog::page($slug);
        $stored = $this->stored($slug);
        $out = [];

        foreach ($definition['sections'] as $section) {
            $out[$section['key']] = $stored[$section['key']] ?? Catalog::defaults($slug, $section['key']);
        }

        return $out;
    }

    public function stored(string $slug): array
    {
        try {
            if (! Schema::hasTable('cms_blocks')) {
                return [];
            }
        } catch (\Throwable) {
            return [];
        }

        return CmsBlock::query()
            ->where('page', $slug)
            ->get()
            ->mapWithKeys(fn (CmsBlock $block) => [$block->section => $block->data])
            ->all();
    }

    public static function media(?string $path): string
    {
        if ($path === null || $path === '') {
            return '';
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://') || str_starts_with($path, 'data:')) {
            return $path;
        }

        return asset(ltrim($path, '/'));
    }

    public static function href(?string $path): string
    {
        if ($path === null || $path === '') {
            return '#';
        }

        if (
            str_starts_with($path, 'http://')
            || str_starts_with($path, 'https://')
            || str_starts_with($path, 'mailto:')
            || str_starts_with($path, 'tel:')
            || str_starts_with($path, '#')
        ) {
            return $path;
        }

        return url($path);
    }
}
