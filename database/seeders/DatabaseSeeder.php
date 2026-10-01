<?php

namespace Database\Seeders;

use App\Cms\Catalog;
use App\Cms\F;
use App\Models\CmsBlock;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'admin@unitey.com'],
            ['name' => 'Unitey Admin', 'password' => 'Unitey#2026'],
        );

        foreach (Catalog::pages() as $page) {
            foreach ($page['sections'] as $section) {
                CmsBlock::query()->firstOrCreate(
                    ['page' => $page['slug'], 'section' => $section['key']],
                    ['data' => F::defaults($section)],
                );
            }
        }
    }
}
