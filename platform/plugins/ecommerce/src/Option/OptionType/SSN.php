<?php

namespace Botble\Ecommerce\Option\OptionType;

use Botble\Ecommerce\Option\Interfaces\OptionTypeInterface;

class SSN extends BaseOptionType implements OptionTypeInterface
{
    public function view(): string
    {
        return 'ssn';
    }
}
