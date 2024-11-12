<?php

use Botble\Base\Facades\AdminHelper;
use Botble\Theme\Facades\Theme;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Botble\Tenant\Http\Controllers'], function () {
    AdminHelper::registerRoutes(function () {
        Route::group(['prefix' => 'tenants', 'as' => 'tenant.'], function () {
            // Define the resource route directly without nesting
            Route::resource('', 'TenantController')->only(['index', 'create', 'store', 'edit', 'update', 'destroy'])->parameters(['' => 'tenant']);
        });

        Route::group(['prefix' => 'settings'], function () {
            Route::get('tenant', [
                'as' => 'tenant.settings',
                'uses' => 'Settings\TenantSettingController@edit',
            ]);

            Route::put('tenant', [
                'as' => 'tenant.settings.update',
                'uses' => 'Settings\TenantSettingController@update',
                'permission' => 'tenant.settings',
            ]);
        });
    });

    if (defined('THEME_MODULE_SCREEN_NAME')) {
        Theme::registerRoutes(function () {
            Route::post('tenant/subscribe', [
                'as' => 'public.tenant.subscribe',
                'uses' => 'PublicController@postSubscribe',
            ]);

            Route::get('tenant/unsubscribe/{user}', [
                'as' => 'public.tenant.unsubscribe',
                'uses' => 'PublicController@getUnsubscribe',
            ]);
        });
    }
});
