@if(auth('customer')->check() && Session::Get('pay_later') != true)
<x-plugins-payment::payment-method
    :name="\Botble\Payment\Enums\PaymentMethodEnum::PAY_LATER"
    :label="get_payment_setting('name', 'pay_later', trans('plugins/payment::payment.payment_via_pay_later'))"
/>

@endif
