<x-layout.main-layout title="Dashboard">
    <div class="min-h-screen relative overflow-hidden">

        <!-- Background brutal shapes -->
        <div class="pointer-events-none fixed inset-0">
            <div class="absolute -top-32 -left-32 w-[40rem] h-[40rem] bg-lime-500/20 rotate-12"></div>
            <div class="absolute top-1/3 -right-40 w-[35rem] h-[35rem] bg-fuchsia-600/20 -rotate-12"></div>
            <div class="absolute bottom-0 left-1/4 w-[50rem] h-[20rem] bg-cyan-400/10 skew-y-6"></div>
        </div>

        <!-- Header -->
        <x-layout.header />


        <!-- Financial Summary -->
        <!-- Financial Summary -->
        <section class="relative z-10 px-6 py-16">
            <h2 class="text-4xl font-black text-white uppercase mb-8">Resumo Financeiro</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="border-4 border-zinc-100 p-6 bg-zinc-900 shadow-[12px_12px_0_0_#000]">
                    <p class="font-bold uppercase text-zinc-300">Total Recebido</p>
                    <p class="text-lime-400 text-2xl font-black mt-2">{{ $stats['total_receive'] }}</p>
                </div>
                <div class="border-4 border-zinc-100 p-6 bg-zinc-900 shadow-[12px_12px_0_0_#000]">
                    <p class="font-bold uppercase text-zinc-300">Total Gasto</p>
                    <p class="text-red-400 text-2xl font-black mt-2">{{ $stats['total_expense'] }}</p>
                </div>
                <div class="border-4 border-zinc-100 p-6 bg-zinc-900 shadow-[12px_12px_0_0_#000]">
                    <p class="font-bold uppercase text-zinc-300">Saldo Esperado</p>
                    <p class="text-cyan-400 text-2xl font-black mt-2">{{ $stats['expected_total'] }}</p>
                </div>
            </div>

            <!-- Acessar Dashboard -->
            <div class="flex justify-center">
                <a href="{{ route('filament.admin.pages.wallet-dashboard') }}"
                    class="bg-cyan-400 text-zinc-950 px-8 py-4 font-black uppercase shadow-[6px_6px_0_0_#000] hover:shadow-[2px_2px_0_0_#000] transition">
                    Acessar Dashboard
                </a>
            </div>
        </section>

        <!-- Expenses List -->
        <section class="relative z-10 px-6 py-16" x-data="{ open: false }">
            <div x-data="{ open: false, openImport: false }">

                <!-- Header -->
                <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between mb-6">
                    <h3 class="text-3xl font-black text-white uppercase">
                        Despesas Recentes
                    </h3>

                    <div class="flex gap-4">
                        {{-- Exportar --}}
                        <a href="{{ route('web.export') }}"
                            class="group relative bg-zinc-100 text-zinc-950 px-6 py-3 font-black uppercase shadow-[6px_6px_0_0_#000] hover:shadow-[2px_2px_0_0_#000] hover:-translate-x-1 hover:-translate-y-1 transition-all duration-200 inline-flex items-center gap-2 hidden lg:inline-flex ">
                            <svg class="w-5 h-5 group-hover:animate-bounce" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            Exportar Dados
                        </a>
                        <!-- Importar CSV -->
                        <button @click="openImport = true"
                            class="group relative bg-zinc-100 text-zinc-950 px-6 py-3 font-black uppercase shadow-[6px_6px_0_0_#000] hover:shadow-[2px_2px_0_0_#000] hover:-translate-x-1 hover:-translate-y-1 transition-all duration-200 inline-flex items-center gap-2 hidden lg:inline-flex">
                            <svg class="w-5 h-5 group-hover:animate-bounce" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                            Importar CSV
                        </button>
                        <!-- Nova Despesa -->
                        <button @click="open = true"
                            class="group relative bg-lime-400 text-zinc-950 px-8 py-3 font-black uppercase shadow-[6px_6px_0_0_#000] hover:shadow-[2px_2px_0_0_#000] hover:-translate-x-1 hover:-translate-y-1 transition-all duration-200 inline-flex items-center gap-2 hidden lg:inline-flex">
                            <svg class="w-5 h-5 group-hover:rotate-90 transition-transform duration-300" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            <span>Nova Despesa</span>
                            <span
                                class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 text-white text-xs flex items-center justify-center rounded-full animate-pulse">
                                !
                            </span>
                        </button>

                        {{-- MOBILE BUTTONS --}}
                        <div class="flex lg:hidden flex-col gap-3 w-full">
                            {{-- Exportar --}}
                            <a href="{{ route('web.export') }}"
                                class="bg-zinc-100 text-zinc-950 px-6 py-3 font-black uppercase text-center shadow-[4px_4px_0_0_#000] hover:shadow-[2px_2px_0_0_#000] transition-all inline-flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                                Exportar
                            </a>

                            <!-- Importar CSV -->
                            <button @click="openImport = true"
                                class="bg-zinc-100 text-zinc-950 px-6 py-3 font-black uppercase shadow-[4px_4px_0_0_#000] hover:shadow-[2px_2px_0_0_#000] transition-all inline-flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                                Importar
                            </button>

                            <!-- Nova Despesa -->
                            <button @click="open = true"
                                class="bg-lime-400 text-zinc-950 px-6 py-4 font-black uppercase shadow-[4px_4px_0_0_#000] hover:shadow-[2px_2px_0_0_#000] transition-all inline-flex items-center justify-center gap-2 relative">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                                Nova Despesa
                            </button>
                        </div>
                    </div>
                </div>

                <!-- MODAL IMPORT CSV -->
                <div x-show="openImport" x-transition
                    class="fixed inset-0 z-50 flex items-center justify-center bg-black/80">
                    <div @click.outside="openImport = false"
                        class="bg-zinc-950 border-4 border-zinc-100 w-full max-w-lg p-8
                   shadow-[10px_10px_0_0_#000]">
                        <!-- Header -->
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-2xl font-black uppercase text-white">
                                Importar CSV
                            </h3>
                            <button @click="openImport = false" class="text-zinc-100 font-black text-xl">
                                ✕
                            </button>
                        </div>

                        <!-- Descrição -->
                        <p class="text-zinc-300 mb-6 text-sm">
                            Apenas planilhas geradas pelo
                            <strong>Filament Wallet</strong>
                            são compatíveis com esta importação.
                        </p>

                        <!-- Form -->
                        <form method="POST" action="{{ route('api.import') }}" enctype="multipart/form-data"
                            class="space-y-6">
                            @csrf

                            <!-- Upload -->
                            <div>
                                <label class="block font-bold mb-2 text-zinc-100">
                                    Arquivo CSV
                                </label>
                                <input type="file" name="file" accept=".csv" required
                                    class="w-full p-3 bg-zinc-950 text-zinc-100
                               border-2 border-zinc-100
                               file:bg-lime-400 file:text-zinc-950
                               file:font-black file:px-4 file:py-2
                               file:border-0 file:mr-4
                               focus:outline-none">
                            </div>

                            <!-- Actions -->
                            <div class="flex justify-end gap-4">
                                <button type="button" @click="openImport = false"
                                    class="px-6 py-3 font-black uppercase bg-zinc-800 text-white
                               shadow-[4px_4px_0_0_#000]">
                                    Cancelar
                                </button>

                                <button type="submit"
                                    class="px-6 py-3 font-black uppercase bg-lime-400 text-zinc-950
                               shadow-[4px_4px_0_0_#000]
                               hover:shadow-[2px_2px_0_0_#000]
                               transition">
                                    Importar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Modal -->
                <div x-show="open" class="fixed inset-0 bg-black/70 flex items-center justify-center z-50"
                    x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

                    <div class="bg-zinc-900 border-4 border-zinc-100 p-8 w-full max-w-lg shadow-[8px_8px_0_0_#000] relative"
                        @click.away="open = false" x-transition:enter="transform transition ease-out duration-300"
                        x-transition:enter-start="scale-90 opacity-0" x-transition:enter-end="scale-100 opacity-100"
                        x-transition:leave="transform transition ease-in duration-200"
                        x-transition:leave-start="scale-100 opacity-100" x-transition:leave-end="scale-90 opacity-0">

                        <h4 class="text-2xl font-black uppercase text-white mb-6">Nova Despesa / Entrada</h4>

                        <form action="{{ route('api.expense.store') }}" method="POST">
                            @csrf
                            <!-- Título -->
                            <div class="mb-4">
                                <label for="title" class="block font-bold mb-2 text-zinc-100">Descrição</label>
                                <input type="text" id="title" name="title" placeholder="Ex: Aluguel"
                                    class="w-full p-3 rounded border-2 border-zinc-100 bg-zinc-950 text-zinc-100 focus:outline-none focus:border-lime-400">
                            </div>

                            <!-- Valor -->
                            <!-- Valor -->
                            <div class="mb-4" x-data="{ displayAmount: '', cents: null }">
                                <label for="amount" class="block font-bold mb-2 text-zinc-100">Valor (R$)</label>

                                <!-- Input visível para o usuário -->
                                <input type="text" id="amount" x-model="displayAmount"
                                    @input="

            let numbers = $event.target.value.replace(/\D/g,'');
            cents = numbers ? parseInt(numbers) : null;
            displayAmount = cents ? (cents/100).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' }) : '';
        "
                                    placeholder="R$ 0,00"
                                    class="w-full p-3 rounded border-2 border-zinc-100 bg-zinc-950 text-zinc-100 focus:outline-none focus:border-lime-400">

                                <!-- Input real enviado ao backend -->
                                <input type="hidden" name="amount" :value="cents">
                            </div>


                            <!-- Tipo -->
                            {{-- <div class="mb-6">
                            <label for="type" class="block font-bold mb-2 text-zinc-100">Tipo</label>
                            <select id="type" name="type"
                                class="w-full p-3 rounded border-2 border-zinc-100 bg-zinc-950 text-zinc-100 focus:outline-none focus:border-lime-400">
                                <option value="income">Entrada</option>
                                <option value="expense">Despesa</option>
                            </select>
                        </div> --}}

                            <div class="mb-6">
                                <span class="block font-bold mb-2 text-zinc-100">Tipo</span>

                                <div class="flex gap-6">
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" name="type" value="income" class="hidden peer"
                                            checked>
                                        <div
                                            class="w-5 h-5 rounded-full border-2 border-zinc-100
                       peer-checked:border-lime-400
                       peer-checked:bg-lime-400 transition">
                                        </div>
                                        <span class="text-zinc-100">Entrada</span>
                                    </label>

                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" name="type" value="expense" class="hidden peer">
                                        <div
                                            class="w-5 h-5 rounded-full border-2 border-zinc-100
                       peer-checked:border-red-400
                       peer-checked:bg-red-400 transition">
                                        </div>
                                        <span class="text-zinc-100">Despesa</span>
                                    </label>
                                </div>
                            </div>

                            <div class="mb-6" x-data="{ status: 'pending' }">
                                <label class="block font-bold mb-2 text-zinc-100">
                                    Status
                                </label>

                                <select name="status" x-model="status"
                                    :class="{
                                        'border-yellow-400': status === 'pending',
                                        'border-green-400': status === 'paid',
                                        'border-red-400': status === 'overdue'
                                    }"
                                    class="w-full p-3 rounded border-2 bg-zinc-950 text-zinc-100 focus:outline-none">
                                    <option value="pending">Pendente</option>
                                    <option value="paid">Pago</option>
                                    <option value="overdue">Em atraso</option>
                                </select>
                            </div>

                            <div class="mb-6">
                                <label for="category_id" class="block font-bold mb-2 text-zinc-100">
                                    Categoria
                                </label>

                                <select id="category_id" name="category_id"
                                    class="w-full p-3 rounded border-2 border-zinc-100 bg-zinc-950 text-zinc-100
               focus:outline-none focus:border-lime-400">
                                    <option value="">Sem categoria</option>

                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="flex justify-end gap-4">
                                <button type="button" @click="open = false"
                                    class="bg-red-500 text-zinc-100 px-6 py-3 font-black uppercase shadow-[4px_4px_0_0_#000] hover:shadow-[2px_2px_0_0_#000] transition">
                                    Cancelar
                                </button>
                                <button type="submit"
                                    class="bg-lime-400 text-zinc-950 px-6 py-3 font-black uppercase shadow-[6px_6px_0_0_#000] hover:shadow-[2px_2px_0_0_#000] transition">
                                    Salvar
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </section>
      
            <x-dashboard.table.table :expenses="$expenses"/>
      
        </section>

        <!-- Footer -->
        <x-layout.footer />
    </div>
</x-layout.main-layout>
