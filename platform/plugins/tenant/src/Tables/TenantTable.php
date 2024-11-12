<?php

namespace Botble\Tenant\Tables;

use Botble\Tenant\Models\Tenant;
use Botble\Table\Abstracts\TableAbstract;
use Botble\Table\Actions\DeleteAction;
use Botble\Table\BulkActions\DeleteBulkAction;
use Botble\Table\BulkChanges\CreatedAtBulkChange;
use Botble\Table\BulkChanges\EmailBulkChange;
use Botble\Table\BulkChanges\NameBulkChange;
use Botble\Table\BulkChanges\StatusBulkChange;
use Botble\Table\Columns\CreatedAtColumn;
use Botble\Table\Columns\EmailColumn;
use Botble\Table\Actions\EditAction;
use Botble\Table\Columns\IdColumn;
use Botble\Table\Columns\NameColumn;
use Botble\Table\Columns\StatusColumn;
use Illuminate\Database\Eloquent\Builder;
use Botble\Table\HeaderActions\CreateHeaderAction;

class TenantTable extends TableAbstract
{
    public function setup(): void
    {
        $this
            ->model(Tenant::class)
            ->addColumns([
                IdColumn::make(),
                EmailColumn::make()->linkable(),
                NameColumn::make(),
                CreatedAtColumn::make(),
            ])
            ->addHeaderAction(CreateHeaderAction::make()->route('tenant.create'))
            ->addActions([
                EditAction::make()->route('tenant.edit'),
                DeleteAction::make()->route('tenant.destroy'),
            ])
            ->addBulkAction(DeleteBulkAction::make()->permission('tenant.destroy'))
            ->addBulkChanges([
                NameBulkChange::make(),
                EmailBulkChange::make(),
                StatusBulkChange::make(),
                CreatedAtBulkChange::make(),
            ])
            ->queryUsing(function (Builder $query) {
                return $query
                    ->select([
                        'id',
                        'email',
                        'name',
                        'phone',
                        'dob',
                        'created_at',
                    ]);
            });
    }

    public function getDefaultButtons(): array
    {
        return [
            'create',
            'export',
            'reload',
        ];
    }
}
