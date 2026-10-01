<?php

namespace App\Cms\Pages;

use App\Cms\F;

class SitePage
{
    public static function definition(): array
    {
        return [
            'slug' => 'site',
            'name' => 'Header & footer',
            'summary' => 'The logo, menu, and footer that appear on every page.',
            'hidden' => false,
            'sections' => [
                F::section('brand', 'Logo', 'The mark in the header and footer.', [
                    F::image('logo_light', 'Header logo (for dark backgrounds)', 'uniteywhite1.png'),
                    F::image('logo_dark', 'Footer logo (for light backgrounds)', 'uniteyblue1.png'),
                    F::text('alt', 'Logo description', 'Unitey'),
                ]),
                F::section('menu', 'Menu labels', 'The words in the top menu. Company names in the Portfolio menu come from the Portfolio page.', [
                    F::text('company', 'Company', 'Company'),
                    F::text('portfolio', 'Portfolio', 'Portfolio'),
                    F::text('partners', 'Partners', 'Partners'),
                    F::text('news', 'News', 'News'),
                    F::text('contact', 'Contact button', 'Contact Us'),
                ]),
                F::section('footer', 'Footer', 'The closing band on every page. Portfolio company names are added automatically.', [
                    F::area('blurb', 'Short description', 'Strategic technology holding company architecting digital financial infrastructure across emerging markets.'),
                    F::text('corporate_heading', 'First column heading', 'Corporate'),
                    F::text('explore_heading', 'Second column heading', 'Explore'),
                    F::text('entities_heading', 'Companies column heading', 'Entities'),
                    F::text('hq_heading', 'Address heading', 'Headquarters'),
                    F::html('address', 'Address', 'Gate Avenue, South Zone, Dubai International Financial Centre (DIFC)<br>Dubai, United Arab Emirates', 'Use <br> for a line break.'),
                    F::text('copyright', 'Copyright line', 'Unitey Digital Holdings Limited. All rights reserved © 2026'),
                    F::text('privacy_label', 'Privacy link label', 'Privacy Policy'),
                    F::text('terms_label', 'Terms link label', 'Terms & Conditions'),
                ], [
                    F::group('corporate', 'Corporate links', 'Link', [
                        F::text('label', 'Label'),
                        F::text('url', 'Link', '', 'A path such as /company, or a full web address.'),
                    ], [
                        ['label' => 'Company', 'url' => '/company'],
                        ['label' => 'Partners', 'url' => '/investments'],
                    ]),
                    F::group('explore', 'Explore links', 'Link', [
                        F::text('label', 'Label'),
                        F::text('url', 'Link'),
                    ], [
                        ['label' => 'News', 'url' => '/news'],
                        ['label' => 'Contact Us', 'url' => '/contact'],
                    ]),
                ]),
            ],
        ];
    }
}
