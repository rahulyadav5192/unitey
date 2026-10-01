<?php

namespace App\Cms\Pages;

use App\Cms\F;

class TermsPage
{
    public static function definition(): array
    {
        $html = '';
        $path = database_path('content/terms.html');
        if (is_file($path)) {
            $html = file_get_contents($path) ?: '';
        }

        return [
            'slug' => 'terms',
            'name' => 'Terms & conditions',
            'summary' => 'The website terms. Edit the heading, the date, and the full text.',
            'sections' => [
                F::section('seo', 'Browser title', 'The name shown on the browser tab.', [
                    F::text('title', 'Page title', 'Website Terms & Conditions — Unitey'),
                ]),
                F::section('hero', 'Heading', 'The title at the top of the terms.', [
                    F::text('label', 'Small label', 'Unitey Digital Holdings Limited'),
                    F::text('title', 'Title', 'WEBSITE TERMS & CONDITIONS'),
                    F::text('date', 'Date', 'September 2026'),
                ]),
                F::section('document', 'Terms text', 'The full terms. Keep the heading tags so the page keeps its structure.', [
                    F::html('html', 'Terms', $html),
                ]),
            ],
        ];
    }
}
