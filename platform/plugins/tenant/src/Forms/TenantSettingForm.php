<?php

namespace Botble\Tenant\Forms;

use Botble\Base\Facades\BaseHelper;
use Botble\Tenant\Facades\Tenant as TenantFacade;
use Botble\Tenant\Http\Requests\Settings\TenantSettingRequest;
use Botble\Setting\Forms\SettingForm;
use Exception;
use Illuminate\Support\Arr;

class TenantSettingForm extends SettingForm
{
    public function setup(): void
    {
        parent::setup();

        $mailchimpContactList = [];

        if (setting('tenant_mailchimp_api_key')) {
            try {
                $contacts = collect(TenantFacade::driver('mailchimp')->contacts());

                if (! setting('tenant_mailchimp_list_id')) {
                    setting()->set(['tenant_mailchimp_list_id' => Arr::get($contacts, 'id')])->save();
                }

                $mailchimpContactList = $contacts->pluck('name', 'id')->all();
            } catch (Exception $exception) {
                BaseHelper::logError($exception);
            }
        }

        $sendGridContactList = [];

        if (setting('tenant_sendgrid_api_key')) {
            try {
                $contacts = collect(TenantFacade::driver('sendgrid')->contacts());

                if (! setting('tenant_sendgrid_list_id')) {
                    setting()->set(['tenant_sendgrid_list_id' => Arr::get($contacts->first(), 'id')])->save();
                }

                $sendGridContactList = $contacts->pluck('name', 'id')->all();
            } catch (Exception $exception) {
                BaseHelper::logError($exception);
            }
        }

        $this
            ->setSectionTitle(trans('plugins/tenant::tenant.settings.title'))
            ->setSectionDescription(trans('plugins/tenant::tenant.settings.description'))
            ->setValidatorClass(TenantSettingRequest::class)
            ->add('tenant_contacts_list_api_fields', 'html', [
                'html' => view('plugins/tenant::partials.tenant-contacts-list-api-fields', compact('mailchimpContactList', 'sendGridContactList')),
                'wrapper' => [
                    'class' => 'mb-0',
                ],
            ]);
    }
}
