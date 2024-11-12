<?php

namespace Botble\Ecommerce\Enums;

use Botble\Base\Supports\Enum;
use Botble\Ecommerce\Option\OptionType\Checkbox;
use Botble\Ecommerce\Option\OptionType\Dropdown;
use Botble\Ecommerce\Option\OptionType\Field;
use Botble\Ecommerce\Option\OptionType\RadioButton;
use Botble\Ecommerce\Option\OptionType\SSN;
use Botble\Ecommerce\Option\OptionType\Date;
use Botble\Ecommerce\Option\OptionType\Number;
class GlobalOptionEnum extends Enum
{
    public const NA = 'N/A';
    public const FIELD = Field::class;
    public const TYPE_PERCENT = 1;

    public static function options(): array
    {
        return [
            'N/A' => trans('plugins/ecommerce::product-option.please_select_option'),
            'Text' => [
                Field::class => 'Field',
                SSN::class => 'SSN',
                Date::class => 'Date',
                Number::class => 'Number',
            ],
            'Select' => [
                Dropdown::class => 'Dropdown',
                Checkbox::class => 'Checkbox',
                RadioButton::class => 'RadioButton',
            ],
           
        ];
    }
}
