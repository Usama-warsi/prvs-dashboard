@extends(EcommerceHelper::viewPath('customers.master'))

@section('title', SeoHelper::getTitle())

@section('content')
    @if($orderProducts->isNotEmpty())
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>{{ __('Image') }}</th>
                    <th>{{ __('Product Name') }}</th>
                    <!-- <th>{{ __('Times downloaded') }}</th> -->
                    <th>{{ __('Ordered at') }}</th>
                    <th>{{ __('Report') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($orderProducts as $orderProduct)
                    @php
                        $product = get_products([
                            'condition' => [
                                'ec_products.id' => $orderProduct->product_id,
                            ],
                            'take'   => 1,
                            'select' => [
                                'ec_products.id',
                                'ec_products.images',
                                'ec_products.name',
                                'ec_products.price',
                                'ec_products.sale_price',
                                'ec_products.sale_type',
                                'ec_products.start_date',
                                'ec_products.end_date',
                                'ec_products.sku',
                                'ec_products.is_variation',
                                'ec_products.status',
                                'ec_products.order',
                                'ec_products.created_at',
                            ],
                        ]);
                    @endphp
                    <tr>
                        <td>
                            <img
                                src="{{ RvMedia::getImageUrl($orderProduct->product_image, 'thumb', false, RvMedia::getDefaultImage()) }}"
                                alt="{{ $orderProduct->product_name }}"
                                width="50"
                            >
                        </td>
                        <td>
                            @if($product && $product->original_product?->url)
                                <a href="{{ $product->original_product->url }}">{!! BaseHelper::clean($orderProduct->product_name) !!}</a>
                            @else
                                {!! BaseHelper::clean($orderProduct->product_name) !!}
                            @endif
                            @if ($sku = Arr::get($orderProduct->options, 'sku'))
                                ({{ $sku }})
                            @endif

                            @if ($attributes = Arr::get($orderProduct->options, 'attributes'))
                                <p class="mb-0">
                                    <small>{{ $attributes }}</small>
                                </p>
                            @elseif ($product && $product->is_variation)
                                <p>
                                    <small>
                                        @php $attributes = get_product_attributes($product->id) @endphp
                                        @if ($attributes->isNotEmpty())
                                            @foreach ($attributes as $attribute)
                                                {{ $attribute->attribute_set_title }}: {{ $attribute->title }}@if (!$loop->last), @endif
                                            @endforeach
                                        @endif
                                    </small>
                                </p>
                            @endif

                            @include(
                                EcommerceHelper::viewPath('includes.cart-item-options-extras'),
                                ['options' => $orderProduct->options]
                            )

                            @if (!empty($orderProduct->product_options) && is_array($orderProduct->product_options))
                                {!! render_product_options_html($orderProduct->product_options, $orderProduct->price) !!}
                            @endif

                            @if (is_plugin_active('marketplace') && ($product = $orderProduct->product) && $product->original_product->store->id)
                                <p class="d-block mb-0 sold-by">
                                    <small>{{ __('Sold by') }}: <a href="{{ $product->original_product->store->url }}" class="text-primary">{{ $product->original_product->store->name }}</a>
                                    </small>
                                </p>
                            @endif
                        </td>
                        <!-- <td class="text-center">
                            <span>{{ $orderProduct->times_downloaded }}</span>
                        </td> -->
                        <td>{{ $orderProduct->created_at->translatedFormat('M d, Y h:m') }}</td>
                        <td class="text-right text-end">
                        <a
                                    class="btn btn-primary mb-2"
                                    href="#" onclick='printreport("print-div-{{$orderProduct->id}}")'
                                    style="white-space: nowrap"
                                >
                                    <x-core::icon name="ti ti-file" class="me-1" />
                                    <span>{{ __('Print Report') }}</span>
                                </a>
                                <div id="print-div-{{$orderProduct->id}}" style="display:none">
                                    {!! $orderProduct->report_content !!}
                                </div>
                            <!-- @if ($orderProduct->product_file_internal_count)
                                <a
                                    class="btn btn-primary mb-2"
                                    href="{{ route('customer.downloads.product', $orderProduct->id) }}"
                                    style="white-space: nowrap"
                                >
                                    <x-core::icon name="ti ti-download" class="me-1" />
                                    <span>{{ __('Download all files') }}</span>
                                </a>
                            @endif
                            @if ($orderProduct->product_file_external_count)
                                <a
                                    class="btn btn-info mb-2"
                                    href="{{ route('customer.downloads.product', [$orderProduct->id, 'external' => true]) }}"
                                    style="white-space: nowrap"
                                >
                                    <x-core::icon name="ti ti-link" class="me-1" />
                                    <span>{{ __('External link downloads') }}</span>
                                </a>
                            @endif -->

                           
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        {!! $orderProducts->links() !!}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.js"></script>
        <script>
      function printreport(id) {
    // Get the content of the specified div based on the provided ID
    var printContents = document.getElementById(id).outerHTML;
    var originalContents = document.body.innerHTML;

    // Replace the body's content with the div's content for printing
    document.body.innerHTML = printContents;
    
    // Make the div visible for printing
    document.getElementById(id).style.display = 'block';
    // document.querySelector(id+' table').style.border = '0';
    // Print the page
    window.print();

    // Hide the div again after printing
    // document.getElementById(id).style.display = 'none';

    // Restore the original content of the document
    document.body.innerHTML = originalContents;
}


        </script>
    @else
        @include(EcommerceHelper::viewPath('customers.partials.empty-state'), [
            'title' => __('No Report Found!'),
            'subtitle' => __('You have not purchased any Report yet.'),
        ])
    @endif
@stop
