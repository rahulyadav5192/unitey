<?php

namespace App\Cms\Pages;

use App\Cms\F;

class HomePage
{
    public static function definition(): array
    {
        return [
            'slug' => 'home',
            'name' => 'Home',
            'summary' => 'The opening page: hero, numbers, pillars, companies, partners, and news.',
            'sections' => [
                F::section('seo', 'Browser title', 'The name shown on the browser tab.', [
                    F::text('title', 'Page title', 'Unitey Democratizing the Global Financial Fabric'),
                ]),
                F::section('hero', 'Opening screen', 'The full-screen introduction over the background video.', [
                    F::html('headline', 'Headline', 'Democratizing the global<br>financial fabric', 'Use <br> to break the line.'),
                    F::text('button_label', 'Button label', 'Explore Our Companies'),
                    F::text('button_url', 'Button link', '/portfolio'),
                    F::video('video', 'Background video', 'video.mp4', 'MP4. It plays silently behind the headline.'),
                ]),
                F::section('intro', 'Introduction and numbers', 'The statement under the hero, and the four figures.', [
                    F::area('lead', 'Opening statement', 'Unitey is a UAE-based holding company, investing in and scaling financial technology businesses across the Middle East and Africa.'),
                    F::area('mission', 'Mission', 'Our mission is to advance sovereign national payment infrastructure and deepen financial inclusion through technology, partnerships, and bold execution.'),
                ], [
                    F::group('stats', 'Figures', 'Figure', [
                        F::text('value', 'Number', '', 'Digits only, for example 2021 or 60.'),
                        F::text('suffix', 'Suffix', '', 'Optional, for example +.'),
                        F::text('label', 'Label'),
                    ], [
                        ['value' => '2021', 'suffix' => '', 'label' => 'Founded'],
                        ['value' => '5', 'suffix' => '+', 'label' => 'Companies'],
                        ['value' => '60', 'suffix' => '+', 'label' => 'Countries'],
                        ['value' => '100', 'suffix' => '+', 'label' => 'Strategic Partnerships'],
                    ]),
                ]),
                F::section('pillars', 'Strategic pillars', 'The three pillars and their photographs.', [
                    F::text('eyebrow', 'Small label', 'OUR STRATEGIC PILLARS'),
                    F::text('headline', 'Headline', 'Building the infrastructure behind the digital payments economy'),
                ], [
                    F::group('items', 'Pillars', 'Pillar', [
                        F::text('title', 'Title'),
                        F::area('text', 'Description'),
                        F::image('image', 'Photograph'),
                        F::text('alt', 'Image description'),
                    ], [
                        [
                            'title' => 'National Payment Infrastructure',
                            'text' => 'Partnering with central banks to build resilient domestic payment infrastructure that strengthens financial sovereignty and enables sustainable economic growth.',
                            'image' => 'national-payment-infrastructure.jpg',
                            'alt' => 'National Payment Infrastructure',
                        ],
                        [
                            'title' => 'Merchant & Consumer Inclusion',
                            'text' => 'Expanding access to digital financial services by enabling businesses and individuals to participate in the digital economy through accessible, interoperable payment solutions.',
                            'image' => 'merchant-consumer-inclusion.png',
                            'alt' => 'Merchant and Consumer Inclusion',
                        ],
                        [
                            'title' => 'Managed Institutional Solutions',
                            'text' => 'Delivering managed services that enable central banks and financial institutions to operate resilient, secure, and future-ready financial ecosystems.',
                            'image' => 'managed-institutional-solutions.jpg',
                            'alt' => 'Managed Institutional Solutions',
                        ],
                    ]),
                ]),
                F::section('network', 'Operating companies', 'The heading above the company cards. The cards themselves are edited on the Portfolio page.', [
                    F::text('eyebrow', 'Small label', 'OUR OPERATING COMPANIES'),
                    F::html('headline', 'Headline', 'The Unitey network powering<br>the digital ecosystem', 'Use <br> for a line break.'),
                    F::html('statement', 'Supporting line', 'Businesses that drive financial inclusion and <br>transformation in the MEA region.'),
                    F::text('button_label', 'Button label', 'Explore Portfolio'),
                    F::text('button_url', 'Button link', '/portfolio'),
                ]),
                F::section('partners', 'Partner logos', 'The scrolling row of partner marks.', [
                    F::text('label', 'Label', 'Our Partners'),
                ], [
                    F::group('items', 'Logos', 'Logo', [
                        F::text('name', 'Name'),
                        F::image('image', 'Logo'),
                        F::text('height', 'Height in pixels', '40', 'How tall the logo should appear, for example 40.'),
                    ], [
                        ['name' => 'Discover', 'image' => 'partners/discover.png', 'height' => '40'],
                        ['name' => 'Hard Yaka', 'image' => 'partners/hard-yaka.png', 'height' => '26'],
                        ['name' => 'Crossfin', 'image' => 'partners/crossfin.png', 'height' => '26'],
                        ['name' => 'Afreximbank', 'image' => 'partners/afrex.png', 'height' => '58'],
                        ['name' => 'FEDA', 'image' => 'partners/feda.png', 'height' => '43'],
                        ['name' => 'Capital One', 'image' => 'partners/capital one.jfif', 'height' => '36'],
                    ]),
                ]),
                F::section('sovereign', 'Map statement', 'The line over the world map.', [
                    F::html('headline', 'Headline', 'Building Sovereign <span>Financial Infrastructure</span>', 'Wrap the gold words in <span>.</span>'),
                    F::area('text', 'Paragraph', "From the UAE to Africa, we're establishing the foundation for inclusive and independent financial ecosystems that empower nations and their people"),
                    F::text('button_label', 'Button label', 'About Unitey'),
                    F::text('button_url', 'Button link', '/company'),
                ]),
                F::section('insights', 'News highlights', 'The three stories on the home page. The full list is edited on the News page.', [
                    F::text('eyebrow', 'Small label', 'Unitey Updates'),
                    F::text('headline', 'Headline', 'News & Insights'),
                    F::text('button_label', 'Button label', 'View All'),
                    F::text('button_url', 'Button link', '/news'),
                ], [
                    F::group('stories', 'Stories', 'Story', [
                        F::select('layout', 'Placement', [
                            'feature' => 'Large story on the left',
                            'text' => 'Compact story, no image',
                            'thumb' => 'Compact story with a thumbnail',
                        ], 'feature'),
                        F::text('eyebrow', 'Label'),
                        F::text('title', 'Title'),
                        F::area('excerpt', 'Summary', '', 'Used on the large story.'),
                        F::text('date', 'Date'),
                        F::image('image', 'Image'),
                        F::text('alt', 'Image description'),
                        F::text('url', 'Read link', '', 'A page path such as /blog-detail, or a full article address.'),
                    ], [
                        [
                            'layout' => 'feature',
                            'eyebrow' => 'Press Release',
                            'title' => "The Central Bank of the UAE and Mercury launch Strategic Joint Venture to Strengthen UAE's National Financial Market Infrastructure",
                            'excerpt' => "The Central Bank of the UAE and Mercury have formed a strategic joint venture, Unitey Business Services, supporting the Financial Infrastructure Transformation programme and enhancing the operations of the UAE's national financial market infrastructure.",
                            'date' => '24 July 2025',
                            'image' => 'news-jul-2025.jpg',
                            'alt' => 'The Central Bank of the UAE and Mercury sign the strategic joint venture agreement',
                            'url' => 'https://www.centralbank.ae/media/rnfdtrdk/cbuae-and-mercury-launch-strategic-joint-venture-to-strengthen-uaes-national-payments-infrastructure-en.pdf',
                        ],
                        [
                            'layout' => 'text',
                            'eyebrow' => 'Press Release',
                            'title' => 'Africa launches first Pan-African card scheme – PAPSSCard',
                            'excerpt' => '',
                            'date' => '30 June 2025',
                            'image' => '',
                            'alt' => '',
                            'url' => 'https://www.afreximbank.com/africa-launches-first-pan-african-card-scheme-papsscard/',
                        ],
                        [
                            'layout' => 'thumb',
                            'eyebrow' => 'Update',
                            'title' => 'Mercury receives deemed Open Finance License approval from the Central Bank of the UAE',
                            'excerpt' => '',
                            'date' => '3 November 2025',
                            'image' => 'news-nov-2025.jpg',
                            'alt' => 'Mercury Open Finance licence',
                            'url' => '/blog-detail',
                        ],
                    ]),
                ]),
                F::section('cta', 'Closing invitation', 'The last band before the footer.', [
                    F::image('image', 'Background photograph', 'https://images.unsplash.com/photo-1477959858617-67f85cf4f1df?auto=format&fit=crop&w=1900&q=75'),
                    F::html('headline', 'Headline', 'Building payment infrastructure<br>for a market or <em>a region?</em>', 'Use <br> for a line break and <em> for the italic words.'),
                    F::area('text', 'Supporting line', 'We work directly with central banks, payment schemes and financial institutions across the Middle East and Africa'),
                    F::text('button_label', 'Button label', 'Talk to the Team'),
                    F::text('button_url', 'Button link', '/contact'),
                ]),
            ],
        ];
    }
}
