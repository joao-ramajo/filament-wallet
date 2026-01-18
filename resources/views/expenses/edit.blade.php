<x-layout.main-layout>
    <x-layout.header />
    <x-bricks />

    <div class="min-h-screen bg-zinc-950 py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6">

            <!-- Header da Página -->
            <div class="mb-8">
                <a href="{{ url()->previous() }}"
                    class="inline-flex items-center gap-2 text-zinc-400 hover:text-lime-400 transition-colors mb-4">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Voltar
                </a>

                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-lime-400 flex items-center justify-center shadow-[4px_4px_0_0_#000]">
                        <svg class="w-7 h-7 text-zinc-950" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl md:text-4xl font-black text-white uppercase">Editar Transação</h1>
                        <p class="text-zinc-400 text-sm">{{ $expense->title }}</p>
                    </div>
                </div>
            </div>

            <!-- Formulário -->
            <div class="bg-zinc-900 border-4 border-zinc-800 p-6 md:p-8 shadow-[8px_8px_0_0_#000]">
                <form action="" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Descrição -->
                    <div>
                        <label class="block text-zinc-100 font-bold mb-2 uppercase text-sm">
                            Descrição
                        </label>
                        <input type="text" name="title" value="{{ old('title', $expense->title) }}"
                            class="w-full bg-zinc-950 border-2 border-zinc-700 px-4 py-3 text-zinc-100 focus:border-lime-400 focus:outline-none transition-colors"
                            placeholder="Ex: Aluguel, Conta de luz..." required>
                        @error('title')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Valor -->
                    <div>
                        <label class="block text-zinc-100 font-bold mb-2 uppercase text-sm">
                            Valor (R$)
                        </label>
                        <input type="text" name="amount" value="{{ old('amount', $expense->amount) }}"
                            class="w-full bg-zinc-950 border-2 border-zinc-700 px-4 py-3 text-zinc-100 focus:border-lime-400 focus:outline-none transition-colors text-lg font-bold"
                            placeholder="R$ 0,00" required>
                        <p class="text-xs text-zinc-500 mt-1">O valor será convertido para centavos ao salvar.</p>
                        @error('amount')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tipo -->
                    <div>
                        <label class="block text-zinc-100 font-bold mb-3 uppercase text-sm">
                            Tipo de Transação
                        </label>
                        <div class="grid grid-cols-2 gap-3">
                            <label class="cursor-pointer">
                                <input type="radio" name="type" value="expense" class="hidden peer"
                                    {{ old('type', $expense->type) === 'expense' ? 'checked' : '' }}>
                                <div
                                    class="px-4 py-3 border-2 border-red-500 text-red-400 font-black uppercase text-center peer-checked:bg-red-500 peer-checked:text-zinc-950 transition-all flex items-center justify-center gap-2 hover:bg-red-500/10">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                                    </svg>
                                    Saída
                                </div>
                            </label>

                            <label class="cursor-pointer">
                                <input type="radio" name="type" value="income" class="hidden peer"
                                    {{ old('type', $expense->type) === 'income' ? 'checked' : '' }}>
                                <div
                                    class="px-4 py-3 border-2 border-lime-400 text-lime-400 font-black uppercase text-center peer-checked:bg-lime-400 peer-checked:text-zinc-950 transition-all flex items-center justify-center gap-2 hover:bg-lime-400/10">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 10l7-7m0 0l7 7m-7-7v18" />
                                    </svg>
                                    Entrada
                                </div>
                            </label>
                        </div>
                        @error('type')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-zinc-100 font-bold mb-3 uppercase text-sm">
                            Status do Pagamento
                        </label>
                        <div class="grid grid-cols-3 gap-2">
                            <label class="cursor-pointer">
                                <input type="radio" name="status" value="paid" class="hidden peer"
                                    {{ old('status', $expense->status) === 'paid' ? 'checked' : '' }}>
                                <div
                                    class="px-3 py-2 border-2 border-lime-400 text-lime-400 font-black uppercase text-xs text-center peer-checked:bg-lime-400 peer-checked:text-zinc-950 transition-all hover:bg-lime-400/10">
                                    Pago
                                </div>
                            </label>

                            <label class="cursor-pointer">
                                <input type="radio" name="status" value="pending" class="hidden peer"
                                    {{ old('status', $expense->status) === 'pending' ? 'checked' : '' }}>
                                <div
                                    class="px-3 py-2 border-2 border-yellow-400 text-yellow-400 font-black uppercase text-xs text-center peer-checked:bg-yellow-400 peer-checked:text-zinc-950 transition-all hover:bg-yellow-400/10">
                                    Pendente
                                </div>
                            </label>

                            <label class="cursor-pointer">
                                <input type="radio" name="status" value="overdue" class="hidden peer"
                                    {{ old('status', $expense->status) === 'overdue' ? 'checked' : '' }}>
                                <div
                                    class="px-3 py-2 border-2 border-red-500 text-red-400 font-black uppercase text-xs text-center peer-checked:bg-red-500 peer-checked:text-zinc-950 transition-all hover:bg-red-500/10">
                                    Vencida
                                </div>
                            </label>
                        </div>
                        @error('status')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Categoria -->
                    <div>
                        <label class="block text-zinc-100 font-bold mb-2 uppercase text-sm">
                            Categoria
                        </label>
                        <select name="category_id"
                            class="w-full bg-zinc-950 border-2 border-zinc-700 px-4 py-3 text-zinc-100 focus:border-lime-400 focus:outline-none transition-colors cursor-pointer">
                            <option value="">Sem categoria</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id', $expense->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Data de Pagamento -->
                    <div>
                        <label class="block text-zinc-100 font-bold mb-2 uppercase text-sm">
                            Data de Pagamento
                        </label>

                        <input type="date" name="payment_date" id="payment_date"
                            value="{{ old('payment_date', $expense->payment_date) }}"
                            class="w-full bg-zinc-950 border-2 border-zinc-700 px-4 py-3 text-zinc-100 focus:border-lime-400 focus:outline-none transition-colors">

                        <label class="inline-flex items-center gap-2 mt-3 cursor-pointer select-none">
                            <input type="checkbox" id="no_payment_date" name="no_payment_date"
                                class="w-4 h-4 bg-zinc-950 border-2 border-zinc-700 accent-lime-400"
                                {{ old('no_payment_date', !$expense->payment_date) ? 'checked' : '' }}>
                            <span class="text-zinc-300 font-bold text-sm">Sem data de pagamento</span>
                        </label>

                        <script>
                            const checkbox = document.getElementById('no_payment_date');
                            const paymentInput = document.getElementById('payment_date');

                            checkbox.addEventListener('change', () => {
                                if (checkbox.checked) {
                                    paymentInput.value = '';
                                    paymentInput.disabled = true;
                                    paymentInput.classList.add('opacity-50', 'cursor-not-allowed');
                                } else {
                                    paymentInput.disabled = false;
                                    paymentInput.classList.remove('opacity-50', 'cursor-not-allowed');
                                }
                            });

                            // Inicializa o estado
                            if (checkbox.checked) {
                                paymentInput.disabled = true;
                                paymentInput.classList.add('opacity-50', 'cursor-not-allowed');
                            }
                        </script>

                        @error('payment_date')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Ações -->
                    <div
                        class="flex flex-col-reverse sm:flex-row justify-between items-center gap-4 pt-6 border-t-2 border-zinc-800">
                        <a href="{{ url()->previous() }}"
                            class="w-full sm:w-auto px-6 py-3 bg-zinc-800 text-zinc-200 font-black uppercase hover:bg-zinc-700 transition-colors text-center">
                            Cancelar
                        </a>

                        <button type="submit"
                            class="w-full sm:w-auto px-8 py-3 bg-lime-400 text-zinc-950 font-black uppercase shadow-[4px_4px_0_0_#000] hover:shadow-[2px_2px_0_0_#000] hover:-translate-x-0.5 hover:-translate-y-0.5 transition-all flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Salvar Alterações
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <x-layout.footer />
</x-layout.main-layout>
