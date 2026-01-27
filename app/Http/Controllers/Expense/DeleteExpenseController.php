<?php

namespace App\Http\Controllers\Expense;

use App\Domain\Uuid;
use App\Http\Controllers\Controller;
use App\Models\Expense;
use Illuminate\Http\Request;

class DeleteExpenseController extends Controller
{
    public function __invoke(Uuid $id)
    {
        $expense = Expense::findOrFail($id->value());

        $expense->delete();

        return redirect()
            ->route('web.dashboard')
            ->with('success', 'Transação excluida com sucesso');
    }
}
