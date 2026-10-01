<?php

namespace App\Cms\Pages;

use App\Cms\F;

class ContactPage
{
    public static function definition(): array
    {
        return [
            'slug' => 'contact',
            'name' => 'Contact',
            'summary' => 'The contact page, office details, and the inquiry form.',
            'sections' => [
                F::section('seo', 'Browser title', 'The name shown on the browser tab.', [
                    F::text('title', 'Page title', 'Contact  Unitey'),
                ]),
                F::section('hero', 'Opening screen', 'The photograph and headline.', [
                    F::image('image', 'Background photograph', 'https://images.unsplash.com/photo-1486325212027-8081e485255e?auto=format&fit=crop&w=1800&q=70'),
                    F::text('headline', 'Headline', 'Connect with Unitey'),
                    F::area('text', 'Supporting line', 'If you are interested in learning more about Unitey or any of its operating companies, reach out to us'),
                ]),
                F::section('partnership', 'Partnership band', 'The section above the form.', [
                    F::text('title', 'Title', 'Partnership Opportunities'),
                    F::area('text', 'Text', 'Interested in partnering with Unitey? Whether you are a fintech startup, financial institution, or technology provider, our Partnerships team would be happy to discuss potential collaborations.'),
                    F::text('button_label', 'Button label', 'Contact Us'),
                    F::text('button_url', 'Button link', '#contact-form'),
                    F::image('image', 'Photograph', 'unitey-background.png'),
                    F::text('alt', 'Image description', 'Unitey'),
                ]),
                F::section('form', 'Inquiry form', 'The form and the reasons someone might write.', [
                    F::text('eyebrow', 'Small label', 'Reach Out'),
                    F::text('headline', 'Headline', 'Get In Touch'),
                    F::area('text', 'Introduction', "Use the form for general inquiries, proposals, or media requests. We'll route your message to the right team and reply promptly."),
                    F::text('phone_label', 'Phone label', 'Phone'),
                    F::text('phone', 'Phone', '+971 4 123 4567'),
                    F::text('email_label', 'Email label', 'Email'),
                    F::text('email', 'Email', 'info@unitey.com'),
                    F::text('name_label', 'Name field', 'Full Name'),
                    F::text('name_placeholder', 'Name placeholder', 'Your name'),
                    F::text('email_field', 'Email field', 'Email Address'),
                    F::text('email_placeholder', 'Email placeholder', 'your@email.com'),
                    F::text('business_label', 'Business field', 'Business'),
                    F::text('business_placeholder', 'Business placeholder', 'Business name'),
                    F::text('phone_field', 'Phone field', 'Phone Number'),
                    F::text('phone_placeholder', 'Phone placeholder', '+1 234 567 8900'),
                    F::text('message_label', 'Message field', 'Message'),
                    F::text('message_placeholder', 'Message placeholder', 'How can we help?'),
                    F::text('button_label', 'Submit button', 'Submit'),
                ], [
                    F::group('types', 'Inquiry reasons', 'Reason', [
                        F::text('key', 'Key', '', 'A short word with no spaces, used internally. For example partner.'),
                        F::text('title', 'Title'),
                        F::text('subtitle', 'Subtitle'),
                    ], [
                        ['key' => 'partner', 'title' => 'Partner Opportunities', 'subtitle' => 'Explore collaboration possibilities'],
                        ['key' => 'investor', 'title' => 'Investor Inquiries', 'subtitle' => 'Investment and financial information'],
                        ['key' => 'media', 'title' => 'Media Requests', 'subtitle' => 'Press and media inquiries'],
                        ['key' => 'general', 'title' => 'General Inquiry', 'subtitle' => 'Other questions and feedback'],
                    ]),
                ]),
                F::section('location', 'Office', 'The map and the address.', [
                    F::text('eyebrow', 'Small label', 'Regional Network'),
                    F::text('headline', 'Headline', 'Regional Office Locations'),
                    F::area('text', 'Text', "Unitey's headquarters is in Dubai, UAE, at the heart of the Dubai International Financial Centre, placing us at the crossroads of global finance and innovation, with an expanding presence beyond."),
                    F::area('map', 'Map embed address', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3609.9!2d55.2745!3d25.2048!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f43496ad9c645%3A0xbf946e98c0fd7813!2sDIFC%2C%20Dubai!5e0!3m2!1sen!2sae!4v1', 'Paste the Google Maps embed address.'),
                    F::text('address_label', 'Address label', 'Address'),
                    F::text('address', 'Address', 'Gate Avenue, South Zone, DIFC, Dubai, UAE'),
                    F::text('email_label', 'Email label', 'Email'),
                    F::text('email', 'Email', 'info@unitey.com'),
                ]),
            ],
        ];
    }
}
