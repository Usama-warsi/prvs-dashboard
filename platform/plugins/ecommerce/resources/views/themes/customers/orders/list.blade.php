@extends(EcommerceHelper::viewPath('customers.master'))

@section('title', __('Orders'))

@section('content')
    @if($orders->isNotEmpty())
    <div class="container m-0 p-0 ">
    <div class="row py-3">
        <div class="col-md-6"><h2>Pending Payments: ${{ $sumAmount }}</h2></div>
        <div class="col-md-6 text-end"> @if($sumAmount > 0) <a href="{{route('public.cart.pay_later')}}" class="btn btn-primary">Pay Now</a> @endif</div>
    </div>    
    
    </div>
        <div class="table-responsive customer-list-order">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>{{ __('Order number') }}</th>
                    <th>{{ __('Created at') }}</th>
                    <th>{{ __('Total') }}</th>
                    <th>{{ __('Payment method') }}</th>
                    <th>{{ __('Status') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->code }}</td>
                        <td>{{ $order->created_at->format('d M Y H:i:s') }}</td>
                        <td>{{ __(':price for :total item(s)', ['price' => $order->amount_format, 'total' => $order->products_count]) }}</td>
                        <td>
                            @if(is_plugin_active('payment') && $order->payment->id && $order->payment->payment_channel->label())
                                {{ $order->payment->payment_channel->label() }}
                            @else
                                &mdash;
                            @endif
                        </td>

                        <td>{!! BaseHelper::clean($order->status->toHtml()) !!}</td>

                        <td>
                            <a
                                class="btn btn-primary btn-sm"
                                href="{{ route('customer.orders.view', $order->id) }}"
                            >{{ __('View') }}</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {!! $orders->links() !!}
        </div>
    @else
        @include(EcommerceHelper::viewPath('customers.partials.empty-state'), [
            'title' => __('No orders yet!'),
            'subtitle' => __('You have not placed any orders yet.'),
            'actionUrl' => route('public.products'),
            'actionLabel' => __('Start shopping now'),
        ])
    @endif
@stop
