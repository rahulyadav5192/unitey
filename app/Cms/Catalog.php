<?php

namespace App\Cms;

use App\Cms\Pages\ArticlePage;
use App\Cms\Pages\CompanyPage;
use App\Cms\Pages\ContactPage;
use App\Cms\Pages\HomePage;
use App\Cms\Pages\NewsPage;
use App\Cms\Pages\PartnersPage;
use App\Cms\Pages\PortfolioPage;
use App\Cms\Pages\PrivacyPage;
use App\Cms\Pages\SitePage;
use App\Cms\Pages\TermsPage;

class Catalog
{
    public static function pages(): array
    {
        return [
            'site' => SitePage::definition(),
            'home' => HomePage::definition(),
            'company' => CompanyPage::definition(),
            'portfolio' => PortfolioPage::definition(),
            'partners' => PartnersPage::definition(),
            'news' => NewsPage::definition(),
            'article' => ArticlePage::definition(),
            'contact' => ContactPage::definition(),
            'privacy' => PrivacyPage::definition(),
            'terms' => TermsPage::definition(),
        ];
    }

    public static function publicPages(): array
    {
        return array_filter(self::pages(), fn (array $page) => empty($page['hidden']));
    }

    public static function page(string $slug): array
    {
        $pages = self::pages();

        abort_unless(isset($pages[$slug]), 404);

        return $pages[$slug];
    }

    public static function defaults(string $page, string $section): array
    {
        foreach (self::page($page)['sections'] as $block) {
            if ($block['key'] === $section) {
                return F::defaults($block);
            }
        }

        abort(404);
    }

    public static function viewMap(): array
    {
        return [
            'pages.index' => 'home',
            'pages.company' => 'company',
            'pages.portfolio' => 'portfolio',
            'pages.investments' => 'partners',
            'pages.news' => 'news',
            'pages.blog-detail' => 'article',
            'pages.contact' => 'contact',
            'pages.privacy-policy' => 'privacy',
            'pages.terms-conditions' => 'terms',
        ];
    }
}
