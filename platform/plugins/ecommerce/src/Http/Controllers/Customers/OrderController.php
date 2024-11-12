<?php

namespace Botble\Ecommerce\Http\Controllers\Customers;

use Botble\Ecommerce\Enums\OrderCancellationReasonEnum;
use Botble\Ecommerce\Enums\OrderHistoryActionEnum;
use Botble\Ecommerce\Facades\InvoiceHelper;
use Botble\Ecommerce\Facades\OrderHelper;
use Botble\Ecommerce\Forms\Fronts\CancelOrderForm;
use Botble\Ecommerce\Http\Controllers\BaseController;
use Botble\Ecommerce\Http\Requests\Fronts\CancelOrderRequest;
use Botble\Ecommerce\Models\Order;
use Botble\Ecommerce\Models\OrderProduct;
use Botble\Ecommerce\Models\OrderHistory;
use Botble\SeoHelper\Facades\SeoHelper;
use Botble\Theme\Facades\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Botble\Base\Supports\Pdf;
use Barryvdh\DomPDF\PDF as PDFHelper;
use Dompdf\Dompdf;
use Botble\Payment\Enums\PaymentStatusEnum;
use DB;

class OrderController extends BaseController
{
    public function __construct()
    {
        Theme::asset()
            ->add('customer-style', 'vendor/core/plugins/ecommerce/css/customer.css', ['bootstrap-css']);
        Theme::asset()
            ->add('front-ecommerce-css', 'vendor/core/plugins/ecommerce/css/front-ecommerce.css', version: get_cms_version());
    }

    public function index()
    {
        SeoHelper::setTitle(__('Orders'));

        $sumAmount = DB::table('payments')
            ->where('customer_id',  auth('customer')->id())
            ->where('status', PaymentStatusEnum::PAY_LATER)
            ->sum('amount');
        $orders = Order::query()
            ->where([
                'user_id' => auth('customer')->id(),
                'is_finished' => 1,
            ])
            ->withCount(['products'])
            ->orderByDesc('created_at')
            ->paginate(10);

        Theme::breadcrumb()
            ->add(__('Orders'), route('customer.orders'));

        return Theme::scope(
            'ecommerce.customers.orders.list',
            compact('orders','sumAmount'),
            'plugins/ecommerce::themes.customers.orders.list'
        )->render();
    }

    public function show(int|string $id)
    {
        $order = Order::query()
            ->where([
                'id' => $id,
                'user_id' => auth('customer')->id(),
            ])
            ->with(['address', 'products'])
            ->firstOrFail();

        $cancelOrderForm = CancelOrderForm::createFromModel($order);

        SeoHelper::setTitle(__('Order detail :id', ['id' => $order->code]));

        Theme::breadcrumb()
            ->add(
                __('Order detail :id', ['id' => $order->code]),
                route('customer.orders.view', $id)
            );

        return Theme::scope(
            'ecommerce.customers.orders.view',
            compact('order', 'cancelOrderForm'),
            'plugins/ecommerce::themes.customers.orders.view'
        )->render();
    }

    public function destroy(int|string $id, CancelOrderRequest $request)
    {
        return $this->handleCancelOrder($id, $request->input('cancellation_reason'), $request->input('cancellation_reason_description'));
    }

    public function print(int|string $id, Request $request)
    {
        /**
         * @var Order $order
         */
        $order = Order::query()
            ->where([
                'id' => $id,
                'user_id' => auth('customer')->id(),
            ])
            ->firstOrFail();

        if (! $order->isInvoiceAvailable()) {
            abort(404);
        }

        if ($request->input('type') == 'print') {
            return InvoiceHelper::streamInvoice($order->invoice);
        }

        return InvoiceHelper::downloadInvoice($order->invoice);
    }

    
    
    public function print_report(int|string $id, Request $request)
    {
        // Fetch the order by ID or fail if not found
        $order = OrderProduct::query()
            ->where([
                'id' => $id,
                // 'user_id' => auth('customer')->id(),
            ])
            ->firstOrFail();
    
        // Assuming 'report_content' is the HTML content for the PDF
        $data = $order->report_content;
// echo $data;

$dompdf = new Dompdf();
$dompdf->loadHtml(view('plugins/ecommerce::orders.report_generate', compact('data'))->render());
$dompdf->render();
print_r($dompdf); exit();
return $dompdf->stream('filename.pdf');

        // file_put_contents('test.html', view('plugins/ecommerce::orders.report_generate', compact('data'))->render());

        // return InvoiceHelper::downloadreport($html);
    }

    // public function getreportTemplatePath($html): string
    // {
    //     // Define the path to the template file
    //     $templatePath = plugin_path('ecommerce/resources/templates/report_request.tpl');

    //     // Write the HTML content to the template file
    //     file_put_contents($templatePath, $html);

    //     // Return the path to the file
    //     return $templatePath;
    // }

    


    public function getCancelOrder(int|string $id)
    {
        return $this->handleCancelOrder($id);
    }

    public function confirmDelivery(int|string $id)
    {
        /** @var Order $order */
        $order = Order::query()
            ->where('user_id', auth('customer')->id())
            ->findOrFail($id);

        if (! $order->shipment->can_confirm_delivery) {
            return $this
                ->httpResponse()
                ->setError()
                ->setMessage(__('plugins/ecommerce::order.confirm_delivery_error'));
        }

        $order->shipment()->update([
            'customer_delivered_confirmed_at' => Carbon::now(),
        ]);

        OrderHistory::query()->create([
            'action' => OrderHistoryActionEnum::CONFIRM_DELIVERY,
            'description' => __('Order was confirmed delivery by customer :customer', ['customer' => $order->address->name ?: $order->user->name]),
            'order_id' => $order->getKey(),
        ]);

        return $this
            ->httpResponse()
            ->setMessage(__('plugins/ecommerce::order.confirm_delivery_success'));
    }

    protected function handleCancelOrder(int|string $id, ?string $reason = null, ?string $reasonDescription = null)
    {
        /** @var Order $order */
        $order = Order::query()
            ->where([
                'id' => $id,
                'user_id' => auth('customer')->id(),
            ])
            ->with(['address', 'products'])
            ->firstOrFail();

        if (! $order->canBeCanceled()) {
            return $this
                ->httpResponse()
                ->setError()
                ->setMessage(trans('plugins/ecommerce::order.cancel_error'));
        }

        OrderHelper::cancelOrder($order, $reason, $reasonDescription);

        $customerName = $order->address->name ?: $order->user->name;

        $description = match (true) {
            $reason != OrderCancellationReasonEnum::OTHER => __('Order was cancelled by customer :customer with reason :reason', [
                'customer' => $customerName,
                'reason' => OrderCancellationReasonEnum::getLabel($reason),
            ]),
            $reason == OrderCancellationReasonEnum::OTHER => __('Order was cancelled by customer :customer with reason :reason', [
                'customer' => $customerName,
                'reason' => $reasonDescription,
            ]),
            default => __('Order was cancelled by customer :customer', ['customer' => $customerName]),
        };

        OrderHistory::query()->create([
            'action' => OrderHistoryActionEnum::CANCEL_ORDER,
            'description' => $description,
            'order_id' => $order->getKey(),
        ]);

        return $this
            ->httpResponse()
            ->setMessage(trans('plugins/ecommerce::order.cancel_success'));
    }


    
}
