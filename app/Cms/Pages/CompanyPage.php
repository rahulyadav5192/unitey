<?php

namespace App\Cms\Pages;

use App\Cms\F;

class CompanyPage
{
    public static function definition(): array
    {
        return [
            'slug' => 'company',
            'name' => 'Company',
            'summary' => 'About Unitey, the approach, the timeline, and the leadership team.',
            'sections' => [
                F::section('seo', 'Browser title', 'The name shown on the browser tab.', [
                    F::text('title', 'Page title', 'Company  Unitey'),
                ]),
                F::section('hero', 'Opening screen', 'The photograph and headline at the top.', [
                    F::image('image', 'Background photograph', 'company-hero.jpg'),
                    F::html('headline', 'Headline', 'Driving Sovereign<br>Financial Infrastructure', 'Use <br> for a line break.'),
                    F::text('text', 'Supporting line', 'Building the businesses behind the digital economy'),
                ]),
                F::section('about', 'About', 'The split section with the photograph and purpose.', [
                    F::image('image', 'Photograph', 'about-unitey.png'),
                    F::text('alt', 'Image description', 'About Unitey'),
                    F::text('eyebrow', 'Small label', 'About Unitey'),
                    F::html('headline', 'Headline', 'Building a more inclusive financial<br>playing field'),
                    F::area('intro', 'Introduction', 'Unitey brings together ambitious businesses, deep operating expertise, and long-term investment to build companies designed to lead, scale, and endure.'),
                    F::text('purpose_label', 'Purpose label', 'Our Purpose'),
                    F::text('purpose_title', 'Purpose title', 'Democratizing financial progress'),
                    F::area('purpose_text', 'Purpose text', 'To create broader access and opportunity by investing in businesses that strengthen the foundations of the digital financial economy.'),
                    F::text('ambition_label', 'Ambition label', 'Our Ambition'),
                    F::text('ambition_title', 'Ambition title', 'Building a globally relevant financial technology group'),
                    F::area('ambition_text', 'Ambition text', 'To scale businesses across high-growth markets, creating enduring companies with meaningful economic impact.'),
                ]),
                F::section('approach', 'Approach', 'The four ways Unitey works with its businesses.', [
                    F::text('eyebrow', 'Small label', 'Our Approach'),
                    F::html('headline', 'Headline', 'Advancing financial sovereignty<br><em>Expanding access</em>', 'Use <br> for a line break and <em> for the italic line.'),
                ], [
                    F::group('items', 'Points', 'Point', [
                        F::text('number', 'Number', '', 'Shown as 01, 02, and so on.'),
                        F::text('title', 'Title'),
                        F::area('text', 'Description'),
                    ], [
                        ['number' => '01', 'title' => 'Capital', 'text' => 'Long-term investment aligned with the ambitions of our businesses.'],
                        ['number' => '02', 'title' => 'Technology', 'text' => 'Infrastructure and technical capabilities that enable innovation at scale.'],
                        ['number' => '03', 'title' => 'Operating Expertise', 'text' => 'Deep expertise across payments, financial infrastructure, and regulated markets.'],
                        ['number' => '04', 'title' => 'Partnerships', 'text' => 'Strategic relationships across governments, institutions, and industry that create opportunities for growth.'],
                    ]),
                ]),
                F::section('journey', 'Journey', 'The timeline. Add a year to extend it.', [
                    F::text('eyebrow', 'Small label', 'Our Journey'),
                    F::text('headline', 'Headline', 'The Evolution of Unitey'),
                    F::text('intro', 'Supporting line', 'From founding vision to multi-entity sovereign infrastructure company.'),
                ], [
                    F::group('events', 'Milestones', 'Milestone', [
                        F::text('year', 'Year'),
                        F::text('title', 'Title'),
                        F::area('text', 'Description'),
                    ], [
                        ['year' => '2021', 'title' => 'Unitey Founded', 'text' => 'Unitey was founded by payment industry veterans with a vision to build inclusive, interoperable, and sovereign financial ecosystems.'],
                        ['year' => '2022', 'title' => 'Acquisition of Mercury', 'text' => 'Unitey, together with Discover Financial Services (Capital One) and Hard Yaka, acquired Mercury, a leading UAE payment network with more than 400,000 payment cards and global acceptance.'],
                        ['year' => '2023', 'title' => 'Sovereign Infrastructure Role Expands', 'text' => 'Mercury expanded its role by supporting governments in building and operating sovereign financial infrastructure.'],
                        ['year' => '2024', 'title' => 'Retail Payment Services License & Shukria', 'text' => 'Mercury was awarded the Retail Payment Services License by the Central Bank of the UAE and launched Shukria to strengthen merchant services.'],
                        ['year' => '2025', 'title' => 'MPS Global & PAPSSCard', 'text' => 'MPS Global was incorporated to scale its Scheme in a Box across the Middle East and Africa. PAPSSCard was launched the same year, in partnership with Afreximbank, to establish a PanAfrican card scheme.'],
                        ['year' => '2025', 'title' => 'Unitey Business Services', 'text' => "Unitey Business Services was established as a joint venture with the Central Bank of the UAE to support the nation's Financial Infrastructure Transformation programme."],
                        ['year' => '2025', 'title' => 'Mercury Secures Open Finance License', 'text' => 'Mercury received deemed approval from the Central Bank of the UAE for its Open Finance license, connecting banks, fintechs, and enterprises through its Open Finance platform.'],
                        ['year' => '2026', 'title' => 'Shukria Goes Live', 'text' => 'Shukria commenced operations in the UAE, bringing merchant acquiring and card issuing services under the Shukria brand.'],
                    ]),
                ]),
                F::section('team', 'Leadership', 'Photographs and roles. Leave the LinkedIn field blank to hide the icon.', [
                    F::text('eyebrow', 'Small label', 'Our Leadership'),
                    F::text('headline', 'Headline', 'Leadership Team'),
                ], [
                    F::group('people', 'People', 'Person', [
                        F::text('name', 'Name'),
                        F::text('role', 'Role'),
                        F::image('image', 'Photograph'),
                        F::text('linkedin', 'LinkedIn address', '', 'Optional. A full profile address.'),
                    ], [
                        ['name' => 'Muzaffar Khokhar', 'role' => 'Founder & Executive Chairman', 'image' => 'team-muzaffar-khokhar.png', 'linkedin' => ''],
                        ['name' => 'Muzaffer Hamid', 'role' => 'Co-Founder', 'image' => 'team-muzaffer-hamid.png', 'linkedin' => ''],
                        ['name' => 'Gururaj Balakrishna', 'role' => 'Co-Founder', 'image' => 'team-gururaj-balakrishna.png', 'linkedin' => ''],
                        ['name' => 'Sanjeev Shriya', 'role' => 'Board Member', 'image' => 'team-sanjeev-shriya.png', 'linkedin' => ''],
                        ['name' => 'Anton Gaylard', 'role' => 'Board Member', 'image' => 'team-anton-gaylard.png', 'linkedin' => ''],
                    ]),
                ]),
                F::section('founder', "Founder's perspective", 'The portrait and quote.', [
                    F::image('image', 'Portrait', 'muzaffar_khokhar_founder.png'),
                    F::text('alt', 'Image description', 'Muzaffar Khokhar'),
                    F::text('label', 'Small label', "Founder's Perspective"),
                    F::html('headline', 'Headline', 'A long-term view<br>of financial progress.'),
                    F::area('quote', 'Quote', 'Unitey was founded on the belief that the next generation of financial infrastructure should strengthen local economies while expanding access to the opportunities of a digital financial system. We believe payment sovereignty will play an increasingly important role in how markets develop - creating greater control, resilience, and independence across critical payment infrastructure while maintaining global connectivity. This perspective continues to shape Unitey\'s strategy and long-term direction.'),
                    F::text('name', 'Name', 'Muzaffar Khokhar'),
                    F::text('role', 'Role', 'Founder & Executive Chairman'),
                ]),
                F::section('cta', 'Closing invitation', 'The band before the footer.', [
                    F::image('image', 'Background photograph', 'https://images.unsplash.com/photo-1477959858617-67f85cf4f1df?auto=format&fit=crop&w=1900&q=80'),
                    F::html('headline', 'Headline', 'Discover the businesses <em>shaping Unitey\'s presence</em>'),
                    F::text('text', 'Supporting line', 'Across payments, technology, and digital services'),
                    F::text('button_label', 'Button label', 'Explore Our Portfolio'),
                    F::text('button_url', 'Button link', '/portfolio'),
                ]),
            ],
        ];
    }
}
