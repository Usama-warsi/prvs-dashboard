<?php

namespace Botble\Tenant\Listeners;

use Botble\Tenant\Events\UnsubscribeTenantEvent;
use Botble\Tenant\Facades\Tenant;
use Illuminate\Contracts\Queue\ShouldQueue;

class RemoveSubscriberToMailchimpContactListListener implements ShouldQueue
{
    public function handle(UnsubscribeTenantEvent $event): void
    {
        if (! setting('enable_tenant_contacts_list_api')) {
            return;
        }

        $mailchimpApiKey = setting('tenant_mailchimp_api_key');
        $mailchimpListId = setting('tenant_mailchimp_list_id');

        if (! $mailchimpApiKey || ! $mailchimpListId) {
            return;
        }

        Tenant::driver('mailchimp')->unsubscribe($event->tenant->email);
    }
}
