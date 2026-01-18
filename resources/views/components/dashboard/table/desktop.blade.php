<div x-data="{ openEdit: false }" class="hidden md:block overflow-x-auto">
    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-zinc-900 text-zinc-100 font-black uppercase text-xs tracking-wider border-b-4 border-zinc-700">
                <th class="text-left px-4 py-3">Descrição</th>
                <th class="text-center px-4 py-3">Status</th>
                <th class="text-left px-4 py-3">Categoria</th>
                <th class="text-center px-4 py-3">Tipo</th>
                <th class="text-left px-4 py-3">Valor</th>
                <th class="text-center px-4 py-3">Ações</th>
            </tr>
        </thead>

        <tbody class="text-zinc-200">
            @forelse ($expenses as $expense)
                <tr class="border-b border-zinc-800 hover:bg-zinc-800/50 transition-colors group">

                    <!-- Descrição -->
                    <td class="px-4 py-4">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-2 h-2 rounded-full {{ $expense->status === 'paid' ? 'bg-lime-400' : 'bg-red-500' }}">
                            </div>
                            <span class="font-semibold group-hover:text-lime-400 transition-colors">
                                {{ $expense->title }}
                            </span>
                        </div>
                    </td>

                    <!-- Status -->
                    <td class="px-4 py-4 text-center">
                        @if ($expense->status === 'paid')
                            <span
                                class="inline-flex items-center gap-1 px-3 py-1 bg-lime-400/20 border-2 border-lime-400 text-lime-400 text-xs font-black uppercase">
                                Pago
                            </span>
                        @else
                            <span
                                class="inline-flex items-center gap-1 px-3 py-1 bg-red-500/20 border-2 border-red-500 text-red-400 text-xs font-black uppercase">
                                Pendente
                            </span>
                        @endif
                    </td>

                    <!-- Categoria -->
                    <td class="px-4 py-4">
                        <span
                            class="inline-block px-3 py-1 bg-zinc-900 border border-zinc-700 text-zinc-300 text-xs font-bold uppercase">
                            {{ $expense->category }}
                        </span>
                    </td>

                    <!-- Tipo -->
                    <td class="px-4 py-4 text-center">
                        @if ($expense->type === 'expense')
                            <span class="text-red-400 font-bold text-sm">Saída</span>
                        @else
                            <span class="text-lime-400 font-bold text-sm">Entrada</span>
                        @endif
                    </td>

                    <!-- Valor -->
                    <td class="px-4 py-4 text-left">
                        <span
                            class="text-lg font-black {{ $expense->type === 'expense' ? 'text-red-400' : 'text-lime-400' }}">
                            {{ $expense->type === 'expense' ? '-' : '+' }} {{ $expense->amount }}
                        </span>
                    </td>

                    <!-- Ações -->
                    <td class="px-4 py-4">
                        <div class="flex items-center justify-center gap-2">

                            <!-- Editar -->
                            {{-- <button @click="openEdit = true" title="Editar transação"
                                class="group relative px-3 py-2 bg-zinc-900 border-2 border-zinc-700 text-zinc-300 hover:border-cyan-400 hover:text-cyan-400 hover:bg-zinc-800 transition-all duration-200 flex items-center gap-1.5">
                                <svg class="w-4 h-4 group-hover:scale-110 transition-transform" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                <span class="text-xs font-black uppercase">Editar</span>
                            </button> --}}

                            <!-- Marcar como paga -->
                            @if ($expense->status === 'pending')
                                <form action="{{ route('api.expense.mark-as-paid', ['expense' => $expense->id]) }}"
                                    method="POST" class="inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" title="Marcar como paga"
                                        class="group relative px-3 py-2 bg-lime-400/10 border-2 border-lime-400 text-lime-400 hover:bg-lime-400 hover:text-zinc-950 hover:shadow-[2px_2px_0_0_rgba(132,204,22,0.5)] transition-all duration-200 flex items-center gap-1.5">
                                        <svg class="w-4 h-4 group-hover:scale-110 transition-transform" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span class="text-xs font-black uppercase">Pagar<span
                                                style="opacity: 0;">dd</span></span>
                                    </button>
                                </form>
                            @else
                                <!-- Desfazer Pagamento (opcional) -->
                                <form action="{{ route('api.expense.mark-as-pending', ['expense' => $expense->id]) }}"
                                    method="POST" class="inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" title="Marcar como pendente"
                                        class="group relative px-3 py-2 bg-zinc-900 border-2 border-zinc-700 text-zinc-400 hover:border-red-400 hover:text-red-400 hover:bg-zinc-800 transition-all duration-200 flex items-center gap-1.5">
                                        <svg class="w-4 h-4 group-hover:scale-110 transition-transform" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                                        </svg>
                                        <span class="text-xs font-black uppercase hidden xl:inline">Desfazer</span>
                                        <span class="text-xs font-black uppercase xl:hidden">↩</span>
                                    </button>
                                </form>
                            @endif

                            <!-- Excluir (com confirmação visual) -->
                            <button @click="confirmDelete = true" title="Excluir transação"
                                class="group relative px-3 py-2 bg-zinc-900 border-2 border-zinc-700 text-zinc-400 hover:border-red-500 hover:text-red-500 hover:bg-red-500/10 transition-all duration-200 flex items-center gap-1.5">
                                <svg class="w-4 h-4 group-hover:scale-110 transition-transform" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                <span class="text-xs font-black uppercase hidden xl:inline">Excluir</span>
                            </button>

                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-4 py-16 text-center text-zinc-500">
                        Nenhuma despesa encontrada
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Modal de edição -->

</div>
