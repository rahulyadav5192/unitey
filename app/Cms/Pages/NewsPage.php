<?php

namespace App\Cms\Pages;

use App\Cms\F;

class NewsPage
{
    public static function definition(): array
    {
        return [
            'slug' => 'news',
            'name' => 'News',
            'summary' => 'The news list. Mark one story as the featured lead, and older stories as hidden until “See older posts”.',
            'sections' => [
                F::section('seo', 'Browser title', 'The name shown on the browser tab.', [
                    F::text('title', 'Page title', 'News & Insights Unitey'),
                ]),
                F::section('hero', 'Opening screen', 'The photograph and headline.', [
                    F::image('image', 'Background photograph', 'news.jpg'),
                    F::html('headline', 'Headline', 'News, <em>insights</em><br>&amp; perspectives', 'Use <br> for a line break and <em> for italics.'),
                    F::area('text', 'Supporting line', 'Stay informed on developments across Unitey and its portfolio, alongside perspectives on payments and financial infrastructure'),
                ]),
                F::section('intro', 'Introduction', 'The short line above the story grid.', [
                    F::text('eyebrow', 'Small label', 'Unitey Updates'),
                    F::area('text', 'Text', 'Curated content on building sovereign payment infrastructure across MEA, announcements, partnerships, and thought leadership from Unitey and our operating companies.'),
                ]),
                F::section('stories', 'Stories', 'The first story marked “Featured lead” is the large story. Stories marked “Older” stay hidden until the visitor asks for them.', [], [
                    F::group('items', 'Stories', 'Story', [
                        F::check('featured', 'Featured lead', false, 'Use this for the large story at the top. Only one should be checked.'),
                        F::check('older', 'Hide until “See older posts”', false),
                        F::text('tag', 'Label'),
                        F::text('title', 'Title'),
                        F::area('excerpt', 'Summary'),
                        F::text('date', 'Date'),
                        F::image('image', 'Photograph'),
                        F::text('alt', 'Image description'),
                        F::text('url', 'Article link', '', 'A full address, or a path such as /blog-detail.'),
                    ], self::stories()),
                ]),
                F::section('newsletter', 'Newsletter', 'The subscribe band at the bottom.', [
                    F::text('eyebrow', 'Small label', 'Stay Informed'),
                    F::area('text', 'Text', 'Subscribe to our newsletter for the latest insights and updates delivered to your inbox.'),
                    F::text('placeholder', 'Email placeholder', 'Your email address'),
                    F::text('button', 'Button label', 'Subscribe to the Briefing'),
                    F::text('note', 'Small note', 'We send one email per quarter. No spam, unsubscribe any time.'),
                ]),
            ],
        ];
    }

    private static function stories(): array
    {
        return [
            [
                'featured' => true,
                'older' => false,
                'tag' => 'Strategic Voices',
                'title' => 'Mercury receives deemed Open Finance License approval from the Central Bank of the UAE',
                'excerpt' => 'Mercury Payments Services, a leading regional payments infrastructure and technology provider, has been granted approval for a deemed Open Finance License by the Central Bank of the UAE (CBUAE).',
                'date' => '3 November 2025',
                'image' => 'news-nov-2025.jpg',
                'alt' => 'Mercury Open Finance licence',
                'url' => 'https://gulfnews.com/business/corporate-news/mercury-secures-open-finance-license-from-uae-central-bank-boosting-digital-financial-ecosystem-1.500331521',
            ],
            [
                'featured' => false,
                'older' => false,
                'tag' => 'Update',
                'title' => "The Central Bank of the UAE and Mercury launch Strategic Joint Venture to Strengthen UAE's National Financial Market Infrastructure",
                'excerpt' => "The Central Bank of the UAE and Mercury have formed a strategic joint venture, Unitey Business Services, supporting the Financial Infrastructure Transformation programme and enhancing the operations of the UAE's national financial market infrastructure.",
                'date' => '24 July 2025',
                'image' => 'news-jul-2025.jpg',
                'alt' => 'The Central Bank of the UAE and Mercury sign the strategic joint venture agreement',
                'url' => 'https://www.centralbank.ae/media/rnfdtrdk/cbuae-and-mercury-launch-strategic-joint-venture-to-strengthen-uaes-national-payments-infrastructure-en.pdf',
            ],
            [
                'featured' => false,
                'older' => false,
                'tag' => 'Press Release',
                'title' => 'Africa launches first Pan-African card scheme – PAPSSCard',
                'excerpt' => "Unveiled at the 32nd Afreximbank Annual Meetings in Abuja, PAPSSCard is the continent's first Pan-African card scheme — a major step towards financial sovereignty, easier travel and deeper trade integration.",
                'date' => '30 June 2025',
                'image' => 'news-jun-2025.jpg',
                'alt' => 'PAPSSCard launch in Abuja, Nigeria',
                'url' => 'https://www.afreximbank.com/africa-launches-first-pan-african-card-scheme-papsscard/',
            ],
            [
                'featured' => false,
                'older' => false,
                'tag' => 'Press Release',
                'title' => 'Crossfin Singapore launches with investment into UAE-based Unitey',
                'excerpt' => 'The South African fintech investment team at Crossfin has taken its first step towards a global focus, investing in UAE-based Unitey Digital Holdings through its newly established Crossfin Singapore vehicle.',
                'date' => '19 May 2025',
                'image' => 'news-may-2025.jpg',
                'alt' => 'Crossfin Singapore investment into Unitey',
                'url' => 'https://www.crossfin.co.za/post/crossfin-singapore-launches-with-investment-into-uae-based-unitey',
            ],
            [
                'featured' => false,
                'older' => false,
                'tag' => 'Update',
                'title' => 'Mercury gets approval for Retail Payment Services licence from the Central Bank of the UAE',
                'excerpt' => 'Mercury Payments Services, a rapidly growing regional payments infrastructure and services provider, has received approval for the issuance of a Retail Payment Services licence from the Central Bank of the UAE.',
                'date' => '27 March 2024',
                'image' => 'news-mar-2024.jpg',
                'alt' => 'Mercury Retail Payment Services licence',
                'url' => 'https://gulfnews.com/business/corporate-news/mercury-gets-in-principle-approval-for-retail-payment-services-licence-from-uae-central-bank-1.1711452949092',
            ],
            [
                'featured' => false,
                'older' => true,
                'tag' => 'Press Release',
                'title' => 'Mercury Payments Services announces the appointment of Muzaffar Khokhar as Executive Chairman to the board',
                'excerpt' => 'Muzaffar Khokhar, Founder of Unitey Digital and a career entrepreneur in payments and digital identity, has been appointed Executive Chairman of Mercury Payments Services, effective immediately.',
                'date' => '4 April 2023',
                'image' => 'news-apr-2023.jpg',
                'alt' => 'Muzaffar Khokhar appointed Executive Chairman',
                'url' => 'https://gulfnews.com/business/corporate-news/mercury-payments-services-announces-the-appointment-of-muzaffar-khokhar-as-the-executive-chairman-to-the-board-1.1680509413829',
            ],
            [
                'featured' => false,
                'older' => true,
                'tag' => 'Update',
                'title' => 'Unitey Digital Holding announces strategic partnership with Discover Global Network and Hard Yaka Inc.',
                'excerpt' => 'Unitey Digital Holdings has partnered with Discover Financial Services, which operates Discover Global Network, and Hard Yaka Inc. to build Mercury Payments Services into a regional financial services powerhouse.',
                'date' => '5 July 2022',
                'image' => 'news-jul-2022.jpg',
                'alt' => 'Unitey partnership with Discover Global Network and Hard Yaka',
                'url' => 'https://gulfnews.com/business/corporate-news/unitey-digital-holding-announces-strategic-partnership-with-discover-global-network-and-hard-yaka-inc-1.1657003279889',
            ],
        ];
    }
}
