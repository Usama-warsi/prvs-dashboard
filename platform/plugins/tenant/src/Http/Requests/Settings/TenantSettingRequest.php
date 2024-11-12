<?php

namespace Botble\Tenant\Http\Requests\Settings;

use Botble\Base\Rules\OnOffRule;
use Botble\Support\Http\Requests\Request;

class TenantSettingRequest extends Request
{
    public function rules(): array
    {
        return [
            'enable_tenant_contacts_list_api' => [new OnOffRule()],
            'tenant_mailchimp_api_key' => ['nullable', 'string', 'min:32', 'max:40'],
            'tenant_mailchimp_list_id' => ['nullable', 'string', 'size:10'],
            'tenant_sendgrid_api_key' => ['nullable', 'string', 'min:32', 'max:255'],
            'tenant_sendgrid_list_id' => ['nullable', 'string', 'min:10', 'max:255'],
        ];
    }
}
