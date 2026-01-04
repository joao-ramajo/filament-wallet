<?php

namespace App\Filament\Widgets;

use App\Models\Expense;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;

class ExpensesByCategoryChart extends ChartWidget
{
    protected ?string $heading = 'Expenses by Category';

    protected static ?int $sort = 2;

    // Permite filtrar o período
    public ?string $filter = 'month';

    protected function getData(): array
    {
        $userId = Auth::id();

        // Query base para despesas pagas
        $query = Expense::where('expenses.user_id', $userId)
            ->where('type', 'expense')
            ->where('status', 'paid');

        // Aplica filtro de período
        match ($this->filter) {
            'week' => $query->where('payment_date', '>=', now()->startOfWeek()),
            'month' => $query
                ->whereMonth('payment_date', now()->month)
                ->whereYear('payment_date', now()->year),
            'year' => $query->whereYear('payment_date', now()->year),
            'all' => null,
            default => $query
                ->whereMonth('payment_date', now()->month)
                ->whereYear('payment_date', now()->year),
        };

        // Agrupa por categoria (apenas com categoria definida)
        $expensesByCategory = $query
            ->whereNotNull('category_id')
            ->join('categories', 'expenses.category_id', '=', 'categories.id')
            ->selectRaw('categories.name, SUM(expenses.amount) as total')
            ->groupBy('categories.name')
            ->orderByDesc('total')
            ->get();

        // Busca gastos sem categoria
        $uncategorizedQuery = Expense::where('expenses.user_id', $userId)
            ->where('type', 'expense')
            ->where('status', 'paid')
            ->whereNull('category_id');

        // Aplica mesmo filtro de período para uncategorized
        match ($this->filter) {
            'week' => $uncategorizedQuery->where('payment_date', '>=', now()->startOfWeek()),
            'month' => $uncategorizedQuery
                ->whereMonth('payment_date', now()->month)
                ->whereYear('payment_date', now()->year),
            'year' => $uncategorizedQuery->whereYear('payment_date', now()->year),
            default => $uncategorizedQuery
                ->whereMonth('payment_date', now()->month)
                ->whereYear('payment_date', now()->year),
        };

        $uncategorized = $uncategorizedQuery->sum('amount');

        // Prepara arrays para o gráfico
        $categories = $expensesByCategory->pluck('name')->toArray();
        $amounts = $expensesByCategory->pluck('total')->map(fn($v) => $v / 100)->toArray();

        // Adiciona "Uncategorized" se houver gastos sem categoria
        if ($uncategorized > 0) {
            $categories[] = 'Uncategorized';
            $amounts[] = $uncategorized / 100;
        }

        // Se não houver dados, retorna vazio
        if (empty($categories)) {
            $categories = ['No data'];
            $amounts = [0];
        }

        return [
            'datasets' => [
                [
                    'label' => 'Expenses (R$)',
                    'data' => $amounts,
                    'backgroundColor' => [
                        '#ef4444',  // red
                        '#f97316',  // orange
                        '#f59e0b',  // amber
                        '#eab308',  // yellow
                        '#84cc16',  // lime
                        '#22c55e',  // green
                        '#10b981',  // emerald
                        '#14b8a6',  // teal
                        '#06b6d4',  // cyan
                        '#0ea5e9',  // sky
                        '#3b82f6',  // blue
                        '#6366f1',  // indigo
                        '#8b5cf6',  // violet
                        '#a855f7',  // purple
                        '#d946ef',  // fuchsia
                        '#ec4899',  // pink
                        '#f43f5e',  // rose
                        '#64748b',  // gray (uncategorized)
                    ],
                    'borderWidth' => 2,
                    'borderColor' => '#ffffff',
                ],
            ],
            'labels' => $categories,
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }

    protected function getFilters(): ?array
    {
        return [
            'week' => 'This Week',
            'month' => 'This Month',
            'year' => 'This Year',
            'all' => 'All Time',
        ];
    }

    // Opções do gráfico para melhor visualização
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
                    'callbacks' => [
                        'label' => 'function(context) {
                            var label = context.label || "";
                            var value = context.parsed || 0;
                            var total = context.dataset.data.reduce((a, b) => a + b, 0);
                            var percentage = total > 0 ? ((value / total) * 100).toFixed(1) : 0;
                            return label + ": R$ " + value.toFixed(2).replace(".", ",") + " (" + percentage + "%)";
                        }',
                    ],
                ],
            ],
            'maintainAspectRatio' => true,
            'responsive' => true,
        ];
    }
}
