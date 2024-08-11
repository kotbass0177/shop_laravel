<?php

namespace App\Filament\Exports;

use App\Models\Role;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class RoleExporter extends Exporter
{
    protected static ?string $model = Role::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('name')
                ->label(__(Role::$attributeLabels['name'])),
            ExportColumn::make('guard_name')
                ->label(__(Role::$attributeLabels['name'])),
            ExportColumn::make('active')
                ->label(__(Role::$attributeLabels['active'])),
            ExportColumn::make('updatedBy.name')
                ->label(__(Role::$attributeLabels['updated_by'])),
            ExportColumn::make('updated_at')
                ->label(__(Role::$attributeLabels['updated_at'])),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'การส่งออกเสร็จสิ้น จำนวน ' . number_format($export->successful_rows) . ' รายการ';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' รายการไม่สามารถส่งออกได้';
        }

        return $body;
    }

    public function getFileName(Export $export): string
    {
        $now = \now();
        $name = __('หน้าที่ในระบบ');
        return "{$name}-{$now->format('Ymd_His')}";
    }
}
