<?php

namespace Botble\Tenant\Http\Requests;

use Botble\Tenant\Enums\TenantStatusEnum;
use Botble\Tenant\Models\Tenant;
use Botble\Support\Http\Requests\Request;
use Illuminate\Database\Query\Builder;
use Illuminate\Validation\Rule;

class TenantRequest extends Request
{
    protected $errorBag = 'tenant';

    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'email',
            ],
            'ssn_number'=>['required']
        ];
    }
}
