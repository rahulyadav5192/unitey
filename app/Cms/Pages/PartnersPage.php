<?php

namespace App\Cms\Pages;

use App\Cms\F;

class PartnersPage
{
    public static function definition(): array
    {
        return [
            'slug' => 'partners',
            'name' => 'Partners',
            'summary' => 'The partners page, including the conversation form.',
            'sections' => [
                F::section('seo', 'Browser title', 'The name shown on the browser tab.', [
                    F::text('title', 'Page title', 'Investments  Unitey'),
                ]),
                F::section('hero', 'Opening screen', 'The photograph and headline.', [
                    F::image('image', 'Background photograph', 'investment.png'),
                    F::text('headline', 'Headline', 'Strategic partnerships advancing financial technology across markets'),
                ]),
                F::section('list', 'Partner profiles', 'Each partner can have one logo, or two side by side.', [
                    F::text('headline', 'Headline', 'Our Strategic Partners'),
                    F::area('intro', 'Introduction', 'We work with leading investors and payment networks that share our vision of payment democratization, strengthening our ecosystem, accelerating innovation, and expanding our global reach.'),
                ], [
                    F::group('items', 'Partners', 'Partner', [
                        F::text('name', 'Name'),
                        F::image('image', 'Logo'),
                        F::image('image_2', 'Second logo', '', 'Optional. Used when two marks sit together, such as Discover and Capital One.'),
                        F::text('alt_2', 'Second logo name'),
                        F::area('text', 'Description'),
                    ], [
                        [
                            'name' => 'Crossfin',
                            'image' => 'partners/crossfin.png',
                            'image_2' => '',
                            'alt_2' => '',
                            'text' => 'Investor with deep fintech expertise in Africa; completed a minority investment in Unitey in May 2025 (via its Singapore entity, with underlying investors including Standard Bank).',
                        ],
                        [
                            'name' => 'Hard Yaka',
                            'image' => 'partners/hard-yaka.png',
                            'image_2' => '',
                            'alt_2' => '',
                            'text' => 'US venture firm focused on universal access to payments, communications, and digital identity; early backer of Square, Ripple, Marqeta, and Robinhood.',
                        ],
                        [
                            'name' => 'Discover and Capital One',
                            'image' => 'partners/discover.png',
                            'image_2' => 'partners/capital one.jfif',
                            'alt_2' => 'Capital One',
                            'text' => "One of the world's largest payment networks and a commercial partner to Mercury in the UAE, providing international Discover card acceptance.",
                        ],
                    ]),
                ]),
                F::section('cta', 'Portfolio invitation', 'The band that leads to the portfolio.', [
                    F::image('image', 'Background photograph', 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=1900&q=80'),
                    F::text('eyebrow', 'Small label', 'Our Portfolio'),
                    F::text('headline', 'Headline', 'A Diversified Business Portfolio'),
                    F::area('text', 'Supporting line', "Unitey's portfolio spans complementary businesses across payments, technology, financial services, and national infrastructure."),
                    F::text('button_label', 'Button label', 'Explore Portfolio'),
                    F::text('button_url', 'Button link', '/portfolio'),
                ]),
                F::section('connect', 'Strategic connect', 'The contact details and the form on this page.', [
                    F::text('eyebrow', 'Small label', 'Connect'),
                    F::text('headline', 'Headline', 'Strategic Connect'),
                    F::area('text', 'Introduction', 'Start a conversation with our team or propose a collaboration via the form, or email info@unitey.com.'),
                    F::text('email_label', 'Email label', 'Email'),
                    F::text('email', 'Email', 'info@unitey.com'),
                    F::text('address_label', 'Address label', 'Address'),
                    F::html('address', 'Address', 'Gate Avenue, South Zone<br>DIFC, Dubai, UAE'),
                    F::text('phone_label', 'Phone label', 'Phone'),
                    F::text('phone', 'Phone', '+971 4 121 4987'),
                    F::text('name_label', 'Name field', 'Full Name'),
                    F::text('name_placeholder', 'Name placeholder', 'Your name'),
                    F::text('email_field', 'Email field', 'Email Address'),
                    F::text('email_placeholder', 'Email placeholder', 'you@company.com'),
                    F::text('business_label', 'Business field', 'Business Name'),
                    F::text('business_placeholder', 'Business placeholder', 'Your company'),
                    F::text('phone_field', 'Phone field', 'Phone Number'),
                    F::text('phone_placeholder', 'Phone placeholder', '+1 234 567 8900'),
                    F::text('country_label', 'Country field', 'Country / Market'),
                    F::text('country_placeholder', 'Country placeholder', 'e.g. United Arab Emirates'),
                    F::text('inquiry_label', 'Inquiry field', 'Inquiry Type'),
                    F::text('inquiry_placeholder', 'Inquiry placeholder', 'Select an inquiry type'),
                    F::text('message_label', 'Message field', 'Message'),
                    F::text('message_placeholder', 'Message placeholder', 'Describe your proposal or question...'),
                    F::text('button_label', 'Submit button', 'Submit'),
                ], [
                    F::group('types', 'Inquiry types', 'Type', [
                        F::text('label', 'Label'),
                    ], [
                        ['label' => 'Investment Opportunity'],
                        ['label' => 'Partnership Proposal'],
                        ['label' => 'Investor Relations'],
                        ['label' => 'General Inquiry'],
                    ]),
                ]),
            ],
        ];
    }
}
