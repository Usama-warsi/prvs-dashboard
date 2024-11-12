<section class="section-padding-60">
    <div class="container wow fadeIn animated">
        @if ($title)
            <h3 class="section-title style-1 mb-30">{!! BaseHelper::clean($title) !!}</h3>
        @endif
<div class="container">
    <div class="row">
    @foreach ($products as $product)
    <div class="col-md-3">
                    <div class="product-cart-wrap small hover-up p-10">
                        @include(Theme::getThemeNamespace() . '::views.ecommerce.includes.product-item', compact('product'))
                    </div></div>
                @endforeach
    </div>
</div>
    </div>
</section>
