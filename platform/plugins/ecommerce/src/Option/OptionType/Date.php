<?php

namespace Botble\Ecommerce\Option\OptionType;

use Botble\Ecommerce\Option\Interfaces\OptionTypeInterface;

class Date extends BaseOptionType implements OptionTypeInterface
{
    public function view(): string
    {
        return 'date';
    }
}
