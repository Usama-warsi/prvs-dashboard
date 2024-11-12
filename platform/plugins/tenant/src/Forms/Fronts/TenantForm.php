<?php

namespace Botble\Tenant\Forms\Fronts;

use Botble\Base\Forms\FieldOptions\ButtonFieldOption;
use Botble\Base\Forms\FieldOptions\EmailFieldOption;
use Botble\Base\Forms\FieldOptions\HtmlFieldOption;
use Botble\Base\Forms\Fields\EmailField;
use Botble\Base\Forms\Fields\HtmlField;
use Botble\Tenant\Http\Requests\TenantRequest;
use Botble\Tenant\Models\Tenant;
use Botble\Theme\FormFront;

class TenantForm extends FormFront
{
    protected string $errorBag = 'tenant';

    public static function formTitle(): string
    {
        return trans('plugins/tenant::tenant.tenant_form');
    }

    public function setup(): void
    {
        $this
            ->contentOnly()
            ->setUrl(route('public.tenant.subscribe'))
            ->setFormOption('class', 'subscribe-form')
            ->setValidatorClass(TenantRequest::class)
            ->model(Tenant::class)
            ->add('wrapper_before', HtmlField::class, HtmlFieldOption::make()->content('<div class="input-group mb-3">'))
            ->add(
                'email',
                EmailField::class,
                EmailFieldOption::make()
                    ->label(false)
                    ->required()
                    ->cssClass('')
                    ->wrapperAttributes(false)
                    ->maxLength(-1)
                    ->placeholder(__('Enter Your Email'))
                    ->addAttribute('id', 'tenant-email')
            )
            ->add(
                'submit',
                'submit',
                ButtonFieldOption::make()
                    ->label(__('Subscribe'))
                    ->cssClass('btn btn-primary'),
            )
            ->add('wrapper_after', HtmlField::class, HtmlFieldOption::make()->content('</div>'))
            ->add(
                'messages',
                HtmlField::class,
                HtmlFieldOption::make()
                    ->content(<<<'HTML'
                        <div class="tenant-message tenant-success-message" style="display: none"></div>
                        <div class="tenant-message tenant-error-message" style="display: none"></div>
                    HTML)
            );
    }
}
