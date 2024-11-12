<?php

return [
    'name' => 'plugins/tenant::tenant.settings.email.templates.title',
    'description' => 'plugins/tenant::tenant.settings.email.templates.description',
    'templates' => [
        'subscriber_email' => [
            'title' => 'plugins/tenant::tenant.settings.email.templates.to_user.title',
            'description' => 'plugins/tenant::tenant.settings.email.templates.to_user.description',
            'subject' => 'plugins/tenant::tenant.settings.email.templates.to_user.subject',
            'can_off' => true,
            'variables' => [
                'tenant_name' => 'plugins/tenant::tenant.settings.email.templates.to_user.tenant_name',
                'tenant_email' => 'plugins/tenant::tenant.settings.email.templates.to_user.tenant_email',
                'tenant_unsubscribe_link' => 'plugins/tenant::tenant.settings.email.templates.to_user.tenant_unsubscribe_link',
                'tenant_unsubscribe_url' => 'plugins/tenant::tenant.settings.email.templates.to_user.tenant_unsubscribe_url',
            ],
        ],
        'admin_email' => [
            'title' => 'plugins/tenant::tenant.settings.email.templates.to_admin.title',
            'description' => 'plugins/tenant::tenant.settings.email.templates.to_admin.description',
            'subject' => 'plugins/tenant::tenant.settings.email.templates.to_admin.subject',
            'can_off' => true,
            'variables' => [
                'tenant_email' => 'plugins/tenant::tenant.settings.email.templates.to_admin.tenant_email',
            ],
        ],
    ],
    'variables' => [],
];
