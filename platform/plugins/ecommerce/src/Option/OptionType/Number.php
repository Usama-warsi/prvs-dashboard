<?php

namespace Botble\Ecommerce\Option\OptionType;

use Botble\Ecommerce\Option\Interfaces\OptionTypeInterface;

class Number extends BaseOptionType implements OptionTypeInterface
{
    public function view(): string
    {
        return 'number';
    }
}
