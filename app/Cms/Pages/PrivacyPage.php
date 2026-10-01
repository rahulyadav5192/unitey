<?php

namespace App\Cms\Pages;

use App\Cms\F;

class PrivacyPage
{
    public static function definition(): array
    {
        $html = '';
        $path = database_path('content/privacy.html');
        if (is_file($path)) {
            $html = file_get_contents($path) ?: '';
        }

        return [
            'slug' => 'privacy',
            'name' => 'Privacy policy',
            'summary' => 'The privacy policy. Edit the heading, the date, and the full text.',
            'sections' => [
                F::section('seo', 'Browser title', 'The name shown on the browser tab.', [
                    F::text('title', 'Page title', 'Privacy Policy — Unitey'),
                ]),
                F::section('hero', 'Heading', 'The title at the top of the policy.', [
                    F::text('label', 'Small label', 'Unitey Digital Holdings Limited'),
                    F::text('title', 'Title', 'PRIVACY POLICY'),
                    F::text('date', 'Date', 'September 2026'),
                ]),
                F::section('document', 'Policy text', 'The full policy. Keep the heading tags so the page keeps its structure. Allowed tags: h2, p, ul, li, a, strong, em, br.', [
                    F::html('html', 'Policy', $html),
                ]),
            ],
        ];
    }
}
