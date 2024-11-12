<?php

namespace Botble\Tenant\Http\Controllers\Settings;

use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Tenant\Forms\TenantSettingForm;
use Botble\Tenant\Http\Requests\Settings\TenantSettingRequest;
use Botble\Setting\Http\Controllers\SettingController;

class TenantSettingController extends SettingController
{
    public function edit()
    {
        $this->pageTitle(trans('plugins/tenant::tenant.settings.title'));

    }

    public function update(TenantSettingRequest $request): BaseHttpResponse
    {
      
    }
}
