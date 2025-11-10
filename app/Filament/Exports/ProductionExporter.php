<?php

namespace App\Filament\Exports;

use App\Models\Production;
use App\Models\Size;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class ProductionExporter extends Exporter
{
    protected static ?string $model = Production::class;

    public static function getColumns(): array
    {

        $sizes = Size::all();

        return [
            ExportColumn::make('product.name'),
            ExportColumn::make('color.title'),

            ExportColumn::make('status')->state(function (Production $record) {
                return __('enums.production_status.'.$record->status->value);
            }),

            ...$sizes->map(function (Size $size) {
                return ExportColumn::make($size->alias)->state(function (Production $record) use ($size) {
                    return $record->qty($size);
                });
            }),

            ExportColumn::make('date_started'),
            ExportColumn::make('client.name'),
            ExportColumn::make('cutter.name'),

            // ExportColumn::make('date_cutting'),
            // ExportColumn::make('date_sewing'),
            // ExportColumn::make('date_finishing'),
            // ExportColumn::make('date_completed'),
            // ExportColumn::make('created_at'),
            // ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your production export has completed and '.number_format($export->successful_rows).' '.str('row')->plural($export->successful_rows).' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' '.number_format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to export.';
        }

        return $body;
    }
}
