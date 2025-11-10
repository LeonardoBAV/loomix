<?php

namespace App\Filament\Resources\ProductionCostResource\Widgets;

use App\Actions\CategoryDistributionOfPCAction;
use Filament\Widgets\ChartWidget;
use Illuminate\Database\Eloquent\Model;

class CategoryDistributionPieChartWidget extends ChartWidget
{
    public ?Model $record = null;

    protected int|string|array $columnSpan = 'full';

    protected static ?string $maxHeight = '300px';

    public function getHeading(): string
    {
        return __('resources.production_costs.widgets.category_distribution.heading');
    }

    public function getDescription(): ?string
    {
        if (! $this->record) {
            return null;
        }

        $total = $this->record->getTotalPieces();

        return __('resources.production_costs.widgets.category_distribution.description', ['total' => number_format($total, 0, ',', '.')]);
    }

    protected function getType(): string
    {
        return 'pie';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'bottom',
                ],
                'tooltip' => [
                    'enabled' => true,
                ],
            ],
            'maintainAspectRatio' => true,
        ];
    }

    protected function getData(): array
    {
        if (! $this->record) {
            return [
                'datasets' => [],
                'labels' => [],
            ];
        }

        $distribution = (new CategoryDistributionOfPCAction)->execute($this->record);

        if (empty($distribution)) {
            return [
                'datasets' => [
                    [
                        'data' => [1],
                        'backgroundColor' => ['#e5e7eb'],
                    ],
                ],
                'labels' => ['Sem dados'],
            ];
        }

        $labels = array_keys($distribution);
        $counts = array_column($distribution, 'count');
        $percentages = array_column($distribution, 'percentage');

        // cores menos vibrantes
        $colors = [
            '#3b82f6',
            '#10b981',
            '#f59e0b',
            '#ef4444',
            '#8b5cf6',
            '#ec4899',
            '#06b6d4',
            '#f97316',
        ];

        return [
            'datasets' => [
                [
                    'data' => $counts,
                    'backgroundColor' => array_slice($colors, 0, count($labels)),
                ],
            ],
            'labels' => array_map(function ($label, $percentage) {
                return $label.' ('.$percentage.'%)';
            }, $labels, $percentages),
        ];
    }
}
