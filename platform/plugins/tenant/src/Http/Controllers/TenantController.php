<?php

namespace Botble\Tenant\Http\Controllers;

use Botble\Base\Http\Actions\DeleteResourceAction;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Tenant\Models\Tenant;
use Botble\Tenant\Tables\TenantTable;
use Illuminate\Http\Request;
use Botble\Tenant\Forms\TenantForm;

class TenantController extends BaseController
{
    public function index(TenantTable $dataTable)
    {
        $this->pageTitle(trans('plugins/tenant::tenant.name'));

        return $dataTable->renderTable();
    }

    public function create()
    {
        $this->pageTitle(trans('plugins/tenant::tenant.create'));

        return TenantForm::create()->renderForm();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email|unique:tenants,email',
            'name' => 'required|string|max:255',
        ]);

        Tenant::create($data);
        return $this
            ->httpResponse()
            ->setPreviousRoute('tenant.index')
            ->withCreatedSuccessMessage();
    }

    public function edit(Tenant $tenant)
    {
        $this->pageTitle(trans('plugins/tenant::tenant.edit'));
        return TenantForm::createFromModel($tenant)->renderForm();
    }

    public function update(Request $request, Tenant $tenant)
    {
        $data = $request->validate([
            'ssn_number' => 'required|string|max:20',
            'email' => 'required|email|unique:tenants,email,' . $tenant->id,
            'name' => 'required|string|max:255',
            'phone' =>'string',
            'dob' =>'string',
        ]);
        $tenant->update($data);
        return $this
        ->httpResponse()
        ->setPreviousRoute('tenant.index')
        ->withUpdatedSuccessMessage();
    }

    public function destroy(Tenant $tenant)
    {
        return DeleteResourceAction::make($tenant);
    }
}
