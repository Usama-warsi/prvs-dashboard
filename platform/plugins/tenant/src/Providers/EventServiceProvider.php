<?php

namespace Botble\Tenant\Providers;

use Botble\Tenant\Events\SubscribeTenantEvent;
use Botble\Tenant\Events\UnsubscribeTenantEvent;
use Botble\Tenant\Listeners\AddSubscriberToMailchimpContactListListener;
use Botble\Tenant\Listeners\AddSubscriberToSendGridContactListListener;
use Botble\Tenant\Listeners\RemoveSubscriberToMailchimpContactListListener;
use Botble\Tenant\Listeners\SendEmailNotificationAboutNewSubscriberListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        SubscribeTenantEvent::class => [
            SendEmailNotificationAboutNewSubscriberListener::class,
            AddSubscriberToMailchimpContactListListener::class,
            AddSubscriberToSendGridContactListListener::class,
        ],
        UnsubscribeTenantEvent::class => [
            RemoveSubscriberToMailchimpContactListListener::class,
        ],
    ];
}
