<?php

namespace Botble\Tenant\Forms;

use Botble\Base\Forms\FieldOptions\ContentFieldOption;
use Botble\Base\Forms\FieldOptions\DescriptionFieldOption;
use Botble\Base\Forms\FieldOptions\IsFeaturedFieldOption;
use Botble\Base\Forms\FieldOptions\MediaImageFieldOption;
use Botble\Base\Forms\FieldOptions\NameFieldOption;
use Botble\Base\Forms\FieldOptions\RadioFieldOption;
use Botble\Base\Forms\FieldOptions\SelectFieldOption;
use Botble\Base\Forms\FieldOptions\StatusFieldOption;
use Botble\Base\Forms\FieldOptions\TagFieldOption;
use Botble\Base\Forms\Fields\EditorField;
use Botble\Base\Forms\Fields\MediaImageField;
use Botble\Base\Forms\Fields\OnOffField;
use Botble\Base\Forms\Fields\RadioField;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\Fields\TagField;
use Botble\Base\Forms\Fields\TextareaField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Base\Forms\FormAbstract;
use Botble\Tenant\Http\Requests\TenantRequest;
use Botble\Tenant\Models\Tenant;
use Botble\Base\Forms\FieldOptions\EmailFieldOption;
use Botble\Base\Forms\FieldOptions\TextFieldOption;
use Botble\Base\Forms\FieldOptions\DatePickerFieldOption;
use Botble\Base\Forms\Fields\DatePickerField;

class TenantForm extends FormAbstract
{
    public function setup(): void
    {
        $this
            ->model(Tenant::class)
            ->setValidatorClass(TenantRequest::class)
            ->add(
                'ssn_number',
                TextField::class,
                TextFieldOption::make()
                    ->label(trans('Social Security Number#'))
                    ->placeholder(trans('Social Security Number#'))
                    ->maxLength(20)
                    ->colspan(1)
                    ->required()
            )
            ->add('name', TextField::class, NameFieldOption::make()->required())
            ->add('email', TextField::class, EmailFieldOption::make()->required())
            ->add(
                'phone',
                TextField::class,
                TextFieldOption::make()
                    ->label(trans('Phone'))
                    ->placeholder(trans('Phone No#'))
                    ->maxLength(15)
                    ->colspan(1)
            )
            ->add(
                'dob',
                DatePickerField::class,
                DatePickerFieldOption::make()
                    ->defaultValue(null)
                    ->colspan(1)
            )
            ->setBreakFieldPoint('status'); // Where to break the field
    }
}
