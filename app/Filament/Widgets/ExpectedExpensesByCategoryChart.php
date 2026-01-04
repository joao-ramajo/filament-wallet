<?php

namespace App\Filament\Widgets;

use App\Models\Expense;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;

class ExpectedExpensesByCategoryChart extends ChartWidget
{
    protected ?string $heading = 'Expected Expenses by Category';

    protected static ?int $sort = 3;

    // Permite filtrar o período
    public ?string $filter = 'month';

    protected function getData(): array
    {
        $userId = Auth::id();

        // Query base para despesas NÃO pagas (pending + overdue)
        $query = Expense::where('expenses.user_id', $userId)
            ->where('type', 'expense')
            ->where('status', '!=', 'paid');  // pending ou overdue

        // Aplica filtro de período baseado em due_date ou payment_date
        match ($this->filter) {
            'week' => $query->where(function ($q) {
                $q
                    ->where('due_date', '>=', now()->startOfWeek())
                    ->orWhere('payment_date', '>=', now()->startOfWeek());
            }),
            'month' => $query->where(function ($q) {
                $q->where(function ($subQ) {
                    $subQ
                        ->whereMonth('due_date', now()->month)
                        ->whereYear('due_date', now()->year);
                })->orWhere(function ($subQ) {
                    $subQ
                        ->whereMonth('payment_date', now()->month)
                        ->whereYear('payment_date', now()->year);
                });
            }),
            'year' => $query->where(function ($q) {
                $q
                    ->whereYear('due_date', now()->year)
                    ->orWhereYear('payment_date', now()->year);
            }),
            'all' => null,
            default => $query->where(function ($q) {
                $q->where(function ($subQ) {
                    $subQ
                        ->whereMonth('due_date', now()->month)
                        ->whereYear('due_date', now()->year);
                })->orWhere(function ($subQ) {
                    $subQ
                        ->whereMonth('payment_date', now()->month)
                        ->whereYear('payment_date', now()->year);
                });
            }),
        };

        // Agrupa por categoria (apenas com categoria definida)
        $expectedByCategory = $query
            ->whereNotNull('category_id')
            ->join('categories', 'expenses.category_id', '=', 'categories.id')
            ->selectRaw('categories.name, SUM(expenses.amount) as total')
            ->groupBy('categories.name')
            ->orderByDesc('total')
            ->get();

        // Busca gastos esperados sem categoria
        $uncategorizedQuery = Expense::where('expenses.user_id', $userId)
            ->where('type', 'expense')
            ->where('status', '!=', 'paid')
            ->whereNull('category_id');

        // Aplica mesmo filtro de período para uncategorized
        match ($this->filter) {
            'week' => $uncategorizedQuery->where(function ($q) {
                $q
                    ->where('due_date', '>=', now()->startOfWeek())
                    ->orWhere('payment_date', '>=', now()->startOfWeek());
            }),
            'month' => $uncategorizedQuery->where(function ($q) {
                $q->where(function ($subQ) {
                    $subQ
                        ->whereMonth('due_date', now()->month)
                        ->whereYear('due_date', now()->year);
                })->orWhere(function ($subQ) {
                    $subQ
                        ->whereMonth('payment_date', now()->month)
                        ->whereYear('payment_date', now()->year);
                });
            }),
            'year' => $uncategorizedQuery->where(function ($q) {
                $q
                    ->whereYear('due_date', now()->year)
                    ->orWhereYear('payment_date', now()->year);
            }),
            default => $uncategorizedQuery->where(function ($q) {
                $q->where(function ($subQ) {
                    $subQ
                        ->whereMonth('due_date', now()->month)
                        ->whereYear('due_date', now()->year);
                })->orWhere(function ($subQ) {
                    $subQ
                        ->whereMonth('payment_date', now()->month)
                        ->whereYear('payment_date', now()->year);
                });
            }),
        };

        $uncategorized = $uncategorizedQuery->sum('amount');

        // Prepara arrays para o gráfico
        $categories = $expectedByCategory->pluck('name')->toArray();
        $amounts = $expectedByCategory->pluck('total')->map(fn($v) => $v / 100)->toArray();

        // Adiciona "Uncategorized" se houver gastos esperados sem categoria
        if ($uncategorized > 0) {
            $categories[] = 'Uncategorized';
            $amounts[] = $uncategorized / 100;
        }

        // Se não houver dados, retorna vazio
        if (empty($categories)) {
            $categories = ['No pending expenses'];
            $amounts = [0];
        }

        return [
            'datasets' => [
                [
                    'label' => 'Expected Expenses (R$)',
                    'data' => $amounts,
                    'backgroundColor' => [
                        '#f59e0b',  // amber
                        '#fb923c',  // orange-400
                        '#fdba74',  // orange-300
                        '#fbbf24',  // amber-400
                        '#fcd34d',  // amber-300
                        '#fde047',  // yellow-300
                        '#facc15',  // yellow-400
                        '#eab308',  // yellow-500
                        '#ca8a04',  // yellow-600
                        '#a16207',  // yellow-700
                        '#854d0e',  // yellow-800
                        '#713f12',  // yellow-900
                        '#f97316',  // orange-500
                        '#ea580c',  // orange-600
                        '#c2410c',  // orange-700
                        '#9a3412',  // orange-800
                        '#7c2d12',  // orange-900
                        '#78716c',  // stone-500 (uncategorized)
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
