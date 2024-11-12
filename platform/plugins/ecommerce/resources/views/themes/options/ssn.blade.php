<div
    class="form-group mb-3 option-field product-option-{{ Str::slug($option->name) }} product-option-{{ $option->id }}"
    style="margin-bottom: 10px"
>
    <div class="product-option-item-wrapper">
        <div class="product-option-item-values">
            <div class="form-radio">
                @foreach ($option->values as $value)
                    @php
                        $price = 0;
                        if (!empty($value->affect_price) && doubleval($value->affect_price) > 0) {
                            $price = $value->affect_type == 0 ? $value->affect_price : (floatval($value->affect_price) * $product->price()->getPrice()) / 100;
                        }
                    @endphp
                    <div class="product-option-item-label">
                        <label class="form-label {{ $option->required ? 'required' : '' }}">
                            {{ $option->name }}
                            @if ($price > 0)
                                (<span class="extra-price">+ {{ format_price($price) }}</span>)
                            @endif
                        </label>
                    </div>
                    <input
                        name="options[{{ $option->id }}][option_type]"
                        type="hidden"
                        value="field"
                    />
                    <input
                        name="ssn_number"
                        id="ssn_number"
                        type="hidden"
                        value=""
                    />
                    <input
                        class="form-control" onkeyup="updateSSN()"
                        id="ssn_numb"
                        name="options[{{ $option->id }}][values]"
                        data-extra-price="0"
                        type="number"
                        {{ $option->required ? 'required' : '' }}
                    >
                @endforeach
            </div>

            <script>
                function updateSSN() {
    const ssnValue = document.getElementById("ssn_numb").value;
    document.getElementById("ssn_number").value = ssnValue;
}
            </script>
        </div>
    </div>
</div>
