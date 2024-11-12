<?php

namespace Botble\Tenant\Models;

use Botble\Base\Casts\SafeContent;
use Botble\Base\Models\BaseModel;
use Botble\Tenant\Enums\TenantStatusEnum;

class Tenant extends BaseModel
{
    protected $table = 'tenants';

    protected $fillable = [
        'email',
        'ssn_number',
        'name',
        'phone',
        'dob'
    ];

    protected $casts = [
        'name' => SafeContent::class,
    ];
}
