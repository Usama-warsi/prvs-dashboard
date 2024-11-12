<?php

namespace Botble\Tenant\Facades;

use Botble\Tenant\Contracts\Factory;
use Illuminate\Support\Facades\Facade;

/**
 * @method static string getDefaultDriver()
 * @method static void registerTenantPopup(bool $keepHtmlDomOnClose = false)
 * @method static mixed driver(string|null $driver = null)
 * @method static \Botble\Tenant\TenantManager extend(string $driver, \Closure $callback)
 * @method static array getDrivers()
 * @method static \Illuminate\Contracts\Container\Container getContainer()
 * @method static \Botble\Tenant\TenantManager setContainer(\Illuminate\Contracts\Container\Container $container)
 * @method static \Botble\Tenant\TenantManager forgetDrivers()
 *
 * @see \Botble\Tenant\TenantManager
 */
class Tenant extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return Factory::class;
    }
}
