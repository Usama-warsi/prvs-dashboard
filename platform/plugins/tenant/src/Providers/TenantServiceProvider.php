<?php

namespace Botble\Tenant\Providers;

use Botble\Base\Facades\DashboardMenu;
use Botble\Base\Facades\EmailHandler;
use Botble\Base\Facades\PanelSectionManager;
use Botble\Base\PanelSections\PanelSectionItem;
use Botble\Base\Supports\DashboardMenuItem;
use Botble\Base\Supports\ServiceProvider;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Botble\Tenant\Contracts\Factory;
use Botble\Tenant\Forms\Fronts\TenantForm;
use Botble\Tenant\Http\Requests\TenantRequest;
use Botble\Tenant\Models\Tenant;
use Botble\Tenant\TenantManager;
use Botble\Tenant\Repositories\Eloquent\TenantRepository;
use Botble\Tenant\Repositories\Interfaces\TenantInterface;
use Botble\Setting\PanelSections\SettingOthersPanelSection;
use Botble\Theme\FormFrontManager;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Routing\Events\RouteMatched;

class TenantServiceProvider extends ServiceProvider implements DeferrableProvider
{
    use LoadAndPublishDataTrait;

    public function register(): void
    {
        $this->app->singleton(TenantInterface::class, function () {
            return new TenantRepository(new Tenant());
        });

        $this->app->singleton(Factory::class, function ($app) {
            return new TenantManager($app);
        });
    }

    public function boot(): void
    {
        $this
            ->setNamespace('plugins/tenant')
            ->loadHelpers()
            ->loadAndPublishConfigurations(['permissions', 'email'])
            ->loadAndPublishTranslations()
            ->loadRoutes()
            ->publishAssets()
            ->loadAndPublishViews()
            ->loadMigrations();

        $this->app->register(EventServiceProvider::class);

        DashboardMenu::default()->beforeRetrieving(function () {
            DashboardMenu::make()
                ->registerItem(
                    DashboardMenuItem::make()
                        ->id('cms-plugins-tenant')
                        ->priority(430)
                        ->name('plugins/tenant::tenant.name')
                        ->icon('ti ti-user')
                        ->route('tenant.index')
                );
        });

        PanelSectionManager::default()->beforeRendering(function () {
            PanelSectionManager::registerItem(
                SettingOthersPanelSection::class,
                fn () => PanelSectionItem::make('tenant')
                    ->setTitle(trans('plugins/tenant::tenant.settings.title'))
                    ->withIcon('ti ti-mail-cog')
                    ->withDescription(trans('plugins/tenant::tenant.settings.panel_description'))
                    ->withPriority(140)
                    ->withRoute('tenant.settings')
            );
        });

        $this->app['events']->listen(RouteMatched::class, function () {
            EmailHandler::addTemplateSettings(NEWSLETTER_MODULE_SCREEN_NAME, config('plugins.tenant.email', []));
        });

        FormFrontManager::register(TenantForm::class, TenantRequest::class);
    }

    public function provides(): array
    {
        return [Factory::class];
    }
}
