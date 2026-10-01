<?php

namespace App\Cms\Pages;

use App\Cms\F;

class PortfolioPage
{
    public static function definition(): array
    {
        $companyFields = [
            F::note('Identity'),
            F::text('anchor', 'Page anchor', '', 'Used in links such as /portfolio#shukria. Use lowercase letters, no spaces.'),
            F::text('name', 'Name'),
            F::text('category', 'Category', '', 'Shown in the menu under Portfolio, and on the banner.'),
            F::image('tab_logo', 'Tab logo'),
            F::text('tab_height', 'Tab logo height', '34', 'Pixels.'),
            F::image('home_logo', 'Logo on the home page'),
            F::area('home_summary', 'Short description on the home page'),
            F::note('Banner'),
            F::image('banner_image', 'Banner photograph'),
            F::image('banner_logo', 'Banner logo'),
            F::text('banner_logo_height', 'Banner logo height', '52', 'Pixels.'),
            F::text('banner_logo_url', 'Logo link', '', 'Optional. Leave blank if the logo should not be a link.'),
            F::area('summary', 'Banner description'),
            F::text('button_label', 'Button label', 'Know More'),
            F::text('button_url', 'Button link', '', 'Leave blank to show “Website coming soon”.'),
            F::text('button_note', 'Note under a disabled button', 'Website coming soon'),
            F::note('Capabilities'),
            F::text('caps_label', 'Capabilities label', 'Capabilities'),
            F::text('badge', 'Credential line', '', 'Optional. For example, a regulator or partnership line.'),
            F::image('side_image', 'Photograph beside the capabilities'),
            F::text('side_alt', 'Photograph description'),
            F::note('Closing credential'),
            F::text('credential_label', 'Credential label', '', 'Leave the title blank to hide this block.'),
            F::text('credential_title', 'Credential title'),
            F::area('credential_text', 'Credential text'),
        ];

        $capability = [
            F::text('title', 'Title'),
            F::area('text', 'Description'),
        ];

        return [
            'slug' => 'portfolio',
            'name' => 'Portfolio',
            'summary' => 'Each operating company, including the home-page card, menu, and footer name.',
            'sections' => [
                F::section('seo', 'Browser title', 'The name shown on the browser tab.', [
                    F::text('title', 'Page title', 'Portfolio  Unitey'),
                ]),
                F::section('hero', 'Opening screen', 'The photograph and headline at the top.', [
                    F::image('image', 'Background photograph', 'portfolio.png'),
                    F::html('headline', 'Headline', 'Empowering the Builders of<br>Tomorrow\'s Financial Systems'),
                    F::area('text', 'Supporting line', 'A unified ecosystem of financial technology companies, each bringing unique capabilities to serve diverse markets and customer needs'),
                ]),
                F::section('companies', 'Companies', 'Add, remove, or reorder a company. Changes also update the home page cards, the Portfolio menu, and the footer.', [], [
                    F::group('items', 'Companies', 'Company', $companyFields, self::companies(), [
                        F::group('capabilities', 'Capability list', 'Capability', $capability),
                        F::group('products', 'Product cards', 'Product', [
                            F::text('label', 'Label'),
                            F::image('image', 'Image'),
                            F::text('height', 'Image height', '66', 'Pixels.'),
                            F::text('alt', 'Image description'),
                            F::area('text', 'Description'),
                        ], [], [], 'Used by MPS Global. Leave empty for the other companies.'),
                        F::group('marks', 'Partner marks', 'Mark', [
                            F::image('image', 'Logo'),
                            F::text('height', 'Height', '40', 'Pixels.'),
                            F::text('alt', 'Name'),
                        ], [], [], 'Small logos beside the credential line, such as Powered by Mercury.'),
                    ]),
                ]),
                F::section('cta', 'Closing invitation', 'The band before the footer.', [
                    F::image('image', 'Background photograph', 'https://images.unsplash.com/photo-1557804506-669a67965ba0?auto=format&fit=crop&w=1900&q=80'),
                    F::html('headline', 'Headline', 'Building the next chapter of <em>financial services?</em>'),
                    F::area('text', 'Supporting line', 'Connect with us to explore partnerships, opportunities, and collaboration across the Unitey portfolio'),
                    F::text('button_label', 'Button label', 'Connect with Us'),
                    F::text('button_url', 'Button link', '/contact'),
                ]),
            ],
        ];
    }

    private static function companies(): array
    {
        return [
            [
                'anchor' => 'shukria',
                'name' => 'Shukria',
                'category' => 'Payment Services',
                'tab_logo' => 'Shukria_logo.png',
                'tab_height' => '34',
                'home_logo' => 'Shukria_logo.png',
                'home_summary' => 'A business licensed by The Central Bank of the UAE, powered by Mercury, delivering acquiring, issuing and lending solutions to businesses, while enabling banks and fintechs through white-labelled payment infrastructure.',
                'banner_image' => 'shukria-background.png',
                'banner_logo' => 'shukria-logo-white.png',
                'banner_logo_height' => '52',
                'banner_logo_url' => 'https://www.shukria.ae/',
                'summary' => 'Shukria delivers payment solutions designed around the needs of businesses, while enabling banks and fintechs with the technology and capabilities to launch and scale their own payment propositions.',
                'button_label' => 'Know More',
                'button_url' => 'https://www.shukria.ae/',
                'button_note' => 'Website coming soon',
                'caps_label' => 'Capabilities',
                'badge' => 'Regulated by the Central Bank of the UAE',
                'side_image' => 'shukria-capabilities.jpg',
                'side_alt' => 'Shukria payment acceptance in store',
                'credential_label' => 'Regulatory Credential',
                'credential_title' => 'Licensed by the Central Bank of the UAE',
                'credential_text' => 'Shukria operates under a Retail Payment Services licence issued by the Central Bank of the UAE, delivering compliant, regulated payment solutions to merchants and financial institutions across the UAE.',
                'capabilities' => [
                    ['title' => 'Digital Payments', 'text' => 'Payment solutions across in-store, online, and mobile channels.'],
                    ['title' => 'Acquiring Services', 'text' => 'End-to-end acquiring capabilities supporting businesses across different payment acceptance needs.'],
                    ['title' => 'Issuing Services', 'text' => 'Technology and processing capabilities for banks and financial institutions to launch and manage card programs.'],
                    ['title' => 'Engagement & Growth Services', 'text' => 'Value-added solutions that help businesses strengthen customer engagement, improve cash flow, and support growth.'],
                    ['title' => 'Open Finance Solutions', 'text' => 'Open Finance TPP services for banks, fintechs, and enterprises to enable secure data access, account-to-account payments, risk assessment, and more.'],
                ],
                'products' => [],
                'marks' => [
                    ['image' => 'powered-by-mercury.png', 'height' => '', 'alt' => 'Powered by Mercury'],
                ],
            ],
            [
                'anchor' => 'mps',
                'name' => 'MPS Global',
                'category' => 'Sovereign Payment Infrastructure',
                'tab_logo' => 'mps-logo.png',
                'tab_height' => '26',
                'home_logo' => 'mps-logo.png',
                'home_summary' => 'A payments infrastructure company helping governments, central banks, and financial institutions design, build, and operate secure national payment systems and financial market infrastructure.',
                'banner_image' => 'mps-background.png',
                'banner_logo' => 'mercury-logo-white.png',
                'banner_logo_height' => '38',
                'banner_logo_url' => '',
                'summary' => 'Partnering with governments and financial institutions to design, build, and operate sovereign payment ecosystems — enabling interoperable payment capabilities that support financial independence, resilience, and inclusive growth.',
                'button_label' => 'Know More',
                'button_url' => '',
                'button_note' => 'Website coming soon',
                'caps_label' => 'Capabilities',
                'badge' => '',
                'side_image' => 'national-payment-infrastructure.jpg',
                'side_alt' => 'Sovereign payment infrastructure',
                'credential_label' => '',
                'credential_title' => '',
                'credential_text' => '',
                'capabilities' => [
                    ['title' => 'Advisory & Research', 'text' => 'Strategic insights and advisory supporting payment transformation and market development.'],
                    ['title' => 'Program Management', 'text' => 'End-to-end management from planning and implementation through delivery.'],
                    ['title' => 'Business Operations', 'text' => 'Ongoing operational service support to ensure secure, reliable, and resilient payment services.'],
                ],
                'products' => [
                    ['label' => 'Technology Stack', 'image' => 'scheme-in-a-box.png', 'height' => '66', 'alt' => 'Scheme in a Box', 'text' => 'An end-to-end framework for building and launching payment schemes, combining technology, expertise, and operational capabilities.'],
                    ['label' => 'Switching Platform', 'image' => 'mps-switch.png', 'height' => '83', 'alt' => 'MPS Switch', 'text' => 'A scalable payment switching platform supporting secure transaction routing, processing, and interoperability across networks.'],
                ],
                'marks' => [],
            ],
            [
                'anchor' => 'ubs',
                'name' => 'Unitey Business Services',
                'category' => 'Managed Infrastructure Services',
                'tab_logo' => 'unitey-logo.png',
                'tab_height' => '46',
                'home_logo' => 'unitey-logo.png',
                'home_summary' => 'A joint venture with the Central Bank of the UAE, supporting critical national payment infrastructure across the national switch and scheme, CSD, eKYC, and the emerging Open Finance layer.',
                'banner_image' => 'unitey-background.png',
                'banner_logo' => 'unitey-logo-white.png',
                'banner_logo_height' => '64',
                'banner_logo_url' => '',
                'summary' => 'Supporting governments and financial institutions with the technology, operations, and expertise required to manage critical financial market infrastructure — operating securely, efficiently, and with long-term resilience.',
                'button_label' => 'Know More',
                'button_url' => '',
                'button_note' => 'Website coming soon',
                'caps_label' => 'Capabilities',
                'badge' => 'In partnership with the Central Bank of the UAE',
                'side_image' => 'managed-institutional-solutions.jpg',
                'side_alt' => 'Managed financial market infrastructure',
                'credential_label' => 'Strategic Partnership',
                'credential_title' => 'Joint Venture with the Central Bank of the UAE',
                'credential_text' => "Established as a strategic joint venture with the Central Bank of the UAE (CBUAE) to support the nation's Financial Infrastructure Transformation programme — strengthening critical national payment infrastructure from the switching layer to the emerging open finance ecosystem.",
                'capabilities' => [
                    ['title' => 'Advisory & Research', 'text' => 'Strategic advisory and market insight to support institutional planning, transformation, and informed decision-making.'],
                    ['title' => 'Technology Services', 'text' => 'Technology capabilities spanning the implementation, integration, and ongoing support of critical financial systems.'],
                    ['title' => 'Business Operations', 'text' => 'End-to-end operational services that support the reliable and efficient functioning of financial platforms and services.'],
                    ['title' => 'Enterprise Services', 'text' => 'Specialist corporate and shared services that strengthen governance, operations, and organisational capability.'],
                ],
                'products' => [],
                'marks' => [],
            ],
            [
                'anchor' => 'papss',
                'name' => 'PAPSSCard',
                'category' => 'Pan-African Card Scheme',
                'tab_logo' => 'papps.svg',
                'tab_height' => '42',
                'home_logo' => 'papps.svg',
                'home_summary' => 'PAPSSCard is a joint venture between Mercury and Afreximbank, established to deliver a pan-African card scheme that enables secure, sovereign, and seamless payments across Africa.',
                'banner_image' => 'papsscard.jpg',
                'banner_logo' => 'papps.svg',
                'banner_logo_height' => '60',
                'banner_logo_url' => '',
                'summary' => 'A joint venture between Mercury and Afreximbank, established to develop a Pan-African card scheme that strengthens payment connectivity across the continent — enabling local-currency payments and in-country settlement across African markets.',
                'button_label' => 'Know More',
                'button_url' => 'https://papss.com/papsscard/',
                'button_note' => 'Website coming soon',
                'caps_label' => 'Capabilities',
                'badge' => 'Joint venture partners',
                'side_image' => 'papsscard.jpg',
                'side_alt' => 'PAPSSCard',
                'credential_label' => 'Founding Joint Venture',
                'credential_title' => 'Established by Mercury & Afreximbank',
                'credential_text' => 'A joint venture between Mercury and Afreximbank to develop the first Pan-African card scheme — enabling local-currency payments and in-country settlement across participating African markets.',
                'capabilities' => [
                    ['title' => 'Domestic Routing & Settlement', 'text' => 'Supports local transaction processing and settlement within participating markets.'],
                    ['title' => 'Regional Connectivity', 'text' => 'Connects national card schemes to enable payments across African markets.'],
                    ['title' => 'Pan-African Acceptance', 'text' => 'Extends card acceptance across participating countries through a common regional scheme.'],
                    ['title' => 'Global Acceptance', 'text' => "Extends PAPSSCard acceptance internationally through Mercury's global acceptance network."],
                ],
                'products' => [],
                'marks' => [
                    ['image' => 'mercury-logo.png', 'height' => '18', 'alt' => 'Mercury'],
                    ['image' => 'afreximbank-logo.png', 'height' => '46', 'alt' => 'Afreximbank'],
                ],
            ],
        ];
    }
}
