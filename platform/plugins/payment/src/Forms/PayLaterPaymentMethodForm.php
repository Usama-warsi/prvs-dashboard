<?php

namespace Botble\Payment\Forms;

use Botble\Base\Forms\FieldOptions\EditorFieldOption;
use Botble\Base\Forms\FieldOptions\TextFieldOption;
use Botble\Base\Forms\Fields\EditorField;
use Botble\Base\Forms\Fields\HtmlField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Base\Forms\FormAbstract;
use Botble\Payment\Concerns\Forms\HasAvailableCountriesField;
use Botble\Payment\Enums\PaymentMethodEnum;

class PayLaterPaymentMethodForm extends FormAbstract
{
    use HasAvailableCountriesField;

    public function setup(): void
    {
        $this
            ->template('plugins/payment::forms.fields-only')
            ->add(
                'type',
                'hidden',
                TextFieldOption::make()
                    ->value(PaymentMethodEnum::PAY_LATER)
                    ->attributes(['class' => 'payment_type'])
            )
            ->add(
                get_payment_setting_key('name', PaymentMethodEnum::PAY_LATER),
                TextField::class,
                TextFieldOption::make()
                    ->label(trans('plugins/payment::payment.method_name'))
                    ->attributes(['data-counter' => 400])
                    ->value(get_payment_setting(
                        'name',
                        PaymentMethodEnum::PAY_LATER,
                        PaymentMethodEnum::PAY_LATER()->label(),
                    )),
            )
            ->add(
                get_payment_setting_key('description', PaymentMethodEnum::PAY_LATER),
                EditorField::class,
                EditorFieldOption::make()
                    ->wrapperAttributes(['style' => 'max-width: 99.8%'])
                    ->label(trans('plugins/payment::payment.payment_method_description'))
                    ->value(get_payment_setting('description', PaymentMethodEnum::PAY_LATER))
            )
            ->addAvailableCountriesField(PaymentMethodEnum::PAY_LATER)
            ->when(
                apply_filters(PAYMENT_METHOD_SETTINGS_CONTENT, null, PaymentMethodEnum::PAY_LATER),
                function (FormAbstract $form, ?string $data) {
                    $form->add('metabox', HtmlField::class, ['html' => $data]);
                }
            );
    }
}
