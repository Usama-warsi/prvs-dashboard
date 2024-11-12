<?php

namespace Botble\Tenant;

use Botble\PluginManagement\Abstracts\PluginOperationAbstract;
use Botble\Setting\Facades\Setting;
use Illuminate\Support\Facades\Schema;

class Plugin extends PluginOperationAbstract
{
    public static function remove(): void
    {
        Schema::dropIfExists('tenants');

        Setting::delete([
            'tenant_mailchimp_api_key',
            'tenant_mailchimp_list_id',
            'tenant_sendgrid_api_key',
            'tenant_sendgrid_list_id',
            'enable_tenant_contacts_list_api',
        ]);
    }
}
