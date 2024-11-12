<?php

namespace Botble\Tenant\Enums;

use Botble\Base\Facades\BaseHelper;
use Botble\Base\Supports\Enum;
use Illuminate\Support\HtmlString;

/**
 * @method static TenantStatusEnum SUBSCRIBED()
 * @method static TenantStatusEnum UNSUBSCRIBED()
 */
class TenantStatusEnum extends Enum
{
    public const SUBSCRIBED = 'subscribed';

    public const UNSUBSCRIBED = 'unsubscribed';

    public static $langPath = 'plugins/tenant::tenant.statuses';

    public function toHtml(): HtmlString|string
    {
        $color = match ($this->value) {
            self::SUBSCRIBED => 'success',
            self::UNSUBSCRIBED => 'warning',
            default => 'primary',
        };

        return BaseHelper::renderBadge($this->label(), $color);
    }
}
