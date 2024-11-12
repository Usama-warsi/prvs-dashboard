<?php

namespace Botble\Tenant\Http\Controllers;

use Botble\Base\Facades\BaseHelper;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Tenant\Enums\TenantStatusEnum;
use Botble\Tenant\Events\SubscribeTenantEvent;
use Botble\Tenant\Events\UnsubscribeTenantEvent;
use Botble\Tenant\Forms\Fronts\TenantForm;
use Botble\Tenant\Http\Requests\TenantRequest;
use Botble\Tenant\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class PublicController extends BaseController
{
    public function postSubscribe(TenantRequest $request)
    {
        do_action('form_extra_fields_validate', $request, TenantForm::class);

        $tenantForm = TenantForm::create();
        $tenantForm->setRequest($request);

        $tenantForm->onlyValidatedData()->saving(function (TenantForm $form) {
            /**
             * @var TenantRequest $request
             */
            $request = $form->getRequest();

            /**
             * @var Tenant $tenant
             */
            $tenant = $form->getModel()->newQuery()->firstOrNew([
                'email' => $request->input('email'),
            ], [
                ...$form->getRequestData(),
                'status' => TenantStatusEnum::SUBSCRIBED,
            ]);

            $tenant->save();

            SubscribeTenantEvent::dispatch($tenant);
        });

        return $this
            ->httpResponse()
            ->setMessage(__('Subscribe to tenant successfully!'));
    }

    public function getUnsubscribe(int|string $id, Request $request)
    {
        if (! URL::hasValidSignature($request)) {
            abort(404);
        }

        /**
         * @var Tenant $tenant
         */
        $tenant = Tenant::query()
            ->where([
                'id' => $id,
                'status' => TenantStatusEnum::SUBSCRIBED,
            ])
            ->first();

        if ($tenant) {
            $tenant->update(['status' => TenantStatusEnum::UNSUBSCRIBED]);

            UnsubscribeTenantEvent::dispatch($tenant);

            return $this
                ->httpResponse()
                ->setNextUrl(BaseHelper::getHomepageUrl())
                ->setMessage(__('Unsubscribe to tenant successfully'));
        }

        return $this
            ->httpResponse()
            ->setError()
            ->setNextUrl(BaseHelper::getHomepageUrl())
            ->setMessage(__('Your email does not exist in the system or you have unsubscribed already!'));
    }
}
