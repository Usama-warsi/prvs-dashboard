<?php

namespace Botble\Tenant\Listeners;

use Botble\Base\Facades\EmailHandler;
use Botble\Base\Facades\Html;
use Botble\Tenant\Events\SubscribeTenantEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\URL;

class SendEmailNotificationAboutNewSubscriberListener implements ShouldQueue
{
    public function handle(SubscribeTenantEvent $event): void
    {
        $unsubscribeUrl = URL::signedRoute('public.tenant.unsubscribe', ['user' => $event->tenant->id]);

        $mailer = EmailHandler::setModule(NEWSLETTER_MODULE_SCREEN_NAME)->setVariableValues([
            'tenant_name' => $event->tenant->name ?? 'N/A',
            'tenant_email' => $event->tenant->email,
            'tenant_unsubscribe_link' => Html::link($unsubscribeUrl, __('here'))->toHtml(),
            'tenant_unsubscribe_url' => $unsubscribeUrl,
        ]);

        $mailer->sendUsingTemplate('subscriber_email', $event->tenant->email);

        $mailer->sendUsingTemplate('admin_email');
    }
}
