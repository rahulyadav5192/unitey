<?php

namespace App\Cms\Pages;

use App\Cms\F;

class ArticlePage
{
    public static function definition(): array
    {
        return [
            'slug' => 'article',
            'name' => 'Article',
            'summary' => 'The story page linked from the home page.',
            'sections' => [
                F::section('seo', 'Browser title', 'The name shown on the browser tab.', [
                    F::text('title', 'Page title', 'Mercury receives deemed Open Finance License approval from the CBUAE — Unitey'),
                ]),
                F::section('hero', 'Story header', 'The title, date, and photograph.', [
                    F::text('category', 'Category', 'Strategic Voices'),
                    F::text('title', 'Title', 'Mercury receives deemed Open Finance License approval from the Central Bank of the UAE'),
                    F::area('intro', 'Opening summary', 'Mercury Payments Services, a leading regional payments infrastructure and technology provider, has been granted approval for a deemed Open Finance License by the Central Bank of the UAE (CBUAE).'),
                    F::text('date', 'Date', '3 November 2025'),
                    F::text('byline', 'Second detail', 'Unitey Portfolio'),
                    F::image('image', 'Photograph', 'news-nov-2025.jpg'),
                    F::text('alt', 'Image description', 'Mercury receives deemed Open Finance License approval from the Central Bank of the UAE'),
                ]),
                F::section('body', 'Story', 'Add a heading only where a new section starts. Leave the heading blank for a continuing paragraph.', [], [
                    F::group('blocks', 'Sections', 'Section', [
                        F::text('heading', 'Heading', '', 'Optional.'),
                        F::area('text', 'Paragraph'),
                    ], [
                        ['heading' => '', 'text' => "Mercury Payments Services, a leading regional payments infrastructure and technology provider and part of the Unitey portfolio, has been granted approval for a deemed Open Finance License by the Central Bank of the UAE. The approval places Mercury among the institutions authorised to operate within the UAE's Open Finance framework, one of the central pillars of the country's wider financial infrastructure agenda."],
                        ['heading' => 'What the licence enables', 'text' => "The UAE's Open Finance framework is designed to let customers securely share their financial data, and initiate payments, across licensed providers with their explicit consent. For Mercury, the deemed licence confirms its ability to build and operate services on that framework — connecting banks, fintechs and merchants through regulated, consent-driven infrastructure rather than closed bilateral integrations."],
                        ['heading' => 'Building on a regulated foundation', 'text' => "The approval follows Mercury's earlier approval for a Retail Payment Services licence from the Central Bank of the UAE, announced in March 2024. Taken together, the two authorisations extend Mercury's regulated footprint across both payment execution and data-driven financial services — the combination that underpins a modern open finance proposition."],
                        ['heading' => 'Part of a wider infrastructure agenda', 'text' => "The licence also sits alongside the strategic joint venture between the Central Bank of the UAE and Mercury, announced in July 2025, which established Unitey Business Services to support the Financial Infrastructure Transformation programme and the operation of the UAE's national financial market infrastructure."],
                        ['heading' => '', 'text' => 'For Unitey, the progression reflects a consistent thesis: that durable payment systems are built on regulated, locally governed infrastructure — infrastructure that keeps control of critical rails within the market it serves while remaining globally interoperable.'],
                    ]),
                ]),
                F::section('source', 'Source line', 'The credit under the story.', [
                    F::text('label', 'Lead-in', 'Originally reported by'),
                    F::text('name', 'Publication', 'Gulf News'),
                    F::text('url', 'Link', 'https://gulfnews.com/business/corporate-news/mercury-secures-open-finance-license-from-uae-central-bank-boosting-digital-financial-ecosystem-1.500331521'),
                ]),
                F::section('back', 'Back link', 'The link under the story.', [
                    F::text('label', 'Label', 'Back to News'),
                    F::text('url', 'Link', '/news'),
                ]),
                F::section('newsletter', 'Newsletter', 'The subscribe band.', [
                    F::text('eyebrow', 'Small label', 'Stay Informed'),
                    F::text('headline', 'Headline', 'Subscribe to the Briefing'),
                    F::area('text', 'Text', 'Stay informed on developments across Unitey and its portfolio, alongside perspectives on payments and financial infrastructure.'),
                    F::text('placeholder', 'Email placeholder', 'Your email address'),
                    F::text('button', 'Button label', 'Subscribe to the Briefing'),
                    F::text('note', 'Small note', 'We send one email per quarter. No spam, unsubscribe any time.'),
                ]),
            ],
        ];
    }
}
