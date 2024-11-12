<?php

namespace Botble\Tenant\Listeners;

use Botble\Tenant\Events\SubscribeTenantEvent;
use Botble\Tenant\Facades\Tenant;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Arr;

class AddSubscriberToSendGridContactListListener implements ShouldQueue
{
    public function handle(SubscribeTenantEvent $event): void
    {
        if (! setting('enable_tenant_contacts_list_api')) {
            return;
        }

        $sendgridApiKey = setting('tenant_sendgrid_api_key');
        $sendgridListId = setting('tenant_sendgrid_list_id');

        if (! $sendgridApiKey || ! $sendgridListId) {
            return;
        }

        $name = explode(' ', $event->tenant->name);

        Tenant::driver('sendgrid')->subscribe(
            $event->tenant->email,
            ['first_name' => Arr::first($name), 'last_name' => Arr::get($name, '1', Arr::first($name))]
        );
    }
}
