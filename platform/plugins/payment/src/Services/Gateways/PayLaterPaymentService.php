<?php

namespace Botble\Payment\Services\Gateways;

use Botble\Payment\Enums\PaymentMethodEnum;
use Botble\Payment\Enums\PaymentStatusEnum;
use Illuminate\Support\Str;

class PayLaterPaymentService
{
    public function execute(array $data): string
    {
        $chargeId = Str::upper(Str::random(10));

        $orderIds = $data['order_id'];

        do_action(PAYMENT_ACTION_PAYMENT_PROCESSED, [
            'amount' => $data['amount'],
            'currency' => $data['currency'],
            'charge_id' => $chargeId,
            'order_id' => $orderIds,
            'customer_id' => $data['customer_id'],
            'customer_type' => $data['customer_type'],
            'payment_channel' => PaymentMethodEnum::PAY_LATER,
            'status' => PaymentStatusEnum::PAY_LATER,
        ]);

        return $chargeId;
    }
}
