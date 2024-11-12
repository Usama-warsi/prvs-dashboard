<?php

return [
    'name' => 'Tenants',
    'tenant_form' => 'Tenants form',
    'description' => 'View and delete tenant subscribers',
    'settings' => [
        'email' => [
            'templates' => [
                'title' => 'Tenant',
                'description' => 'Config tenant email templates',
                'to_admin' => [
                    'title' => 'Email send to admin',
                    'description' => 'Template for sending email to admin',
                    'subject' => 'New user subscribed your tenant',
                    'tenant_email' => 'Email of user who subscribe tenant',
                ],
                'to_user' => [
                    'title' => 'Email send to user',
                    'description' => 'Template for sending email to subscriber',
                    'subject' => '{{ site_title }}: Subscription Confirmed!',
                    'tenant_name' => 'Full name of user who subscribe tenant',
                    'tenant_email' => 'Email of user who subscribe tenant',
                    'tenant_unsubscribe_link' => 'Link for unsubscribe tenant',
                    'tenant_unsubscribe_url' => 'URL for unsubscribe tenant',
                ],
            ],
        ],
        'title' => 'Tenant',
        'panel_description' => 'View and update tenant settings',
        'description' => 'Settings for tenant (auto send tenant email to SendGrid, Mailchimp... when someone register tenant on website).',
        'mailchimp_api_key' => 'Mailchimp API Key',
        'mailchimp_list_id' => 'Mailchimp List ID',
        'mailchimp_list' => 'Mailchimp List',
        'sendgrid_api_key' => 'Sendgrid API Key',
        'sendgrid_list_id' => 'Sendgrid List ID',
        'sendgrid_list' => 'Sendgrid List',
        'enable_tenant_contacts_list_api' => 'Enable tenant contacts list API?',
    ],
    'statuses' => [
        'subscribed' => 'Subscribed',
        'unsubscribed' => 'Unsubscribed',
    ],
];
