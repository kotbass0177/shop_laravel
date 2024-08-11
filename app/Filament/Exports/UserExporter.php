<?php

namespace App\Filament\Exports;

use App\Models\User;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class UserExporter extends Exporter
{
    protected static ?string $model = User::class;

    public static function getColumns(): array
    {
        return [

            ExportColumn::make('name')
                ->label(__(User::$attributeLabels['name'])),
            ExportColumn::make('jobTitle.name')
                ->label(__(User::$attributeLabels['jobTitle'])),
            ExportColumn::make('email')
                ->label(__(User::$attributeLabels['email'])),
            ExportColumn::make('email_verified_at')
                ->label(__(User::$attributeLabels['email_verified_at'])),
            ExportColumn::make('username')
                ->label(__(User::$attributeLabels['username'])),
            ExportColumn::make('mobile_no')
                ->label(__(User::$attributeLabels['mobile_no'])),
            ExportColumn::make('mobile_no_verified_at')
                ->label(__(User::$attributeLabels['mobile_no_verified_at'])),
            ExportColumn::make('active')
                ->label(__(User::$attributeLabels['active'])),
            ExportColumn::make('updatedBy.name')
                ->label(__(User::$attributeLabels['updated_by'])),
            ExportColumn::make('updated_at')
                ->label(__(User::$attributeLabels['updated_at'])),

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
        $name = __('ผู้ใช้งาน');
        return "{$name}-{$now->format('Ymd_His')}";
    }
}
